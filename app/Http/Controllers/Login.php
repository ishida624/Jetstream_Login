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
        return app('LoginService')->Login($credentials);
    }
}
