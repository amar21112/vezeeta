<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\PatientAppointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PatientController extends Controller
{
    // Dashboard Home
    public function index()
    {
        $user = auth()->user();
        $appointmentsCount = $user->patientAppointments()->count();
        $upcomingAppointments = $user->patientAppointments()
            ->whereHas('appointment', function($query) {
                $query->where('date', '>=', now()->format('Y-m-d'));
            })
            ->count();
        // $completedAppointments = $user->patientAppointments()->where('status', 'completed')->count();

        return view('dashboard.patient.index', compact('user', 'appointmentsCount', 'upcomingAppointments'));
    }

    // Profile Management
    // public function profile()
    // {
    //     $user = auth()->user();
    //     return view('dashboard.patient.profile', compact('user'));
    // }


    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'birthday' => 'nullable|date',
        ]);
        
        $user->update($validated);
        
        return redirect()->route('patient.dashboard')
                        ->with('success', 'Profile updated successfully!');
    }

    // Appointments
    public function appointments()
    {
        $user = auth()->user();
        $appointments = $user->patientAppointments()
            ->with(['doctor', 'appointment'])
            ->join('appointments', 'patient_appointments.appointment_id', '=', 'appointments.id')
            ->orderBy('appointments.date', 'desc')
            ->orderBy('appointments.time', 'desc')
            ->select('patient_appointments.*')
            ->get();
        return view('dashboard.patient.appointments', compact('appointments'));
    }

    // public function appointmentHistory()
    // {
    //     $user = auth()->user();
    //     $appointments = $user->appointments()->with('doctor')
    //         ->where('appointment_date', '<', now())
    //         ->orderBy('appointment_date', 'desc')
    //         ->get();
    //     return view('dashboard.patient.appointment-history', compact('appointments'));
    // }

    public function bookAppointment(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
        ]);

        $appointment = Appointment::find($request->appointment_id);
        $patient = auth()->user();

        if ($appointment && $patient && $appointment->status === 'available') {
            // Create PatientAppointment record
            PatientAppointment::create([
                'user_id' => $patient->id,
                'doctor_id' => $appointment->doctor_id,
                'appointment_id' => $appointment->id,
                'status' => 'pending',
                'patient_name' => $patient->name,
                'patient_phone' => $patient->phone,
                'patient_email' => $patient->email,
            ]);
            
            // Update appointment status
            $appointment->update(['status' => 'booked']);

            return redirect()->route('patient.appointments')
                ->with('success', 'Appointment booked successfully!');
        }

        return redirect()->back()->with('error', 'Unable to book appointment.');
    }

    public function cancelAppointment(Request $request, $patientAppointmentId)
    {
        $patientAppointment = PatientAppointment::where('id', $patientAppointmentId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Update patient appointment status
        $patientAppointment->update(['status' => 'cancelled']);
        
        // Make the appointment available again
        $patientAppointment->appointment->update(['status' => 'available']);

        return redirect()->route('patient.appointments')
            ->with('success', 'Appointment cancelled successfully!');
    }

    public function rescheduleAppointment(Request $request, $patientAppointmentId)
    {
        $patientAppointment = PatientAppointment::where('id', $patientAppointmentId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $validated = $request->validate([
            'new_appointment_id' => 'required|exists:appointments,id'
        ]);

        // Cancel current appointment
        $patientAppointment->update(['status' => 'cancelled']);
        $patientAppointment->appointment->update(['status' => 'available']);

        // Create new patient appointment
        $newAppointment = Appointment::find($validated['new_appointment_id']);
        PatientAppointment::create([
            'user_id' => auth()->id(),
            'doctor_id' => $newAppointment->doctor_id,
            'appointment_id' => $newAppointment->id,
            'status' => 'pending',
            'patient_name' => auth()->user()->name,
            'patient_phone' => auth()->user()->phone,
            'patient_email' => auth()->user()->email,
        ]);
        
        // Update appointment status
        $newAppointment->update(['status' => 'booked']);

        return redirect()->route('patient.appointments')
            ->with('success', 'Appointment rescheduled successfully!');
    }

    // Medical Records
    public function medicalRecords()
    {
        $user = auth()->user();
        $medicalRecords = collect(); // TODO: Implement medical records model
        return view('dashboard.patient.medical-records', compact('medicalRecords'));
    }

    // public function prescriptions()
    // {
    //     $user = auth()->user();
    //     $prescriptions = collect(); // TODO: Implement prescriptions model
    //     return view('dashboard.patient.prescriptions', compact('prescriptions'));
    // }

    public function labResults()
    {
        $user = auth()->user();
        $labResults = collect(); // TODO: Implement lab results model
        return view('dashboard.patient.lab-results', compact('labResults'));
    }

    public function changePasswordForm()
    {
        return view('dashboard.patient.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('patient.dashboard')
            ->with('success', 'Password updated successfully!');
    }

    // Notifications
    // public function notifications()
    // {
    //     $user = auth()->user();
    //     $notifications = collect(); // TODO: Implement notifications
    //     return view('dashboard.patient.notifications', compact('notifications'));
    // }

    // public function markNotificationRead($notificationId)
    // {
    //     // TODO: Implement notification read functionality
    //     return redirect()->back()->with('success', 'Notification marked as read!');
    // }

    // Insurance
    public function insurance()
    {
        $user = auth()->user();
        return view('dashboard.patient.insurance', compact('user'));
    }

    public function updateInsurance(Request $request)
    {
        $validated = $request->validate([
            'insurance_provider' => 'nullable|string|max:255',
            'insurance_number' => 'nullable|string|max:255',
            'insurance_expiry' => 'nullable|date',
        ]);

        auth()->user()->update($validated);

        return redirect()->route('patient.insurance')
            ->with('success', 'Insurance information updated successfully!');
    }

    // Legacy methods for backward compatibility
    public function patientAppointments()
    {
        return $this->appointments();
    }

    public function bladeToPost()
    {
        return view('dashboard.book');
    }
}
