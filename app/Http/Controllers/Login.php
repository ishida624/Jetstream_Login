<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Login extends Controller
{
    //
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        return app('LoginService')->Login($credentials);
    }
    public function oauthAgree()
    {
        return Socialite::driver('google')->redirect();
    }
    public function oauthLogin()
    {
        return app('LoginService')->oauthLogin();
    }
}
