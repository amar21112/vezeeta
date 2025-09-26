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
    public function showLoginForm(){
        return view('admin.auth.login');
    }
    public function login(AdminLoginRequest $request)
    {
      if(Auth('admin')->attempt($request->validated())){
          $user = Auth('admin')->user();
          return $user;
      }

      return redirect()->route('login');
    }

    public function logout(){
        Auth('admin')->logout();
        return redirect()->route('welcome');
    }


    public function showRegistrationForm(){
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

        // Return JSON response
        return response()->json(['admin' => $admin]);
    }



}
