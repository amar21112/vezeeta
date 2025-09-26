<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\UserRegestrationRequest;
use App\Models\User;

class UserAuthController extends Controller
{
    public function showLoginForm(){
        return view('user.auth.login');
    }
    public function login(LoginRequest $request)
    {
      if(Auth('web')->attempt($request->validated())){
          $user = Auth('web')->user();
          return $user;
      }

      return redirect()->route('login');
    }

    public function logout(){
        Auth('web')->logout();
        return redirect()->route('welcome');
    }


    public function showRegistrationForm(){
        return view('user.auth.register');
    }

    public function register(UserRegestrationRequest $request)
    {
        $user = User::create($request->validated());
        Auth('web')->login($user);
        return response()->json(['user' => $user]);
    }



}
