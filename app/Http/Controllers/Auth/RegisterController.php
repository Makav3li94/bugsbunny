<?php

namespace App\Http\Controllers\Auth;

use App\Models\PreRegister;
use App\Traits\Randomable;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use SoapClient;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    public function showRegistrationForm()
    {
        return view('auth.register', compact('array'));
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'mobile' => ['required', 'regex:/[09][0-9]{9}/', 'unique:users,mobile', 'numeric'],
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|numeric|regex:/[09][0-9]{9}/'
        ]);
        if ($validator->fails()) {
        } else {
            $mobile = $request->input('mobile');
            $userCount = User::whereMobile($mobile)->get()->count();
            if ($userCount > 0) {
                $user = User::whereMobile($mobile)->first();
                if ($user->authStatus == '0') {
                    //SMS
                    //CORRECT
                    //Page-Login
                } else {
                    //error user already exists
                }
            } else {
                //sms
            }
        }
        $this->validator($request->all())->validate();
        $randomDigits = $this->randomDigits();
        $response = $this->registerSMS($request, $randomDigits);
        return $response;
//        event(new Registered($user = $this->create($request->all())));
//
//        $this->guard()->login($user);
//
//        return $this->registered($request, $user)
//            ?: redirect($this->redirectPath());
    }

    protected function registerSMS($request, $randomDigits)
    {
        $client = new SoapClient("http://37.130.202.188/class/sms/wsdlservice/server.php?wsdl");
        $user = "visanew";
        $pass = "visanew97";
        $fromNum = "+98100020400";
        $toNum = array("{$request['mobile']}");
        $pattern_code = "146";
        $input_data = array("confirmation-code" => "{$randomDigits}");
        $result = $client->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);

    }

    protected function preRegister($code, $mobile)
    {
        PreRegister::whereMobile($mobile)->delete();
        PreRegister::create(['mobile' => $mobile, 'code' => $code]);
    }

    protected function randomDigits()
    {
        return rand(1000, 9999);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
