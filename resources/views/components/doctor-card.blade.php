@php
    // Doctor data structure - passed from parent page
    // Ensure all required fields are present with defaults
    $doctorData = [
        'id' => $doctor['id'] ?? 1,
        'name' => $doctor['name'] ?? 'Mostafa Elkhashab',
        'title' => $doctor['title'] ?? 'Doctor',
        'image' =>
            $doctor['image'] ??
            'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
        'specialty' => $doctor['specialty'] ?? 'Dental implants and cosmetic dentistry',
        'specialties' => $doctor['specialties'] ?? ['Implantology', 'Cosmetic Dentistry', 'Endodontics'],
        'rating' => $doctor['rating'] ?? 4.5,
        'reviews_count' => $doctor['reviews_count'] ?? 510,
        'location' => $doctor['location'] ?? 'Janakless - Alhorya Road',
        'fees' => $doctor['fees'] ?? 200,
        'waiting_time' => $doctor['waiting_time'] ?? 21,
        'call_cost' => $doctor['call_cost'] ?? 16676,
        'badges' => $doctor['badges'] ?? [],
        'available_days' => $doctor['available_days'] ?? 6,
        'appointments' => $doctor['appointments'] ?? [],
    ];

    // Generate appointment data for this doctor

@endphp

<!-- Enhanced Doctor Profile Card with Integrated Appointment Reservation -->
<div class="doctor-profile-card bg-white rounded-lg shadow-md overflow-hidden cursor-pointer"
    data-doctor-id="<?php echo $doctorData['id']; ?>">
    <div class="flex flex-col lg:flex-row">
        <!-- Left Side - Doctor Information -->
        <div class="lg:w-1/2 p-6">
            <div class="flex items-start space-x-4" onclick="redirectToDoctorProfile(<?php echo htmlspecialchars(json_encode($doctorData)); ?>)">
                <!-- Doctor Image -->
                <div class="flex-shrink-0">
                    <img src="<?php echo $doctorData['image']; ?>" alt="<?php echo $doctorData['name']; ?>"
                        class="w-20 h-20 rounded-full object-cover border-2 border-gray-200">
                </div>

                <!-- Doctor Details -->
                <div class="flex-1">
                    <!-- Doctor Name and Title -->
                    <h3 class="text-xl font-semibold text-blue-600 mb-1">
                        <?php echo $doctorData['title'] . ' ' . $doctorData['name']; ?>
                    </h3>

                    <!-- Specialty -->
                    <p class="text-gray-600 text-sm mb-3"><?php echo $doctorData['specialty']; ?></p>

                    <!-- Rating -->
                    <div class="flex items-center mb-4">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                        <?php if ($i <= floor($doctorData['rating'])): ?>
                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                        <?php elseif ($i == ceil($doctorData['rating']) && $doctorData['rating'] - floor($doctorData['rating']) >= 0.5): ?>
                        <i class="fas fa-star-half-alt text-yellow-400 text-sm"></i>
                        <?php else: ?>
                        <i class="fas fa-star text-gray-300 text-sm"></i>
                        <?php endif; ?>
                        <?php endfor; ?>
                        <span class="ml-2 text-sm text-gray-600">
                            Overall Rating From <?php echo $doctorData['reviews_count']; ?> Visitors
                        </span>
                    </div>

                    <!-- Details List -->
                    <div class="space-y-2 text-sm">
                        <!-- Specialty with Icon -->
                        <div class="flex items-start">
                            <i class="fas fa-stethoscope text-blue-600 w-4 mr-3 mt-0.5"></i>
                            <div>
                                <span class="text-gray-700 font-medium">Dentist</span>
                                <span class="text-gray-600 ml-1">Specialized in <?php echo implode(', ', $doctorData['specialties']); ?></span>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-red-500 w-4 mr-3 mt-0.5"></i>
                            <span class="text-gray-600"><?php echo $doctorData['location']; ?></span>
                        </div>

                        <!-- Fees -->
                        <div class="flex items-start">
                            <i class="fas fa-money-bill-wave text-red-500 w-4 mr-3 mt-0.5"></i>
                            <span class="text-gray-600">Fees: <?php echo $doctorData['fees']; ?> EGP</span>
                        </div>

                        <!-- Waiting Time -->
                        <div class="flex items-start">
                            <i class="fas fa-clock text-green-600 w-4 mr-3 mt-0.5"></i>
                            <span class="text-green-600 font-medium">Waiting Time: <?php echo $doctorData['waiting_time']; ?> Minutes</span>
                        </div>

                        <!-- Call Cost -->
                        <div class="flex items-start">
                            <i class="fas fa-phone text-blue-600 w-4 mr-3 mt-0.5"></i>
                            <span class="text-gray-600"><?php echo $doctorData['call_cost']; ?> - Cost of regular call</span>
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
                // Include the appointment slots component
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
        // Redirect to doctor profile page with doctor ID in URL
        window.location.href = `doctor/${doctorData.id}`;
    }
</script>
