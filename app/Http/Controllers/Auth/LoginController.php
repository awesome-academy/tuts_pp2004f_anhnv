<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin_auth')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function guard()
    {
        return Auth::guard();
    }

    public function login(Request $request)
    {
        $validator = $this->validator($request->all());
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if($this->attempLogin($request)){
            $this->sendLoginResponse($request);
            return redirect('admin');
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect()->route('admin.login');
    }

    protected function validator(array $array)
    {
        return Validator::make($array, [
            $this->username() => 'required|string',
            'password' => 'required|string|min:8'
        ], [
            'password.required' => 'Password ko dc de trong',
            'password.min' => 'Password toi thieu dai 8 ki tu'
        ]);
    }

    protected function username()
    {
        return 'email';
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    protected function attempLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);
        return $this->authenticated($request, $this->guard()->user()) ? : redirect()->intended($this->redirectPath());
    }

}
