<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use App\Traits\Randomable;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, Randomable;

    public function showLoginForm()
    {
        $array = $this->createRandomNumbers();
        return view('auth.login', compact('array'));
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required',
            'password' => 'required|string',
        ]);


    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath())->with(['login' => 'success']);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'username' => [trans('auth.failed')],
        ]);
    }


    protected function attemptLogin(Request $request)
    {


        if ($this->username() == 'mobile') {
            $user = User::where('mobile', $request->username)->first();

        } elseif ($this->username() == 'email') {
            $user = User::where('email', $request->username)->first();
        } else {
            $user = User::where('username', $request->username)->first();
        }


        if ($user) {
            $salt = md5(($user->id + 1) * 2020 + 22);

            $hash = \hash('sha512', $salt . $request->password);
            if (\hash_equals($user->getAuthPassword(), $hash)){

                $this->guard()->login($user, $request->has('remember'));
                return true;
            }

        }


        return false;
    }

    public function username()
    {
        $login = request()->input('username');

        if (is_numeric($login)) {
            $field = 'mobile';
        } elseif (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        } else {
            $field = 'username';
        }

        request()->merge([$field => $login]);

        return $field;

    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/login');
    }

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
