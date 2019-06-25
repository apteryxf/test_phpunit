<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;

use App\User;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $secretKey = $request->input('secret_key');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->g2fa_key) {
                $g2fa = new Google2FA();
                if ($g2fa->verifyKey($user->g2fa_key, $secretKey)) {
                    return redirect()->intended();
                } else {
                    return redirect()->route('login');
                }
            }
        }

        return redirect()->route('login');
    }
}
