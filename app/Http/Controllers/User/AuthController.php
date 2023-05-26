<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\Familiarity;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Sms;
use App\Models\PreRegister;
use App\Models\SmsSetting;
use App\Traits\Numbers;
use App\Traits\Randomable;
use App\Traits\SmsableMokhaberat;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use SmsableMokhaberat, Randomable, Numbers;

    //SMS Panel Credentials
    private $client;
    private $user;
    private $pass;
    private $fromNum;
    private $toNum;
    private $pattern_code;
    private $input_data;

    public function showRegistrationForm()
    {
        if (auth()->check()) {
            return redirect(route('user.dashboard'));
        } else {
            if (Setting::all()->count() > 0) {
                $setting = Setting::all()->first();
            } else {
                $setting = null;
            }
            $array = $this->createRandomNumbers();
            return view('auth.register', compact('array', 'setting'));
        }
    }

    protected function toRegister(Request $request)
    {
        if (isset($request->email)) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email',
                'result' => 'required|numeric|integer'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'mobile' => 'required|numeric|unique:users,mobile',
                'result' => 'required|numeric|integer'
            ]);
        }

        $array = $this->createRandomNumbers();

        if ($validator->fails()) {
            return response()->json(['registerError' => $validator->errors()->toArray(), 'array' => $array]);
        } else {
            $a = intval($request->input('a'));
            $b = intval($request->input('b'));
            $operator = $request->input('operator');
            $res = intval($request->input('result'));
            switch ($operator) {
                case '-':
                    $result = $a - $b;
                    break;
                case '+':
                    $result = $a + $b;
                    break;
            }
            if ($result === $res) {
                if (isset($request->email)) {
                    $email = $request->input('email');
                    $user = User::create(['email' => $email,]);
                    event(new Registered($user));
                    return response()->json(['email' => 'sent', 'id' => $user->id]);
                } else {
                    $mobile = $request->input('mobile');
                    $userCount = User::whereMobile($mobile)->get()->count();
                    $smsSetting = SmsSetting::first();

                    if ($userCount > 0) {

                        $user = User::whereMobile($mobile)->first();

                        if ($user->authStatus == '0') {

                            $randomDigits = $this->randomDigits();
                            $this->preRegister($randomDigits, $mobile);

                            $this->sendVerification($randomDigits, $mobile);
                            if (session()->get('sms') == 'error') {
                                return response()->json(['sms' => 'error', 'array' => $array]);
                            }
                            return response()->json(['code' => 'sent', 'mobile' => $mobile]);
                        } else {
                            return response()->json(['registerError' => 'userAlreadyExists', 'array' => $array]);
                            //error user already exists
                        }
                    } else {

                        $randomDigits = $this->randomDigits();

                        $this->preRegister($randomDigits, $mobile);
                        $bulk = $this->sendVerification($randomDigits, $mobile);
                        Sms::create([
                            'sms_sender_id' => 1,
                            'description' => 'ثبت نام',
                            'bulk_id' => $bulk,
                            'status' => 0
                        ]);
                        return response()->json(['code' => 'sent', 'bulk' => $bulk, 'mobile' => $mobile]);
                    }
                }


            } else {
                return response()->json(['result' => 'incorrect', 'array' => $array]);
            }


        }
    }

    protected function toCheckCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|numeric|digits:4'
        ]);
        if ($validator->fails()) {
            return response()->json(['verificationError' => $validator->errors()->all()]);
        } else {
            $mobile = $request->input('mobile');
            $code = $request->input('code');
            $preRegisterCount = PreRegister::where([['mobile', $mobile], ['code', $code]])->get()->count();
            if ($preRegisterCount > 0) {

                PreRegister::where([['mobile', $mobile], ['code', $code]])->delete();
                $userCount = User::whereMobile($mobile)->get()->count();
                if ($userCount > 0) {
                    $user = User::whereMobile($mobile)->first();
                    if ($user->authStatus == '0') {
                        return response()->json(['code' => 'correct', 'id' => $user->id, 'code']);
                    } else {
                        return response()->json(['verificationError' => 'userAlreadyExists']);
                    }
                } else {

                    $user = $this->createUser($mobile);
                    return response()->json(['code' => 'correct', 'id' => $user->id]);
                }
            } else {
                return response()->json(['verificationError' => 'incorrectCode']);
            }
        }
    }

    protected function preRegister($randomDigits, $mobile)
    {
        PreRegister::whereMobile($mobile)->delete();
        PreRegister::create(['mobile' => $mobile, 'code' => $randomDigits]);
    }

    protected function randomDigits()
    {
        return $randomDigits = rand(1000, 9999);
    }

    protected function createUser($mobile)
    {
        return $user = User::create([
            'mobile' => $mobile,
        ]);
    }

    protected function showEssentailsForm(Request $request, User $user)
    {
        strtok($_SERVER["REQUEST_URI"], '?');
        $familiarities = Familiarity::all();
        $categories = Category::all();
        if (Setting::all()->count() > 0) {
            $setting = Setting::all()->first();
        } else {
            $setting = null;
        }
        return view('auth.page-login',
            compact('user', 'familiarities', 'categories', 'setting'));
    }

    protected function storeEssentials(Request $request, User $user)
    {
        if ($user->is_primary == '1' && $user->authStatus == '0') {
            $familiaritiesCount = Familiarity::all()->count();
            $request->validate([
                'name' => 'required|string',
                'username' => 'required|regex:/^[a-zA-Z0-9 ]+$/',
                'password' => 'nullable|confirmed|min:6',
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
                'familiarity' => 'nullable|numeric|integer|min:1|max:' . $familiaritiesCount,
                'birthDate' => 'required',
                'cats' => 'required',
            ]);

            $password = Hash::make($request['password']);


            if (request()->hasFile('avatar')) {
                $avatar = time() . '.' . request()->avatar->getClientOriginalExtension();
                request()->avatar->move(public_path('images/user/'), $avatar);
            } else
                $avatar = null;
            $setting = Setting::all()->first();
            if ($setting->reg_type == 0){
                $email_verify = now();
            }else{
                $email_verify = Null;
            }
            $user->update([
                'name' => $request['name'],
                'username' => $request['username'],
                'email' => $request['email'],
                'password' => $password,
                'familiarity_id' => $request['familiarity'],
                'birthDate' => $this->convertToGoregianDate($request->input('birthDate')),
                'cats' => json_encode($request->cats),
                'avatar' => $avatar,
                'email_verified_at' => $email_verify,
                'authStatus' => 0,
                'is_primary' => "1"
            ]);
            Auth::login($user);
            return redirect(route('user.dashboard'))->with(['login' => 'success']);
        } else {
            abort(404);
        }

    }

    protected function reset(Request $request)
    {
        $array = $this->createRandomNumbers();
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string|numeric|exists:users,mobile',
            'result' => 'required|numeric|integer'
        ]);
        $mobile = $request['mobile'];
        $user = User::where([['mobile', $mobile], ['is_primary', '1']])->get()->first();
        $smsSetting = SmsSetting::first();
        if ($validator->fails()) {
            return back()
                ->withErrors($validator->errors())
                ->withInput()
                ->with(['reset' => 'error', 'array' => $array]);
        }
        if ($user->mobile === $mobile) {
            $randomDigits = rand(100000, 999999);
            $this->setKeys();
            $result = $this->sendFastSmsMokhaberat([$mobile], $smsSetting->p_password,
                ["pass" => "{$randomDigits}"]);

            if ($result != null) {
                $sms = Sms::create([
                    'sms_sender_id' => 1,
                    'user_id' => 0,
                    'description' => 'فراموشی رمز عبور',
                    'bulk_id' => $result,
                    'status' => 0
                ]);
            }
            $newPassword = Hash::make($randomDigits);
            $user->update(['password' => $newPassword]);
            return redirect(route('login'))->with(['resetPass' => 'sent']);
        } else {
            return back()->withInput()->with(['date' => 'incorrect', 'reset' => 'error']);
        }
    }

    protected function resendSms(Request $request)
    {
        if ($request->ajax()) {
            $mobile = $request->input('mobile');
            $type = $request->input('type');
            $smsSetting = SmsSetting::first();
            switch ($type) {
                case 'register':
                    if (PreRegister::where('mobile', $mobile)->get()->count() > 0) {
                        $code = PreRegister::where('mobile', $mobile)->first()->code;
                        if (Setting::all()->count() > 0 && Setting::all()->first()->brand != null) {
                            $name = Setting::all()->first()->brand;
                        } else {
                            $name = '';
                        }
                        $bulk = $this->sendFastSmsMokhaberat($mobile, $smsSetting->p_confirm_code,
                            ["VerificationCode" => $code]);
                        return response()->json(['code' => 'resent', 'bulk' => $bulk, 'mobile' => $mobile]);
                    } else {
                        return response()->json(['resend' => 'failed']);
                    }
                    break;
            }

        }
    }

}
