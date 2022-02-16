<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showlogin() {
        return view('auth.login');
    }

    public function login() {
        $attr = request()->validate([
            'email'=> 'required',
            'password'=> 'required',
        ]);

        if (Auth::attempt($attr)) {
            return redirect()->intended('/');
        }
        return redirect('/login');

    }

    public function logout() {
        auth()->logout();
        return redirect('/login');
    }
}
