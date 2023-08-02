<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\Familiarity;
use App\Models\FileTitle;
use App\Models\User;
use App\Traits\Helpers;
use App\Traits\Numbers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PrimaryUserController extends Controller
{
    use Numbers,Helpers;

    protected function edit(User $user)
    {
        if (auth()->user()->id == $user->id) {
            $files = $user->files()->get();
            $familiarities = Familiarity::all();
            $categories = Category::all();
            $fileTitles = FileTitle::all();
            $date = $this->convertToJalaliDate($user->birthDate, TRUE);
            $user['birthDate'] = $date;
            return view('user.primary.edit',
                compact('user', 'fileTitles','categories',  'familiarities', 'files'));

        } else {
            abort(404);
        }

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
        $birthDate = $this->convertToGoregianDate($request->input('birthDate'));
        $password = $request->input('password');

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
            ]);
        }

        return redirect(route('user.primary.edit', $user->id))->with([
            'store' => 'success'
        ]);
    }



}
