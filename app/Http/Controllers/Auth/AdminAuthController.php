<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Http\Requests\Auth\AdminRegestrationRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        // If admin is already authenticated, redirect to dashboard
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.auth.login');
    }
    public function login(AdminLoginRequest $request)
    {
        if (Auth('admin')->attempt($request->validated())) {
            $request->session()->regenerate();
            
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth('admin')->logout();
        return redirect()->route('index');
    }


    public function showRegistrationForm()
    {
        // If admin is already authenticated, redirect to dashboard
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.auth.register');
    }

    public function register(adminRegestrationRequest $request)
    {
        $data = $request->validated();

        // Hash the password before saving
        $data['password'] = Hash::make($data['password']);

        // Create the admin
        $admin = Admin::create($data);

        // Log in using the admin guard
        Auth::guard('admin')->login($admin);

        // Redirect to admin dashboard with success message
        return redirect()->route('admin.dashboard')->with('success', 'Welcome! Your admin account has been created successfully.');
    }
}
