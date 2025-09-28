<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Specialist;
use App\Models\Appointment;
use App\Models\PatientAppointment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

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

    // ===== NEW API METHODS FOR HOME PAGE SEARCH =====
    
    /**
     * Get all specialties for search dropdown
     */
    public function getSpecialties()
    {
        try {
            $specialties = Specialist::select('id', 'special_name as name')
                ->orderBy('special_name')
                ->get();
            
            return response()->json([
                'success' => true,
                'data' => $specialties
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch specialties',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all cities/governorates for search dropdown
     */
    public function getCities()
    {
        try {
            $governorates = config('governorates');
            
            // Transform to consistent format
            $cities = [];
            foreach ($governorates as $key => $value) {
                $cities[] = [
                    'value' => $value,
                    'label' => ucwords(str_replace('_', ' ', $key))
                ];
            }
            
            return response()->json([
                'success' => true,
                'data' => $cities
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch cities',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search doctors with multiple filters
     */
    public function searchDoctors(Request $request)
    {
        try {
            $request->validate([
                'specialty' => 'nullable|string',
                'city' => 'nullable|string',
                'area' => 'nullable|string',
                'query' => 'nullable|string|max:255',
                'search_type' => 'nullable|in:book_doctor,telehealth',
                'telehealth_type' => 'nullable|in:video,audio,chat',
                'per_page' => 'nullable|integer|min:1|max:50'
            ]);

            $doctors = Doctor::with(['specialties', 'appointments'])
                ->where('is_active', true); // Only active doctors

            // Filter by specialty
            if ($request->filled('specialty')) {
                $doctors->whereHas('specialties', function($q) use ($request) {
                    $q->where('specialists.special_name', 'like', '%' . $request->specialty . '%')
                      ->orWhere('specialists.id', $request->specialty);
                });
            }

            // Filter by city/governorate
            if ($request->filled('city') && $request->city !== 'all') {
                $doctors->where('governorate', $request->city);
            }

            // Filter by area (if you have area field in doctors table)
            if ($request->filled('area') && $request->area !== 'all') {
                $doctors->where('area', 'like', '%' . $request->area . '%');
            }

            // Search by doctor name or hospital
            if ($request->filled('query')) {
                $query = $request->query;
                $doctors->where(function($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%')
                      ->orWhere('hospital_name', 'like', '%' . $query . '%')
                      ->orWhere('bio', 'like', '%' . $query . '%');
                });
            }

            // Handle telehealth filtering if needed
            if ($request->search_type === 'telehealth') {
                // Assuming you have a telehealth_available field or similar
                $doctors->where('telehealth_available', true);
            }

            $perPage = $request->get('per_page', 12);
            $result = $doctors->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $result,
                'filters_applied' => [
                    'specialty' => $request->specialty,
                    'city' => $request->city,
                    'area' => $request->area,
                    'query' => $request->query,
                    'search_type' => $request->search_type
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Search failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all doctors
     */
    public function getAllDoctors(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 20);
            
            $doctors = Doctor::with(['specialties', 'appointments'])
                ->where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $doctors
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch doctors',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get specific doctor with details
     */
    public function getDoctor($id)
    {
        try {
            $doctor = Doctor::with(['specialties', 'appointments' => function($q) {
                $q->where('date', '>=', now()->format('Y-m-d'))
                  ->orderBy('date')
                  ->orderBy('time');
            }])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $doctor
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Doctor not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Get appointments for a specific doctor
     */
    public function getDoctorAppointments($id, Request $request)
    {
        try {
            $request->validate([
                'date_from' => 'nullable|date',
                'date_to' => 'nullable|date|after_or_equal:date_from',
                'status' => 'nullable|in:available,booked,cancelled'
            ]);

            $query = Appointment::where('doctor_id', $id);

            // Filter by date range
            if ($request->filled('date_from')) {
                $query->whereDate('date', '>=', $request->date_from);
            }
            
            if ($request->filled('date_to')) {
                $query->whereDate('date', '<=', $request->date_to);
            } else {
                // Default to future appointments only
                $query->whereDate('date', '>=', now()->format('Y-m-d'));
            }

            // Filter by status
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $appointments = $query->orderBy('date')
                ->orderBy('time')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $appointments,
                'doctor_id' => $id
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch appointments',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ===== ENHANCED PAGE METHODS =====
    
    /**
     * Doctors listing page
     */
    public function doctorsPage(Request $request)
    {
        // Validate request parameters
        $request->validate([
            'specialty' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'area' => 'nullable|string|max:255',
            'query' => 'nullable|string|max:255',
            'search_type' => 'nullable|in:book_doctor,telehealth',
            'telehealth_type' => 'nullable|in:video,audio,chat',
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:5|max:100'
        ]);

        // Start building the doctors query
        $doctors = Doctor::with(['specialties', 'appointments' => function($q) {
            $q->where('date', '>=', now()->format('Y-m-d'))
              ->where('status', 'available')
              ->orderBy('date')
              ->orderBy('time');
        }])->where('is_active', true);

        // Apply filters
        if ($request->filled('specialty')) {
            $doctors->whereHas('specialties', function($q) use ($request) {
                $q->where('specialists.special_name', 'like', '%' . $request->specialty . '%')
                  ->orWhere('specialists.id', $request->specialty);
            });
        }

        if ($request->filled('city') && $request->city !== 'all') {
            $doctors->where('governorate', $request->city);
        }

        if ($request->filled('area') && $request->area !== 'all') {
            $doctors->where('city', 'like', '%' . $request->area . '%');
        }

        if ($request->filled('query')) {
            $query = $request->query;
            $doctors->where(function($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                  ->orWhere('surname', 'like', '%' . $query . '%')
                  ->orWhere('about', 'like', '%' . $query . '%')
                  ->orWhereRaw("CONCAT(name, ' ', surname) LIKE ?", ['%' . $query . '%']);
            });
        }

        // Handle telehealth filtering if needed
        if ($request->search_type === 'telehealth') {
            // Add telehealth filtering logic here if you have such fields
            // $doctors->where('telehealth_available', true);
        }

        // Get paginated results
        $perPage = $request->get('per_page', 15); // Default to 15 items per page
        $doctorsData = $doctors->paginate($perPage)->appends($request->query());

        // Prepare data for the view
        $data = [
            'doctors' => $doctorsData,
            'specialties' => Specialist::orderBy('special_name')->get(),
            'cities' => config('governorates'),
            'searchParams' => $request->only(['specialty', 'city', 'area', 'query', 'search_type', 'telehealth_type']),
            'totalDoctors' => $doctorsData->total()
        ];

        return view('doctors', compact('data'));
    }

    /**
     * Single doctor profile page
     */
    public function doctorProfile($id)
    {
        try {
            $doctor = Doctor::with(['specialties', 'appointments' => function($q) {
                $q->where('date', '>=', now()->format('Y-m-d'))
                  ->where('status', 'available')
                  ->orderBy('date')
                  ->orderBy('time');
            }])->findOrFail($id);

            return view('doctor-profile', compact('doctor'));
        } catch (\Exception $e) {
            abort(404, 'Doctor not found');
        }
    }

    /**
     * Helper method for doctors page search (legacy - now integrated into doctorsPage)
     */
    private function searchDoctorsForPage($request)
    {
        $doctors = Doctor::with(['specialties', 'appointments' => function($q) {
            $q->where('date', '>=', now()->format('Y-m-d'))
              ->where('status', 'available')
              ->orderBy('date')
              ->orderBy('time');
        }])->where('is_active', true);

        if ($request->filled('specialty')) {
            $doctors->whereHas('specialties', function($q) use ($request) {
                $q->where('specialists.special_name', 'like', '%' . $request->specialty . '%')
                  ->orWhere('specialists.id', $request->specialty);
            });
        }

        if ($request->filled('city') && $request->city !== 'all') {
            $doctors->where('governorate', $request->city);
        }

        if ($request->filled('query')) {
            $query = $request->query;
            $doctors->where(function($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                  ->orWhere('surname', 'like', '%' . $query . '%')
                  ->orWhereRaw("CONCAT(name, ' ', surname) LIKE ?", ['%' . $query . '%']);
            });
        }

        return $doctors->paginate(12);
    }
    
    /**
     * Show create reservation form
     */
    public function showCreateReservation(Request $request)
    {
        $doctorId = $request->get('doctor_id');
        $date = $request->get('date');
        $time = $request->get('time');
        
        if (!$doctorId || !$date || !$time) {
            return redirect()->route('doctors.page')->with('error', 'Invalid appointment data');
        }
        
        try {
            $doctor = Doctor::with(['specialties', 'appointments'])->findOrFail($doctorId);
            
            // Verify the appointment slot exists and is available
            $appointment = Appointment::where('doctor_id', $doctorId)
                ->where('date', $date)
                ->where('time', $time)
                ->where('status', 'available')
                ->first();
                
            if (!$appointment) {
                return redirect()->route('doctor.profile', $doctorId)->with('error', 'This appointment slot is no longer available');
            }
            
            return view('create-reservation', compact('doctor', 'appointment'));
            
        } catch (\Exception $e) {
            return redirect()->route('doctors.page')->with('error', 'Doctor not found');
        }
    }
    
    /**
     * Store a new reservation
     */
    public function storeReservation(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date',
            'time' => 'required',
            'patient_name' => 'required|string|max:255',
            'patient_phone' => 'required|string|max:20',
            'patient_email' => 'required|email|max:255',
            'booking_for_another' => 'boolean'
        ]);
        
        try {
            DB::beginTransaction();
            
            // Find the appointment by doctor_id, date, and time
            $appointment = Appointment::where('doctor_id', $request->doctor_id)
                ->where('date', $request->date)
                ->where('time', $request->time)
                ->where('status', 'available')
                ->lockForUpdate()
                ->first();
                
            if (!$appointment) {
                return back()->withErrors(['appointment' => 'This appointment slot is no longer available']);
            }
            
            // Create patient appointment record
            $patientAppointment = PatientAppointment::create([
                'user_id' => auth()->id(),
                'doctor_id' => $request->doctor_id,
                'appointment_id' => $appointment->id,
                'status' => 'pending',
                'patient_name' => $request->patient_name,
                'patient_phone' => $request->patient_phone,
                'patient_email' => $request->patient_email,
            ]);
            
            // Update appointment status to booked
            $appointment->update(['status' => 'booked']);
            
            DB::commit();
            
            return redirect()->route('reservation.success', $patientAppointment->id)
                ->with('success', 'Your appointment has been booked successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'An error occurred while booking your appointment. Please try again.']);
        }
    }
    
    /**
     * Show reservation success page
     */
    public function reservationSuccess($id)
    {
        $reservation = PatientAppointment::with(['doctor', 'appointment'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);
            
        return view('reservation-success', compact('reservation'));
    }
}
