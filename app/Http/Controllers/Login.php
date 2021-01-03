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
    public function oauthLogin(Request $request)
    {
        // dd(Socialite::driver('google')->stateless()->user());
        $user = Socialite::driver('google')->stateless()->user();
        $email = $user->getEmail();
        $name = $user->name;

        if (!User::where('email', $email)->first()) {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => 'oauthLogin'
            ]);
        }
        $user = User::where('email', $email)->first();
        Auth::login($user);
        return redirect()->intended('dashboard');
    }
}
