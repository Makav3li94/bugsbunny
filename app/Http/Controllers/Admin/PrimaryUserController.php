<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Familiarity;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Helpers;
use App\Traits\Numbers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PrimaryUserController extends Controller
{

    use Helpers, Numbers;

    function __construct()
    {
//        $this->middleware('permission:main-account');
    }

    protected function index()
    {
        $users = User::where('is_primary', '1')->orderBy('id', 'desc')->get();

        return view('admin.user.primary.index', compact('users'));
    }

    protected function create()
    {
        $familiarities = Familiarity::all();
        $categories = Category::all();
        return view('admin.user.primary.create',
            compact('familiarities', 'categories'));
    }

    protected function store(Request $request)
    {
        $familiaritiesCount = Familiarity::all()->count();
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|regex:/^[a-zA-Z0-9 ]+$/',
            'mobile' => 'required|numeric|unique:users,mobile,NULL,id,deleted_at,NULL',
            'email' => 'required|email|string|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|min:8',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
            'familiarity' => 'nullable|numeric|integer|min:1|max:' . $familiaritiesCount,
            'birthDate' => 'required',
            'cats' => 'required',
        ]);
        $mobile = $request['mobile'];
        $password = $request['password'];
        if ($password == null) {
            $password = Hash::make($mobile);
        } else {
            $password = Hash::make($password);
        }


        if (request()->hasFile('avatar')) {
            $avatar = time() . '.' . request()->avatar->getClientOriginalExtension();
            request()->avatar->move(public_path('images/user/'), $avatar);
        } else
            $avatar = null;


        $user = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'mobile' => $mobile,
            'email' => $request['email'],
            'password' => $password,
            'familiarity_id' => $request['familiarity'],
            'birthDate' => $this->convertToGoregianDate($request->input('birthDate')),
            'cats' => json_encode($request->cats),
            'avatar' => $avatar,
        ]);
        $this->readMFNotification($user->id,'profileChange',$user->id);
        $this->readMFNotification($user->id,'register',$user->id);
        return redirect(route('admin.user.primary.edit', $user->id))->with([
            'store' => 'success'
        ]);
    }

    protected function edit(User $user)
    {

        $categories = Category::all();
        $notes = $user->notes()->get();
        $familiarities = Familiarity::all();
        $date = $this->convertToJalaliDate($user->birthDate, TRUE);
        $user['birthDate'] = $date;

        return view('admin.user.primary.edit',
            compact('user', 'categories', 'notes', 'familiarities'));
    }

    protected function update(Request $request, User $user)
    {
        $familiaritiesCount = Familiarity::all()->count();
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|regex:/^[a-zA-Z0-9 ]+$/',
            'email' => "nullable|email|string",
            'password' => 'nullable|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|min:8',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
            'familiarity' => 'nullable|numeric|integer|min:1|max:' . $familiaritiesCount,
            'birthDate' => 'required',
            'cats' => 'required',
        ]);

        if (isset($request->authStatus)) $status = 1; else $status = 0;
        if ($user->authStatus != $status) {
            $this->authStatus($status,$user);
            $this->readMFNotification($user->id,'register',$user->id);
            $this->readMFNotification($user->id,'profileChange',$user->id);
        }
        $birthDate = $this->convertToGoregianDate($request->input('birthDate'));
        $password = $request->input('password');

        if ($request->hasFile('avatar')) {
            if ($user->avatar != null) {
                $userAvatar = public_path("images/user/{$user->avatar}"); // get previous image from folder
                if (File::exists($userAvatar)) { // unlink or remove previous image from folder
                    unlink($userAvatar);
                }
            }
            $avatar = time() . '.' . request()->avatar->getClientOriginalExtension();
            request()->avatar->move(public_path('images/user/'), $avatar);
        } else
            $avatar = $user->avatar;


        if ($password == null) {
            //Updates User Without Password
            $user->update([
                'name' => $request['name'],
                'mobile' => $request['mobile']?? Null,
                'email' => $request['email'],
                'familiarity_id' => $request['familiarity'],
                'birthDate' => $birthDate,
                'username' => $request['username'],
                'avatar' => $avatar,
                'cats' => json_encode($request->cats),
                'authStatus' => $status,

            ]);
        } else {
            //Updates User With Password
            $password = $this->passHasher($user->id,$password);
            $user->update([
                'name' => $request['name'],
                'mobile' => $request['mobile'],
                'email' => $request['email'],
                'familiarity_id' => $request['familiarity'],
                'birthDate' => $birthDate,
                'password' => $password,
                'username' => $request['username'],
                'avatar' => $avatar,
                'cats' => json_encode($request->cats),
                'authStatus' => $status,
            ]);
        }
        return redirect(route('admin.user.primary.edit', $user->id))->with([
            'store' => 'success'
        ]);


    }

    protected function destroy(User $user)
    {

        $user->notes()->delete();
        $user->quizHeader()->delete();
        $user->replies()->delete();
        $user->sections()->delete();
        $user->totalScore()->delete();
        $user->smses()->delete();
        $user->delete();
        return back()->with([
            'destroy' => 'success'
        ]);
    }

    protected function authStatus($status,User $user)
    {
            switch ($status) {
                case '0':
                    $user->update(['authStatus' => 0]);
                    $details = ['type' => 'وضعیت حساب کاربری', 'status' => 'در حال بررسی'];
                     $user->sendUserVerifyNotification($user, $details);
                    break;
                case '1':
                    $user->update(['authStatus' => 1]);
                    $details = ['type' => 'وضعیت حساب کاربری', 'status' => 'تایید شده'];
                     $user->sendUserVerifyNotification($user, $details);
                    break;
            }
    }
    private function passHasher($id,$password1): string|false
    {
        $salt = md5(($id + 1) * 2020 + 22);
        $password = \hash('sha512', $salt . $password1);
        return $password;
    }
}
