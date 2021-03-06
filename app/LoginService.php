<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class LoginService
{
    public function Login($credentials)
    {
        # 帳密驗證成功
        if (Auth::attempt($credentials)) {
            // dd(Auth::user());
            return redirect()->intended('dashboard');
        } else {
            # 若是沒有該帳號 直接註冊
            if (!User::where('email', $credentials['email'])->first()) {
                User::create([
                    'name' => 'new_user',
                    'email' => $credentials['email'],
                    'password' => Hash::make($credentials['password'])
                ]);
                $user = User::where('email', $credentials['email'])->first();
                Auth::login($user);
                return redirect()->intended('dashboard');
            }
            # 有此帳號 但密碼錯誤
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }
    public function oauthLogin()
    {
        # code...
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
        if ($user->password != 'oauthLogin') {
            return back()->withErrors([
                'email' => $email . 'This account already exist',
            ]);
        }
        Auth::login($user);
        return redirect()->intended('dashboard');
    }
}
