<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Specialist;
use App\Models\Appointment;
use App\Models\PatientAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the admin dashboard
     */
    public function index()
    {
        $stats = [
            'total_patients' => User::count(),
            'total_doctors' => Doctor::count(),
            'total_specialists' => Specialist::count(),
            'total_appointments' => PatientAppointment::count(),
            'pending_appointments' => PatientAppointment::where('status', 'pending')->count(),
            'completed_appointments' => PatientAppointment::where('status', 'completed')->count(),
            'cancelled_appointments' => PatientAppointment::where('status', 'cancelled')->count(),
            'active_doctors' => Doctor::where('is_active', true)->count(),
        ];

        $recent_appointments = PatientAppointment::with(['patient', 'appointment.doctor'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $recent_doctors = Doctor::with('specialties')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard.index', compact('stats', 'recent_appointments', 'recent_doctors'));
    }

    /**
     * Show all patients
     */
    public function patients(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
        }

        $patients = $query->paginate(15);

        return view('admin.dashboard.patients.index', compact('patients'));
    }

    /**
     * Show patient details
     */
    public function showPatient($id)
    {
        $patient = User::with(['patientAppointments.appointment.doctor'])->findOrFail($id);
        
        $appointments = $patient->patientAppointments()
            ->with('appointment.doctor')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.dashboard.patients.show', compact('patient', 'appointments'));
    }

    /**
     * Show all doctors
     */
    public function doctors(Request $request)
    {
        $query = Doctor::with('specialties');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
        }

        if ($request->has('specialist')) {
            $query->whereHas('specialties', function($q) use ($request) {
                $q->where('specialists.id', $request->get('specialist'));
            });
        }

        $doctors = $query->paginate(15);
        $specialists = Specialist::all();

        return view('admin.dashboard.doctors.index', compact('doctors', 'specialists'));
    }

    /**
     * Show doctor details
     */
    public function showDoctor($id)
    {
        $doctor = Doctor::with(['specialties', 'appointments'])->findOrFail($id);
        
        $appointments = $doctor->appointments()
            ->with(['patientAppointments.patient'])
            ->orderBy('appointment_date', 'desc')
            ->paginate(10);

        return view('admin.dashboard.doctors.show', compact('doctor', 'appointments'));
    }

    /**
     * Approve/Disapprove doctor
     */
    public function toggleDoctorStatus($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->is_active = !$doctor->is_active;
        $doctor->save();

        $status = $doctor->is_active ? 'approved' : 'suspended';
        return back()->with('success', "Doctor has been {$status} successfully.");
    }

    /**
     * Show all appointments
     */
    public function appointments(Request $request)
    {
        $query = PatientAppointment::with(['patient', 'appointment.doctor']);

        if ($request->has('status')) {
            $query->where('status', $request->get('status'));
        }

        if ($request->has('date_from')) {
            $query->whereHas('appointment', function($q) use ($request) {
                $q->where('date', '>=', $request->get('date_from'));
            });
        }

        if ($request->has('date_to')) {
            $query->whereHas('appointment', function($q) use ($request) {
                $q->where('date', '<=', $request->get('date_to'));
            });
        }

        $appointments = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.dashboard.appointments.index', compact('appointments'));
    }

    /**
     * Show appointment details
     */
    public function showAppointment($id)
    {
        $appointment = PatientAppointment::with(['patient', 'appointment.doctor'])
            ->findOrFail($id);

        return view('admin.dashboard.appointments.show', compact('appointment'));
    }

    /**
     * Update appointment status
     */
    public function updateAppointmentStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $appointment = PatientAppointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();

        return back()->with('success', 'Appointment status updated successfully.');
    }

    /**
     * Show admin profile
     */
    public function profile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.dashboard.profile', compact('admin'));
    }

    /**
     * Update admin profile
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins')->ignore($admin->id)],
            'phone' => 'nullable|string|max:20',
        ]);

        $admin->update($request->only(['name', 'email', 'phone']));

        return back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Change admin password
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $admin->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password changed successfully.');
    }

    /**
     * Show system settings
     */
    public function settings()
    {
        return view('admin.dashboard.settings');
    }

    /**
     * Show reports
     */
    public function reports()
    {
        $monthlyAppointments = PatientAppointment::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('count', 'month');

        $appointmentsByStatus = PatientAppointment::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $topSpecialists = Specialist::withCount(['doctors'])
            ->orderBy('doctors_count', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard.reports', compact(
            'monthlyAppointments',
            'appointmentsByStatus', 
            'topSpecialists'
        ));
    }

    /**
     * Show admins management
     */
    public function admins()
    {
        $admins = Admin::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.dashboard.admins.index', compact('admins'));
    }

    /**
     * Create new admin form
     */
    public function createAdmin()
    {
        return view('admin.dashboard.admins.create');
    }

    /**
     * Store new admin
     */
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.admins')->with('success', 'Admin created successfully.');
    }

    /**
     * Edit admin
     */
    public function editAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.dashboard.admins.edit', compact('admin'));
    }

    /**
     * Update admin
     */
    public function updateAdmin(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins')->ignore($admin->id)],
            'phone' => 'nullable|string|max:20',
        ]);

        $admin->update($request->only(['name', 'email', 'phone']));

        return redirect()->route('admin.admins')->with('success', 'Admin updated successfully.');
    }

    /**
     * Delete admin
     */
    public function deleteAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        
        if ($admin->id === Auth::guard('admin')->id()) {
            return back()->with('error', 'You cannot delete yourself.');
        }

        $admin->delete();

        return back()->with('success', 'Admin deleted successfully.');
    }
}