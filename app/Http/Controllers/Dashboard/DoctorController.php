<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class   DoctorController extends Controller
{
    public function profile(){
        $doctor = auth('doctor')->user();
        return view('doctor.profile' , compact('doctor'));
    }

    public function addSpeciality(){
        return view('doctor.addSpeciality');
    }

    public function storeSpeciality(Request $request){

        $doctor = auth('doctor')->user();

        $validate = $request->validate([
            'id'          => 'required|array',
            'id.*'        => 'integer|exists:specialist,id',
        ]);

        $doctor->specialties()->sync($validate);
    }

    public function updateSpeciality(Request $request){
        $doctor = auth('doctor')->user();
        $validate = $request->validate([
            'id'          => 'required|array',
            'id.*'        => 'integer|exists:specialist,id',
        ]);
        $doctor->specialties()->sync($validate);
    }
}
