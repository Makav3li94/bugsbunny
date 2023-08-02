<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Familiarity;
use App\Models\Like;
use App\Models\LogActivity;
use App\Models\Reply;
use App\Models\Section;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Ticket;
use App\Models\TotalScore;
use App\Models\User;
use App\Traits\Helpers;
use App\Traits\Numbers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    use Helpers, Numbers;

    protected function dashboard()
    {
        $user = User::find(auth()->id());


        //Open Tickets Count
        $tickets = Ticket::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        if (Setting::all()->count() > 0) {
            $setting = Setting::all()->first();
        } else {
            $setting = null;
        }
        $cats = Category::all();
        //Sliders
        $sliders = Slider::all();
        $date = $this->convertToJalaliDate($user->birthDate, TRUE);
        $user['birthDate'] = $date;
        $sections = Section::withCount('questions')->where('type', 1)->whereIn('status', [2, 4])->whereIn('category_id', json_decode($user->cats))->orderBy('id','desc')->get();
        $userSections = Section::withCount('questions')->where([['type', 0],['status', 2] ])->orWhere([['type', 0],['user_id', auth()->id()] ])->whereIn('category_id', json_decode($user->cats))->orderBy('id','desc')->get();
        $threads = Section::where([['kind', 1], ['user_id', auth()->id()]])->get();
        $activities = LogActivity::where('user_id', auth()->id())->get();
//          Like::query()->whereMorphedTo('userable', $user)->where('likeable_id',2)->get();

//        $likes = Reply::where('user_id', $user->id)->withCount(['likes', 'dislikes'])->get()->sum('likes_count');
//        $dislikes = Reply::where('user_id', $user->id)->withCount(['likes', 'dislikes'])->get()->sum('dislikes_count');
        $plusScores = TotalScore::where([['user_id', $user->id], ['type', 1]])->get()->sum('score');
        $minusScores = TotalScore::where([['user_id', $user->id], ['type', 0]])->get()->sum('score');
//        $totalScore = ($likes - $dislikes) + ($plusScores - $minusScores);
        $totalScore = $plusScores - $minusScores;
        $section_count = Section::where([['kind', 0], ['user_id', auth()->id()]])->count();
        $thread_count = Section::where([['kind', 1], ['user_id', auth()->id()]])->count();
        $reply_count = Reply::where('user_id',auth()->id())->count();
        $likes = Reply::where('user_id', $user->id)->withCount(['likes', 'dislikes'])->get()->sum('likes_count');
        return view('user.dashboard', compact('section_count','thread_count','reply_count','likes','tickets', 'activities', 'setting', 'threads', 'sliders', 'cats', 'user', 'sections', 'userSections', 'totalScore'));
    }

    protected function update(Request $request, User $user)
    {
        $familiaritiesCount = Familiarity::all()->count();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'username' => 'required|regex:/^[a-zA-Z0-9 ]+$/',
            'mobile' => "required|numeric",
            'email' => "nullable|email|string",
            'password' => 'nullable|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|min:8',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
            'familiarity' => 'nullable|numeric|integer|min:1|max:' . $familiaritiesCount,
            'birthDate' => 'required',
            'cats' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->with('for','user_update');
        }
        $birthDate = $this->convertToGoregianDate($request->input('birthDate'));
        $password = $request->input('password');

        list($status, $avatar) = $this->fileAndStatus($user, $request);


        if ($password == null) {
            //Updates User Without Password
            $user->update([
                'name' => $request['name'],
                'mobile' => $request['mobile'],
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
            $hash = $this->hashCheck($user, $request);
            if (\hash_equals($user->getAuthPassword(), $hash)){
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
            }else{
                return back()->withErrors(["old_password" => "رمز عبور قبلی شما درست نیست."])->withInput()->with('for','user_update');
            }

        }
        if ($status == 0) $this->notifyAdmin($user->id, $user->name, $user->mobile, 'profileChange', $user->id, 0, 'کاربر پروفایل خود را آپدیت کرد.');
        return back()->with('update', 'success')->with('crud', 'user_update');


    }

    /**
     * @param User $user
     * @param Request $request
     * @return array
     */
    protected function fileAndStatus(User $user, Request $request): array
    {
        $status = $user->status;
        if ($user->username != $request->username || $user->name != $request->name) {
            $status = 0;
        }
        if ($request->hasFile('avatar')) {
            if ($user->avatar != null) {
                $userAvatar = public_path("storage2/user/avatar/{$user->avatar}"); // get previous image from folder
                if (File::exists($userAvatar)) { // unlink or remove previous image from folder
                    unlink($userAvatar);
                }
            }
//            $avatar = time() . '.' . request()->avatar->getClientOriginalExtension();
//            request()->avatar->move(public_path('images/user/'), $avatar);
            $avatar = time() . '.' . request()->avatar->getClientOriginalExtension();
            request()->avatar->move(public_path('storage2/user/avatar/'), $avatar);
            $status = 0;
        } else
            $avatar = $user->avatar;
        return array($status, $avatar);
    }

    private function passHasher($id,$password1): string|false
    {
        $salt = md5(($id + 1) * 2020 + 22);
        $password = \hash('sha512', $salt . $password1);
        return $password;
    }

    /**
     * @param User $user
     * @param Request $request
     * @return false|string
     */
    private function hashCheck(User $user, Request $request): string|false
    {

        $salt = md5(($user->id + 1) * 2020 + 22);
        $hash = \hash('sha512', $salt . $request->old_password);
        return $hash;
    }

}
