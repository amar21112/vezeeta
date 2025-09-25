@include('doctors-data')
@php
    // Include centralized doctors data

    // Get doctor ID from URL parameter
    $doctorId = (int) ($_GET['doctor_id'] ?? 1);

    // First, try to get doctor from our data
    $doctor = getDoctorById($doctorId);

    // If not found, simulate API call
    if (!$doctor) {
        $apiResponse = fetchDoctorData($doctorId);
        if ($apiResponse['success']) {
            $doctor = $apiResponse['data'];
        } else {
            // Fallback to first doctor if not found
            $allDoctors = getAllDoctors();
            $doctor = reset($allDoctors);

            // Log error or show message
            $errorMessage = "Doctor with ID {$doctorId} not found. Showing default doctor.";
        }
    }
    $page_title = htmlspecialchars($doctor['title'] . ' ' . $doctor['name'] . ' - Vezeeta');
@endphp

@extends('layouts.app')
@section('title', $page_title)
@section('content')
    <!-- Breadcrumb Navigation -->
    <div class="bg-white py-3 border-b">
        <div class="max-w-7xl mx-auto px-4">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="/" class="text-blue-600 hover:underline">Vezeeta</a>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                <a href="doctors.php" class="text-blue-600 hover:underline">Find Doctors</a>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                <span class="text-gray-600"><?php echo htmlspecialchars($doctor['title'] . ' ' . $doctor['name']); ?></span>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-6">
        <?php if (isset($errorMessage)): ?>
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm"><?php echo htmlspecialchars($errorMessage); ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Main Content -->
            <div class="lg:w-2/3">
                <!-- Doctor Profile Header -->
                <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
                    <div class="flex items-start space-x-4">
                        <img src="<?php echo htmlspecialchars($doctor['image']); ?>" alt="<?php echo htmlspecialchars($doctor['name']); ?>"
                            class="w-24 h-24 rounded-full object-cover border-2 border-gray-200">
                        <div class="flex-1">
                            <h1 class="text-2xl font-bold text-gray-900 mb-1">
                                <?php echo htmlspecialchars($doctor['title'] . ' ' . $doctor['name']); ?>
                            </h1>
                            <p class="text-gray-600 mb-3"><?php echo htmlspecialchars($doctor['specialty']); ?></p>

                            <!-- Specialties -->
                            <div class="mb-3">
                                <span class="text-blue-600 font-medium">Dermatologist</span>
                                <span class="text-gray-600 ml-1">Specialized in</span>
                                <span class="text-blue-600 ml-1">
                                    <?php echo htmlspecialchars(implode(', ', $doctor['specialties'])); ?>
                                </span>
                                <button class="text-blue-600 ml-2 hover:underline">... More</button>
                            </div>

                            <!-- Rating -->
                            <div class="flex items-center">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                <?php  if ($i <= floor($doctor['rating'])): ?>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <?php  elseif ($i == ceil($doctor['rating']) && $doctor['rating'] - floor($doctor['rating']) >= 0.5): ?>
                                <i class="fas fa-star-half-alt text-yellow-400 text-sm"></i>
                                <?php  else: ?>
                                <i class="fas fa-star text-gray-300 text-sm"></i>
                                <?php  endif; ?>
                                <?php endfor; ?>
                                <span class="ml-2 text-sm text-gray-600">
                                    Overall Rating From <?php echo $doctor['reviews_count']; ?> Visitors
                                </span>
                                <button class="text-blue-600 ml-2 hover:underline text-sm">Show all reviews</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- About The Doctor -->
                <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-user-md text-blue-600 mr-3"></i>
                        <h2 class="text-xl font-semibold text-gray-900">About The Doctor</h2>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        <?php echo nl2br(htmlspecialchars($doctor['about'])); ?>
                    </p>
                </div>

                <!-- Symptoms and Services -->
                <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-stethoscope text-blue-600 mr-3"></i>
                        <h2 class="text-xl font-semibold text-gray-900">Symptoms and Services :</h2>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach ($doctor['symptoms_services'] as $service): ?>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm border border-blue-200">
                            <?php echo htmlspecialchars($service); ?>
                        </span>
                        <?php endforeach; ?>
                        <button class="px-3 py-1 bg-blue-600 text-white rounded-full text-sm hover:bg-blue-700">
                            + 15
                        </button>
                    </div>
                </div>

                <!-- Clinic Photos -->
                <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-images text-blue-600 mr-3"></i>
                        <h2 class="text-xl font-semibold text-gray-900">Clinic :</h2>
                    </div>
                    <div class="grid grid-cols-6 gap-2">
                        <!-- Sample clinic images -->
                        <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?w=200&h=200&fit=crop"
                                alt="Clinic" class="w-full h-full object-cover">
                        </div>
                        <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=200&h=200&fit=crop"
                                alt="Clinic" class="w-full h-full object-cover">
                        </div>
                        <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?w=200&h=200&fit=crop"
                                alt="Clinic" class="w-full h-full object-cover">
                        </div>
                        <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=200&h=200&fit=crop"
                                alt="Clinic" class="w-full h-full object-cover">
                        </div>
                        <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?w=200&h=200&fit=crop"
                                alt="Clinic" class="w-full h-full object-cover">
                        </div>
                        <div
                            class="aspect-square bg-gray-200 rounded-lg overflow-hidden flex items-center justify-center text-white text-xl font-bold relative">
                            <img src="https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?w=200&h=200&fit=crop"
                                alt="Clinic" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                                <span class="text-2xl font-bold">+1</span>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <!-- Booking Card -->
            <div class="lg:w-1/3">
                <div class="bg-blue-600 text-white rounded-t-lg p-4 text-center">
                    <h3 class="text-lg font-semibold mb-2">Booking Information</h3>
                    <div class="flex items-center justify-center space-x-4">
                        <span class="text-sm">Book</span>
                        <span class="bg-white text-blue-600 px-3 py-1 rounded font-semibold">Examination</span>
                    </div>
                </div>

                <div class="bg-white rounded-b-lg shadow-sm border border-t-0 p-6">
                    <!-- Booking Details -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-money-bill-wave text-blue-600 mr-2"></i>
                            <span class="text-sm text-gray-600">Fees</span>
                            <span class="font-bold text-lg ml-2"><?php echo $doctor['fees']; ?> EGP</span>
                        </div>
                        <div class="flex items-center text-green-600">
                            <i class="fas fa-clock mr-1"></i>
                            <span class="text-sm font-medium">Waiting Time : <?php echo $doctor['waiting_time']; ?> Minutes</span>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="mb-6">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                            <span class="text-gray-600"><?php echo htmlspecialchars($doctor['location']); ?></span>
                        </div>
                        <div class="text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            Book now to receive the clinic's address details and phone number
                        </div>
                    </div>

                    <!-- Choose Appointment -->
                    <div class="mb-6">
                        <h4 class="text-center text-gray-800 font-semibold mb-4">Choose your appointment</h4>

                        <!-- Include Appointment Slots Component -->
                        <?php
                        $componentId = 'doctor_profile_' . $doctor['id'];
                        ?>
                        @include('components.appointment-slots', [
                            'doctor' => $doctor,
                            'componentId' => $componentId,
                        ])
                    </div>

                    <!-- Reservation Notice -->
                    <div class="text-center text-sm text-gray-600 mb-4">
                        Reservation required, first-come, first-served
                    </div>

                    <!-- Alternative Booking -->
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-check-circle text-green-600 mr-2"></i>
                            <span class="text-green-700 font-semibold">Book online, Pay at the clinic!</span>
                        </div>
                        <div class="text-sm text-green-600">
                            Doctor requires reservation!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
