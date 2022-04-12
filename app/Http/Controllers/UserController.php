<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Support\Facades\Session;

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

        return view('register-confirm')->with('user', $validatedData);
    }

    public function register(Request $request)
    {
        $userData = ['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password)];

        $user = User::create($userData);

        event(new Registered($user));

        auth()->login($user);

        return $request->user()->hasVerifiedEmail() ? redirect($this->redirectPath()) : redirect()->route('verification.notice');
    }

    public function registerNotification()
    {
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
