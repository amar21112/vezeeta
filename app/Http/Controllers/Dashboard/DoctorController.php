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

    public function doctorAppointments(){
        $doctor = auth('doctor')->user();
        $doctor = $doctor->load('appointments');
        $doctor = $doctor->appointments->load('patient');
        return $doctor;
//        return view('dashboard.doctor.doctorAppointments',compact('doctorAppointments'));
    }
    public function addAppointmentForm()
    {
       return view('dashboard.doctor.addAppointment');
    }
    public function storeAppointment(Request $request){
        $doctor = auth('doctor')->user();
        $validated = $request->validate([
            'appointments'   => ['required','array'],
            'appointments.*' => ['required','date_format:Y-m-d\TH:i','after:now'],
            'price'=>['required','numeric','min:0','max:30000'],
        ]);
        if($validated){
            foreach ($validated['appointments'] as $dateTime) {
                $doctor->appointments()->create([
                    'appointment_date' => $dateTime,
                    'price'     => $validated['price'],
                ]);
            }
            return redirect()->route('doctor.appointments')->with(['success' => 'Appointment added successfully']);
        }
        return redirect()->route('doctor.appointments');
    }
    public function deleteAppointment($id){
        $doctor = auth('doctor')->user();
        $appointment = $doctor->appointments()->find($id);
        if($appointment){
            $appointment->delete();
        }

    }
}
