<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
    //
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        # 帳密驗證成功
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        } else {
            # 若是沒有該帳號 直接註冊
            if (!User::where('email', $credentials['email'])->first()) {
                User::create([
                    'name' => 'new_user',
                    'email' => $credentials['email'],
                    'password' => Hash::make($credentials['password'])
                ]);
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }
            # 有此帳號 但密碼錯誤
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }
}
