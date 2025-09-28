<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Specialist;
use Illuminate\Http\Request;

class   DoctorController extends Controller
{
    public function profile(){
        $doctor = auth('doctor')->user()->load(['specialties', 'appointments']);
        
        // Calculate dashboard statistics - using availability to determine if appointment is booked
        $totalPatients = $doctor->appointments()
            ->where('availability', false)
            ->count(); // Approximating unique patients
            
        $todayAppointments = $doctor->appointments()
            ->whereDate('appointment_date', today())
            ->where('availability', false)
            ->count();
            
        $monthlyRevenue = $doctor->appointments()
            ->whereMonth('appointment_date', now()->month)
            ->whereYear('appointment_date', now()->year)
            ->where('availability', false)
            ->sum('price');
            
        $recentAppointments = $doctor->appointments()
            ->where('availability', false)
            ->orderBy('appointment_date', 'desc')
            ->take(5)
            ->get();
            
        $todayAppointmentsList = $doctor->appointments()
            ->whereDate('appointment_date', today())
            ->where('availability', false)
            ->orderBy('appointment_date', 'asc')
            ->get();

        return view('doctor.dashboard.profile', compact(
            'doctor', 
            'totalPatients', 
            'todayAppointments', 
            'monthlyRevenue', 
            'recentAppointments',
            'todayAppointmentsList'
        ));
    }

    public function addSpecialityForm(){
        $specialities = Specialist::all();
        $doctor = auth('doctor')->user()->load('specialties');
        return view('doctor.dashboard.specialities', compact('specialities', 'doctor'));
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
        $appointments = $doctor->appointments()->orderBy('appointment_date', 'desc')->get();
        
        // Calculate statistics - using availability to determine if appointment is booked
        $availableSlots = $doctor->appointments()->where('availability', true)->count();
        $bookedToday = $doctor->appointments()
            ->whereDate('appointment_date', today())
            ->where('availability', false)
            ->count();
        $thisWeekCount = $doctor->appointments()
            ->whereBetween('appointment_date', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();
        $totalRevenue = $doctor->appointments()
            ->where('availability', false)
            ->sum('price');
        
        return view('doctor.dashboard.appointments', compact(
            'appointments', 
            'availableSlots', 
            'bookedToday', 
            'thisWeekCount', 
            'totalRevenue'
        ));
    }
    public function addAppointmentForm()
    {
       return view('doctor.dashboard.add-appointment');
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
