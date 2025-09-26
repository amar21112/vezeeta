<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\DoctorLoginRequest;
use App\Http\Requests\Auth\DoctorRegestrationRequest;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorAuthController extends Controller
{
    public function showLoginForm(){
        return view('doctor.auth.login');
    }
    public function login(DoctorLoginRequest $request)
    {
      if(Auth('doctor')->attempt($request->validated())){
          $user = Auth('doctor')->user();
          return $user;
      }

      return redirect()->route('login');
    }

    public function logout(){
        Auth('doctor')->logout();
        return redirect()->route('welcome');
    }


    public function showRegistrationForm(){
        return view('doctor.auth.register');
    }

    public function register(DoctorRegestrationRequest $request)
    {
        $data = $request->validated();

        // Hash the password before saving
        $data['password'] = Hash::make($data['password']);

        // Create the doctor
        $doctor = Doctor::create($data);

        // Log in using the doctor guard
        Auth::guard('doctor')->login($doctor);

        // Return JSON response
        return redirect()->route('doctor.selectSpecialities');
    }

}
