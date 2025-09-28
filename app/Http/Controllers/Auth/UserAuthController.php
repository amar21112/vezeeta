<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\UserRegestrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('user.auth.login');
    }
    public function login(LoginRequest $request)
    {
        if (Auth('web')->attempt($request->validated())) {
            $user = Auth('web')->user();
            return redirect()->route('dashboard.patient.index')->with('success', 'Welcome back, ' . $user->name . '!');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout()
    {
        Auth('web')->logout();
        return redirect()->route('vezeeta.index')->with('success', 'You have been logged out successfully!');
    }


    public function showRegistrationForm()
    {
        return view('user.auth.register');
    }

    public function register(UserRegestrationRequest $request)
    {
        $user = User::create($request->validated());
        Auth('web')->login($user);
        return redirect()->route('dashboard.patient.index')->with('success', 'Welcome to Vezeeta, ' . $user->name . '! Your account has been created successfully.');
    }
}
