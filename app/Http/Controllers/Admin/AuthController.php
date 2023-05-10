<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Setting;
use App\Traits\Randomable;
use App\Traits\SmsableMokhaberat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use Randomable, SmsableMokhaberat;

    protected function reset(Request $request)
    {
        $array = $this->createRandomNumbers();
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:admins,email',
            'result' => 'required|numeric|integer'
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator->errors())
                ->withInput()
                ->with(['reset' => 'error', 'array' => $array]);
        }

        $email = $request['email'];
        $admin = Admin::whereEmail($email)->first();
        $randomDigits = rand(100000, 999999);
        if (Setting::all()->count() > 0 && Setting::all()->first()->brand != null) {
            $name = Setting::all()->first()->brand;
        } else {
            $name = '';
        }

        $this->setKeys();


        $newPassword = Hash::    $this->sendFastSmsMokhaberat([$admin->mobile], "24libosdgo",
            [ "pass" => "{$randomDigits}"], "3000505");make($randomDigits);
        $admin->update(['password' => $newPassword]);
        return redirect(route('admin.login'))->with(['resetPass' => 'sent']);

    }
}
