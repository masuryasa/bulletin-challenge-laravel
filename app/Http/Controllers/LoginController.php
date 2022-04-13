<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:8|max:16'
        ]);

        if (Auth::attempt($credentials, $remember = true)) {
            $request->session()->regenerate();

            if (auth()->user()->email == "admin@gmail.com") {
                return redirect()->route('admin.index');
            }

            return redirect('')->with('loginStatus', ', you are logged in now.');
        }
        return back()->with('loginStatus', 'Login Failed! Please try again.');
    }

    public function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect('');
    }
}
