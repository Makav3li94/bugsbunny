<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected function edit(Admin $admin)
    {
        return view('admin.profile.edit', compact('admin'));
    }

    protected function update(Request $request, Admin $admin)
    {
        if ($admin->id == auth()->user()->id) {
            $request->validate([
                'name' => 'required',
                'email' => "required|email|unique:admins,email,{$admin->id}",
                'mobile' => "required|regex:/09[0-9]{9}/|unique:admins,mobile,{$admin->id}",
                'password' => 'nullable|min:6|confirmed'
            ]);
            if ($request['password'] != null) {
                $password = bcrypt($request['password']);
                $admin->update([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'mobile' => $request['mobile'],
                    'password' => $password,
                ]);
            } else {
                $admin->update([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'mobile' => $request['mobile'],
                ]);
            }
            return redirect()->back()->with(['profile' => 'updated']);
        } else {
            abort(403);
        }
    }
}
