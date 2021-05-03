<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
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
    
    

    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(){
        $credentials = request();
        if(Auth::attempt($credentials->only(['email','password']))){
            session()->regenerate();
            return redirect()->route('products.index');
        }
        else{
            return back()->withErrors([
                  'email' => 'Email or password is incorrect.'
                ])->withInput();
        }
    }

    //override usual behavior in logging out
    public function logout(){
        Auth::logout();
        session()->invalidate();
        session()->regenerate();
        return redirect()->route('login');
    }
}
