<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DoctorController extends Controller
{
    /**
     * Search and filter doctors
     */
    public function search(Request $request)
    {
        $validated = $request->validate([
            'specialty' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'area' => ['nullable', 'string', 'max:255'],
            'query' => ['nullable', 'string', 'max:255'],
            'search_type' => ['nullable', 'string', 'in:book_doctor,telehealth'],
            'telehealth_type' => ['nullable', 'string', 'in:video,audio,chat'],
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:50']
        ]);

        // Start building the query
        $doctorsQuery = Doctor::with(['specialties'])
            ->where('is_active', true); // Only active doctors

        // Filter by specialty
        if ($request->filled('specialty')) {
            $specialtyName = $request->specialty;
            $doctorsQuery->whereHas('specialties', function($q) use ($specialtyName) {
                $q->where('special_name', 'LIKE', "%{$specialtyName}%");
            });
        }

        // Filter by governorate/city
        if ($request->filled('city') && $request->city !== 'all') {
            $city = $request->city;
            $doctorsQuery->where(function($q) use ($city) {
                $q->where('governorate', 'LIKE', "%{$city}%")
                  ->orWhere('address', 'LIKE', "%{$city}%");
            });
        }

        // Filter by area
        if ($request->filled('area') && $request->area !== 'all') {
            $area = $request->area;
            $doctorsQuery->where('address', 'LIKE', "%{$area}%");
        }

        // Filter by doctor name or hospital
        if ($request->filled('query')) {
            $searchQuery = $request->input('query');
            $doctorsQuery->where(function($q) use ($searchQuery) {
                $q->where('name', 'LIKE', "%{$searchQuery}%")
                  ->orWhere('hospital', 'LIKE', "%{$searchQuery}%")
                  ->orWhere('clinic_name', 'LIKE', "%{$searchQuery}%");
            });
        }

        // Handle telehealth filtering (if you have telehealth support)
        if ($request->filled('search_type') && $request->search_type === 'telehealth') {
            $doctorsQuery->where('telehealth_available', true);
        }

        // Pagination
        $perPage = $request->get('per_page', 10);
        $doctors = $doctorsQuery->paginate($perPage);

        // Get filter options for the view
        $specialists = Specialist::orderBy('special_name')->get();
        $governorates = config('governorates');

        // Prepare data for view
        $data = [
            'doctors' => $doctors,
            'specialists' => $specialists,
            'governorates' => $governorates,
            'filters' => [
                'specialty' => $request->specialty,
                'city' => $request->city,
                'area' => $request->area,
                'query' => $request->query,
                'search_type' => $request->search_type ?? 'book_doctor',
                'telehealth_type' => $request->telehealth_type
            ],
            'search_params' => $request->all()
        ];

        // Return JSON for AJAX requests
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $data,
                'total' => $doctors->total(),
                'current_page' => $doctors->currentPage(),
                'last_page' => $doctors->lastPage()
            ]);
        }

        // Return view for regular requests
        return view('site.doctors.search', $data);
    }

    /**
     * Get doctor details
     */
    public function show($id)
    {
        $doctor = Doctor::with(['specialties', 'appointments'])
            ->where('id', $id)
            ->where('is_active', true)
            ->firstOrFail();

        return view('site.doctors.show', compact('doctor'));
    }

    /**
     * Get available appointments for a doctor
     */
    public function getAppointments(Request $request, $doctorId)
    {
        $validated = $request->validate([
            'date' => ['nullable', 'date', 'after_or_equal:today'],
            'time_range' => ['nullable', 'string', 'in:morning,afternoon,evening']
        ]);

        $doctor = Doctor::findOrFail($doctorId);
        
        $appointmentsQuery = $doctor->appointments()
            ->where('status', 'available')
            ->where('date', '>=', now()->toDateString());

        if ($request->filled('date')) {
            $appointmentsQuery->whereDate('date', $request->date);
        }

        if ($request->filled('time_range')) {
            $timeRange = $request->time_range;
            switch ($timeRange) {
                case 'morning':
                    $appointmentsQuery->whereTime('time', '>=', '06:00')
                        ->whereTime('time', '<', '12:00');
                    break;
                case 'afternoon':
                    $appointmentsQuery->whereTime('time', '>=', '12:00')
                        ->whereTime('time', '<', '18:00');
                    break;
                case 'evening':
                    $appointmentsQuery->whereTime('time', '>=', '18:00');
                    break;
            }
        }

        $appointments = $appointmentsQuery->orderBy('date')
            ->orderBy('time')
            ->get();

        return response()->json([
            'success' => true,
            'appointments' => $appointments,
            'doctor' => $doctor
        ]);
    }

    /**
     * Get specialists for AJAX requests
     */
    public function getSpecialists()
    {
        $specialists = Specialist::orderBy('special_name')->get();
        
        return response()->json([
            'success' => true,
            'specialists' => $specialists
        ]);
    }

    /**
     * Get governorates for AJAX requests
     */
    public function getGovernorates()
    {
        $governorates = config('governorates');
        
        return response()->json([
            'success' => true,
            'governorates' => $governorates
        ]);
    }
}