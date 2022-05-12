<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Adjust the existing program
        // return redirect(RouteServiceProvider::HOME);
        return $request->user()->hasVerifiedEmail() ? redirect($this->redirectPath()) : redirect()->route('verification.notice');
    }

    // Add to adjust the existing program
    public function confirm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:16',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|confirmed|min:8|max:16'
        ]);

        return view('register-confirm')->with('user', $validatedData);
    }

    // Add to adjust the existing program
    public function registerNotification()
    {
        return view('register-success');
    }
}
