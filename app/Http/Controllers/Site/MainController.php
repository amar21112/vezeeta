<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MainController extends Controller
{
//    public function index(){
//        $data=[];
//        $data['doctor'] = Doctor::all();
//        $data['specialities'] = Specialist::all();
//
//        return $data;
////        return view('site.main.index', compact('data')); this will be your index page
//    }


    public function index(Request $request)
    {
        // Start query builder
        $doctors = Doctor::query();

        $validated = $request->validate([
            'governorate' => [
                'sometimes',
                'string',
                Rule::in(array_values(config('governorates')))
            ],
            'speciality'  => ['sometimes','integer','exists:specialists,id'],
        ]);


        // Filter by governorate if it exists in the URL
        if ($request->filled('governorate')) {

            $doctors->where('governorate', $request->governorate);
        }

        if ($request->filled('speciality')) {
            $doctors->whereHas('specialties', function($q) use ($request) {
                $q->where('specialists.id', $request->speciality);
            });
        }

        $data = [
            'doctor'       => $doctors->get(),
            'specialities' => Specialist::all(),
        ];

        // For Blade page:
        return view('index', compact('data'));

        // For API response:
        // return $data;
    }

    public function showDoctor($id){
        $doctor = Doctor::where('id', $id)->first();
        $doctor = $doctor->load('specialties');
        $doctor = $doctor->load('appointments');
        return $doctor;
//        return view('site.main.doctor', compact('doctor')); this will be your view for doctor to user
    }
}
