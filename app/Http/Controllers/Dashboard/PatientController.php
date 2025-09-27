<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function patientAppointments(){
        $patient = auth()->user();
        $appointments = $patient->appointments->load('doctor');

        return $appointments;
    }

    public function bladeToPost(){
        return view('dashboard.book');
    }
    public function bookAppointment(Request $request){
        $request->validate([
            'id' => 'required|exists:appointments,id',
        ]);

        $appointment = Appointment::find($request->id);
        $patient = auth()->user();
        if($appointment && $patient){
            $appointment->patient()->associate($patient)->save();
            $appointment->availability = false;
            $appointment->save();
        }

        return $appointment->load('doctor');
    }
}
