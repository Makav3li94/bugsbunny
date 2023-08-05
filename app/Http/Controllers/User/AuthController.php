<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\Familiarity;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Sms;
use App\Models\PreRegister;
use App\Models\SmsSetting;
use App\Traits\Helpers;
use App\Traits\Numbers;
use App\Traits\Randomable;
use App\Traits\SmsableMokhaberat;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use SmsableMokhaberat, Randomable, Numbers, Helpers;

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

            $array = $this->createRandomNumbers();
            return view('auth.register', compact('array'));
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
                'mobile' => 'required|regex:/(09)[0-9]{9}/|digits:11|numeric|unique:users,mobile',
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
                        $bulk = $this->sendFastSmsMokhaberat($mobile, $smsSetting->p_confirm_code,
                            ["VerificationCode" => $randomDigits]);
                        Sms::create([
                            'sms_sender_id' => 1,
                            'description' => 'ثبت نام',
                            'bulk_id' => $bulk['VerificationCodeId'],
                            'status' => 0
                        ]);
                        return response()->json(['code' => 'sent', 'mobile' => $mobile]);
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
            $preRegisterCount = PreRegister::where([['mobile', $mobile], ['code', $code],['times','<=',2]])->get()->count();
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
                $preRegister = PreRegister::where([['mobile', $mobile], ['code', $code]])->first();
                $preRegister->increment('times');
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

        return view('auth.page-login',
            compact('user', 'familiarities'));
    }

    protected function storeEssentials(Request $request, User $user)
    {
        if ($user->is_primary == '1' && $user->authStatus == '0') {
            $familiaritiesCount = Familiarity::all()->count();
            $setting = Setting::all()->first();
            if ($setting->reg_type == 0) {
                $request->validate([
                    'name' => 'required|string',
                    'username' => 'required|regex:/^[a-zA-Z0-9 ]+$/|unique:users,username',
                    'password' => 'required|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|min:8',
                    'email' => 'required|email|unique:users,email',
                    'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
                    'familiarity' => 'nullable|numeric|integer|min:1|max:' . $familiaritiesCount,
                    'birthDate' => 'required',
                    'cats' => 'required',
                ]);
            } else {
                $request->validate([
                    'name' => 'required|string',
                    'username' => 'required|regex:/^[a-zA-Z0-9 ]+$/|unique:users,username',
                    'password' => 'required|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|min:8',
                    'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
                    'familiarity' => 'nullable|numeric|integer|min:1|max:' . $familiaritiesCount,
                    'birthDate' => 'required',
                    'cats' => 'required',
                ]);
            }
            $password = $this->passHasher($request['password']);

            if (request()->hasFile('avatar')) {
                $avatar = time() . '.' . request()->avatar->getClientOriginalExtension();
                request()->avatar->move(public_path('storage2/user/avatar/'), $avatar);
            } else
                $avatar = null;
            $setting = Setting::all()->first();
            if ($setting->reg_type == 0) {
                $email_verify = now();
            } else {
                $email_verify = Null;
            }
            $user->update([
                'name' => $request['name'],
                'username' => $request['username'],
                'email' => $request['email'],
                'mobile' => $request['mobile'] ?? $user->mobile,
                'password' => $password,
                'familiarity_id' => $request['familiarity'],
                'birthDate' => $this->convertToGoregianDate($request->input('birthDate')),
                'cats' => json_encode($request->cats),
                'avatar' => $avatar,
                'email_verified_at' => $email_verify,
                'authStatus' => 0,
                'is_primary' => "1"
            ]);
            DB::table('pre_registers')->where('mobile', $user->mobile)
                ->delete();
            Auth::login($user);
            event(new Registered($user));
            $this->notifyAdmin($user->id, $user->name, $user->mobile, 'register', $user->id, 0, 'کاربر ثبت نام کرد.');
            return redirect(route('user.dashboard'))->with(['login' => 'success']);
        } else {
            abort(404);
        }

    }

    protected function reset(Request $request)
    {
        $array = $this->createRandomNumbers();
        $username = $request['username'];

        if (is_numeric($username)) {
            $field = 'mobile';
            $validator = Validator::make($request->all(), [
                'username' => 'required|exists:users,mobile',
                'result' => 'required|numeric|integer'
            ]);
        } elseif (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
            $validator = Validator::make($request->all(), [
                'username' => 'required|exists:users,email',
                'result' => 'required|numeric|integer'
            ]);
        } else {
            $field = 'username';
        }


        if ($validator->fails()) {
            return back()
                ->withErrors($validator->errors())
                ->withInput()
                ->with(['reset' => 'error', 'array' => $array]);
        }
        if ($field == 'mobile') {
            $user = User::where([['mobile', $username], ['is_primary', '1']])->orWhere('email', $username)->get()->first();
            $smsSetting = SmsSetting::first();

            if ($user->mobile === $username) {
                $mobile = $user->mobile;
                $token = $this->randomDigits();
                $this->preRegister($token, $username);
                $bulk = $this->sendFastSmsMokhaberat($username, $smsSetting->p_password,
                    ["NewPass" => $token]);
                if ($bulk != null) {
                    Sms::create([
                        'sms_sender_id' => 1,
                        'description' => 'تغییر رمز عبور',
                        'bulk_id' => $bulk['VerificationCodeId'],
                        'status' => 0
                    ]);
                }
                return view('auth.passwords.resetPassForm', compact('mobile'));
            } else {
                return back()->withInput()->with(['date' => 'incorrect', 'reset' => 'error']);
            }
        } else {
            $status = Password::sendResetLink(
                ['email' => $username]
            );
            return $status === Password::RESET_LINK_SENT
                ? back()->with(['resetPass' => 'sent'])
                : back()->withErrors(['email' => __($status)]);
        }

    }

    public function resetForm(Request $request)
    {
        $token = $request->token;
        $email = $request->email;
        return view('auth.passwords.reset', compact('token', 'email'));
    }

    public function resetPassForm(Request $request)
    {
        $token = $request->token;
        $mobile = $request->username;
        return view('auth.passwords.resetPassForm', compact('token', 'mobile'));
    }

    protected function resetPassword(Request $request)
    {
        //Validate input
        if (isset($request->email)) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|min:8',
                'token' => 'required']);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => $this->passHasher($password, $user)
                    ])->setRememberToken(Str::random(60));

                    $user->save();
                    Auth::login($user);

                    //Delete the token
                    DB::table('password_resets')->where('email', $user->email)
                        ->delete();
                    return redirect()->route('user.dashboard')->with(['login' => 'success']);
                }
            );

            return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with(['resetPass' => 'sent'])
                : back()->withErrors(['email' => [__($status)]]);
        } else {


            $mobile = $request->input('mobile');
            $code = $request->input('token');
            $preRegisterCount = PreRegister::where([['mobile', $mobile], ['code', $code],['times','<=',2]])->get()->count();

            if ($preRegisterCount > 0) {
                $validator = Validator::make($request->all(), [
                    'mobile' => 'required|exists:users,mobile',
                    'password' => 'required|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|min:8',
                    'token' => 'required|numeric|digits:4']);
                if ($validator->fails()) {
                    $preRegister = PreRegister::where([['mobile', $mobile], ['code', $code]])->first();
                    $preRegister->increment('times');
                    return back()->withErrors($validator->errors())->withInput($request->all());
                }
                PreRegister::where([['mobile', $mobile], ['code', $code]])->delete();
                $user = User::whereMobile($mobile)->first();
                if ($user) {
                    $user->forceFill([
                        'password' => $this->passHasher($request->password, $user)
                    ])->setRememberToken(Str::random(60));

                    $user->save();
                    Auth::login($user);

                    //Delete the token
                    DB::table('pre_registers')->where('mobile', $user->mobile)
                        ->delete();
                    return redirect()->route('user.dashboard')->with(['login' => 'success']);
                }
            } else {
                return back()->withErrors(["token" => "توکن یا اشتباه است یا منقضی شده است."])->withInput($request->all());
            }
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

    /**
     * @param $password1
     * @return false|string
     */
    private function passHasher($password1, $user = null): string|false
    {
        if ($user == null) {
            if (User::withTrashed()->orderBy('id', 'desc')->count() == 0) {
                $peper = 1;
            } else {
                $peper = User::withTrashed()->orderBy('id', 'desc')->first()->id + 1;
            }
        } else {
            $peper = $user->id + 1;
        }
        $salt = md5($peper * 2020 + 22);
        $password = \hash('sha512', $salt . $password1);
//        dd($peper . " - " .$salt. " - " .$password);
        return $password;
    }

}
