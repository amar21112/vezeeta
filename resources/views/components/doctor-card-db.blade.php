@php
// Map database fields to display format similar to doctor-card.blade.php structure
$doctorData = [
    'id' => $doctor->id,
    'name' => $doctor->name . ' ' . $doctor->surname,
    'title' => 'Doctor', // You can add this field to database if needed
    'image' => $doctor->image ?? 'https://via.placeholder.com/400x400/3B82F6/FFFFFF?text=' . substr($doctor->name, 0, 1),
    'specialty' => $doctor->specialties->first()->special_name ?? 'General Practice',
    'specialties' => $doctor->specialties->pluck('special_name')->toArray(),
    'rating' => $doctor->rating ?? 4.0,
    'reviews_count' => $doctor->reviews_count ?? 0,
    'location' => ($doctor->governorate ?? '') . ($doctor->city ? ' - ' . $doctor->city : ''),
    'fees' => $doctor->fees ?? 200,
    'waiting_time' => $doctor->waiting_time ?? 15,
    'call_cost' => $doctor->call_cost ?? 16676,
    'badges' => ['Professional', 'Experienced', 'Trusted'],
    'available_days' => 6,
    'appointments' => $doctor->appointments->toArray() ?? [], // Convert to array for appointment-slots component
];
@endphp

<!-- Enhanced Doctor Profile Card with Integrated Appointment Reservation - Database Version -->
<div class="doctor-profile-card bg-white rounded-lg shadow-md overflow-hidden cursor-pointer"
    data-doctor-id="{{ $doctorData['id'] }}">
    <div class="flex flex-col lg:flex-row">
        <!-- Left Side - Doctor Information -->
        <div class="lg:w-1/2 p-6">
            <div class="flex items-start space-x-4" onclick="redirectToDoctorProfile({{ json_encode($doctorData) }})">
                <!-- Doctor Image -->
                <div class="flex-shrink-0">
                    <img src="{{ $doctorData['image'] }}" alt="{{ $doctorData['name'] }}"
                        class="w-20 h-20 rounded-full object-cover border-2 border-gray-200">
                </div>

                <!-- Doctor Details -->
                <div class="flex-1">
                    <!-- Doctor Name and Title -->
                    <h3 class="text-xl font-semibold text-blue-600 mb-1">
                        {{ $doctorData['title'] }} {{ $doctorData['name'] }}
                    </h3>

                    <!-- Specialty -->
                    <p class="text-gray-600 text-sm mb-3">{{ $doctorData['specialty'] }}</p>

                    <!-- Rating -->
                    <div class="flex items-center mb-4">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($doctorData['rating']))
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                            @elseif ($i == ceil($doctorData['rating']) && $doctorData['rating'] - floor($doctorData['rating']) >= 0.5)
                                <i class="fas fa-star-half-alt text-yellow-400 text-sm"></i>
                            @else
                                <i class="fas fa-star text-gray-300 text-sm"></i>
                            @endif
                        @endfor
                        <span class="ml-2 text-sm text-gray-600">
                            Overall Rating From {{ $doctorData['reviews_count'] }} Visitors
                        </span>
                    </div>

                    <!-- Details List -->
                    <div class="space-y-2 text-sm">
                        <!-- Specialty with Icon -->
                        <div class="flex items-start">
                            <i class="fas fa-stethoscope text-blue-600 w-4 mr-3 mt-0.5"></i>
                            <div>
                                <span class="text-gray-700 font-medium">{{ ucfirst(strtolower($doctorData['specialty'])) }}</span>
                                @if (!empty($doctorData['specialties']))
                                    <span class="text-gray-600 ml-1">Specialized in {{ implode(', ', $doctorData['specialties']) }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-red-500 w-4 mr-3 mt-0.5"></i>
                            <span class="text-gray-600">{{ $doctorData['location'] }}</span>
                        </div>

                        <!-- Fees -->
                        <div class="flex items-start">
                            <i class="fas fa-money-bill-wave text-red-500 w-4 mr-3 mt-0.5"></i>
                            <span class="text-gray-600">Fees: {{ $doctorData['fees'] }} EGP</span>
                        </div>

                        <!-- Waiting Time -->
                        <div class="flex items-start">
                            <i class="fas fa-clock text-green-600 w-4 mr-3 mt-0.5"></i>
                            <span class="text-green-600 font-medium">Waiting Time: {{ $doctorData['waiting_time'] }} Minutes</span>
                        </div>

                        <!-- Call Cost -->
                        <div class="flex items-start">
                            <i class="fas fa-phone text-blue-600 w-4 mr-3 mt-0.5"></i>
                            <span class="text-gray-600">{{ $doctorData['call_cost'] }} - Cost of regular call</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Appointment Reservation -->
        <div class="lg:w-3/5 p-4 bg-gray-50 border-t lg:border-t-0 lg:border-l border-gray-200">
            @php
                // Set the component ID for the appointment slots component
                $componentId = 'doctor_' . $doctorData['id'];
            @endphp
            @include('components.appointment-slots', [
                'doctor' => $doctorData,
                'componentId' => $componentId,
            ])
        </div>
    </div>
</div>

<script>
    function redirectToDoctorProfile(doctorData) {
        // Save doctor data to localStorage as backup
        localStorage.setItem('selectedDoctor', JSON.stringify(doctorData));
        // Redirect to doctor profile page with doctor ID in URL using Laravel route
        window.location.href = `{{ url('/doctor') }}/${doctorData.id}`;
    }
</script>