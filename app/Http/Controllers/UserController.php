<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function confirm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:16',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|min:8|max:16'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        return view('register-confirm')->with('user', $validatedData);
    }

    public function register(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $user = ['name' => $name, 'email' => $email, 'password' => $password];

        DB::table('users')->insertGetId($user);

        return view('register-success');
    }

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

            return redirect('')->with('loginStatus', ', you are logged in now.');
        }

        return back()->with('loginStatus', 'Login Failed! Please try again.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('');
    }
}
