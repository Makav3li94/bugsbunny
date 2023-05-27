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
        $sections = Section::withCount('questions')->where([['type',1],['status', 1]])->whereIn('category_id', json_decode($user->cats))->get();
        $userSections = Section::withCount('questions')->where([['type', 0], ['user_id', auth()->id()]])->get();
        $threads = Section::where([['kind', 1], ['user_id', auth()->id()]])->get();
        $activities = LogActivity::where('user_id',auth()->id())->get();
//          Like::query()->whereMorphedTo('userable', $user)->get();

//        $likes = Reply::where('user_id', $user->id)->withCount(['likes', 'dislikes'])->get()->sum('likes_count');
//        $dislikes = Reply::where('user_id', $user->id)->withCount(['likes', 'dislikes'])->get()->sum('dislikes_count');
        $plusScores = TotalScore::where([['user_id' , $user->id],['type',1]])->get()->sum('score');
        $minusScores = TotalScore::where([['user_id' , $user->id],['type',0]])->get()->sum('score');
//        $totalScore = ($likes - $dislikes) + ($plusScores - $minusScores);
        $totalScore = $plusScores - $minusScores;
        request()->session()->now('crud', 'first');
        return view('user.dashboard', compact('tickets','activities','setting','threads', 'sliders', 'cats', 'user', 'sections', 'userSections','totalScore'));
    }

    protected function update(Request $request, User $user)
    {
        $familiaritiesCount = Familiarity::all()->count();
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|regex:/^[a-zA-Z0-9 ]+$/',
            'mobile' => "required|numeric",
            'email' => "nullable|email|string",
            'password' => 'nullable|string|min:6',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
            'familiarity' => 'nullable|numeric|integer|min:1|max:' . $familiaritiesCount,
            'birthDate' => 'required',
            'cats' => 'required',
        ]);
        if (isset($request->authStatus)) $status = 1; else $status = 0;
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
            $password = Hash::make($password);
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
        $this->notifyAdmin($user->id, $user->name,  $user->mobile, 'profileChange', 0, 0, 'کاربر پروفایل خود را آپدیت کرد.');
        return redirect()->back()->with(['update'=>'success','crud'=>'user_update']);


    }

}
