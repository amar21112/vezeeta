<?php

namespace App\Custome;

use App\Http\Requests\Auth\LoginRequest;

class AuthService
{
    public function loginUser(LoginRequest $request)
    {
        $auth ='';
        if($request->validated('type') == 'doctor'){
             if(Auth('doctor')->attempt($request->validated(['email','password']))){
                 $auth = Auth('doctor')->user();
                 return $auth;
             }
        }elseif ($request->validated('type') == 'patient'){
            if(Auth()->attempt($request->validated(['email','password']))){
                $auth = Auth()->user();
                return $auth;
            }
        }
        return 'error';
    }


}
