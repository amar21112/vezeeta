<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Specialist;
use Illuminate\Http\Request;

class   DoctorController extends Controller
{
    public function profile(){
        $doctor = auth('doctor')->user()->load('specialties');

//        return view('doctor.profile' , compact('doctor'));
        return $doctor;
    }

    public function addSpecialityForm(){
        $specialities = Specialist::all();
        return view('dashboard.doctor.addSpeciality' ,compact('specialities'));
    }

    public function storeSpeciality(Request $request){

        $doctor = auth('doctor')->user();

        $validate = $request->validate([
            'specialities'   => ['required','array'],
            'specialities.*' => ['integer','exists:specialists,id'],
        ]);
        if($validate){
            $doctor->specialties()->sync($request->specialities);
            return redirect()->route('doctor.profile')->with(['success' => 'Speciality added successfully']);
        }

        return redirect()->route('doctor.profile');

    }
}
