@include('doctors-data')
@php
    // Get appointment data from URL parameters
    $doctorId = $_GET['doctor_id'] ?? null;
    $selectedDate = $_GET['date'] ?? null;
    $selectedTime = $_GET['time'] ?? null;


    // Get selected doctor data from our central data
    $selectedDoctor = getDoctorById($doctorId);

    // If not found, simulate API call
    if (!$selectedDoctor) {
        $apiResponse = fetchDoctorData($doctorId);
        if ($apiResponse['success']) {
            $selectedDoctor = $apiResponse['data'];
        } else {
            // Fallback to URL parameters
            $selectedDoctor = [
                'id' => $doctorId,
                'name' => $doctorName,
                'title' => 'Doctor',
                'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
                'specialty' => $doctorSpecialty,
            ];
        }
    }

    // Format appointment date for display
    $appointmentDate = '';
    if ($selectedDate) {
        $date = DateTime::createFromFormat('Y-m-d', $selectedDate);
        if ($date) {
            $today = new DateTime();
            $tomorrow = (clone $today)->add(new DateInterval('P1D'));

            if ($date->format('Y-m-d') === $today->format('Y-m-d')) {
                $appointmentDate = 'Today ' . $date->format('F d');
            } elseif ($date->format('Y-m-d') === $tomorrow->format('Y-m-d')) {
                $appointmentDate = 'Tomorrow ' . $date->format('F d');
            } else {
                $appointmentDate = $date->format('l F d');
            }
        }
    }

    // Redirect back if no appointment data
    if (!$doctorId) {
        header('Location: doctors.php');
        exit();
    }
    $page_title = 'Create Reservation - Vezeeta';
@endphp

@extends('layouts.app')
@section('title', $page_title)
@section('content')

    <!-- Main Container -->
    <div class="min-h-screen bg-gray-200 flex">
        <!-- Left Side - Doctor Info -->
        <div class="w-1/2 bg-gray-200 p-8">
            <div class="max-w-md mx-auto">
                <!-- Doctor Card -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <div class="flex items-start space-x-4">
                        <img src="<?php echo htmlspecialchars($selectedDoctor['image']); ?>" alt="<?php echo htmlspecialchars($selectedDoctor['name']); ?>" class="w-24 h-24 rounded-full object-cover">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                <?php echo htmlspecialchars(($selectedDoctor['title'] ?? 'Doctor') . ' ' . $selectedDoctor['name']); ?>
                            </h3>
                            <p class="text-sm text-gray-600">
                                <?php echo htmlspecialchars($selectedDoctor['specialty']); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Appointment Details -->
                <div class="bg-white rounded-lg shadow-md p-4">
                    <div class="text-center">
                        <p class="text-gray-600 text-sm mb-2">
                            <?php echo htmlspecialchars($appointmentDate . ' - ' . $selectedTime); ?>,
                            <span class="text-blue-600 font-medium">Appointment reservation</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="w-1/2 bg-gray-200 p-8">
            <div class="max-w-md mx-auto">
                <!-- Header -->
                <div class="bg-blue-600 text-white text-center py-4 rounded-t-lg">
                    <h2 class="text-lg font-semibold">Enter Your Info.</h2>
                </div>

                <!-- Form -->
                <div class="bg-white rounded-b-lg shadow-md p-6">
                    <form id="reservation-form" class="space-y-4">
                        <!-- Name Field -->
                        <div class="relative">
                            <i class="fas fa-user absolute left-3 top-4 text-gray-400"></i>
                            <input type="text" id="full-name" name="full-name" required placeholder="محمد مصطفى"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-right">
                        </div>

                        <!-- Phone Field -->
                        <div class="relative">
                            <i class="fas fa-phone absolute left-3 top-4 text-gray-400"></i>
                            <div class="flex">
                                <input type="tel" id="phone" name="phone" required placeholder="+201145662668"
                                    class="flex-1 px-8 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-3 top-4 text-gray-400"></i>
                            <input type="email" id="email" name="email" required
                                placeholder="moh162534aaa@gmail.com"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Booking for Another Patient -->
                        <div class="flex items-center mt-6 mb-6">
                            <input type="checkbox" id="another-patient" name="another-patient"
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="another-patient" class="ml-3 text-sm text-gray-700">
                                I am booking on behalf of another patient
                            </label>
                        </div>

                        <!-- Separator Line -->
                        <hr class="border-gray-200 my-6">

                        <!-- Vezeeta Points -->
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-700">Vezeeta Points Earned</span>
                                    <i class="fas fa-info-circle ml-2 text-gray-400"></i>
                                </div>
                                <div class="flex items-center">
                                    <span
                                        class="bg-yellow-400 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium flex items-center">
                                        💰 200 points
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-4 pt-8">
                            <button type="submit"
                                class="flex-1 bg-red-600 text-white py-3 px-6 rounded-lg hover:bg-red-700 transition-colors duration-200 font-semibold text-lg">
                                Book
                            </button>
                            <button type="button" onclick="goBackToDoctorProfile()"
                                class="flex-1 bg-white border-2 border-gray-300 text-gray-700 py-3 px-6 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-semibold text-lg">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to go back to doctor profile
        function goBackToDoctorProfile() {
            const doctorId = <?php echo json_encode($doctorId); ?>;
            window.location.href = `doctor_profile.php?doctor_id=${doctorId}`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Load appointment details from localStorage
            const appointmentData = localStorage.getItem('selectedAppointment');

            if (appointmentData) {
                const appointment = JSON.parse(appointmentData);
                const detailsContainer = document.getElementById('appointment-details');

                // Update doctor info if needed
                if (document.getElementById('doctor-name')) {
                    document.getElementById('doctor-name').textContent = `Doctor ${appointment.doctorName}`;
                }

                // Update appointment details if container exists
                if (detailsContainer) {
                    detailsContainer.innerHTML = `
                        <p class="text-gray-600 text-sm mb-2">Today September 20 - ${appointment.time} , <span class="text-blue-600 font-medium">Appointment reservation</span></p>
                    `;
                }
            }

            // Handle form submission
            document.getElementById('reservation-form').addEventListener('submit', function(e) {
                e.preventDefault();

                // Get form data
                const formData = new FormData(this);
                const reservationData = Object.fromEntries(formData);

                // Add appointment data
                if (appointmentData) {
                    reservationData.appointment = JSON.parse(appointmentData);
                }

                // Show loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Booking...';
                submitBtn.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    // Clear localStorage
                    localStorage.removeItem('selectedAppointment');

                    // Show success message
                    alert(
                        'Reservation confirmed successfully! You will receive a confirmation email shortly.'
                    );

                    // Redirect back to doctor profile or doctors page
                    const doctorId = <?php echo json_encode($doctorId); ?>;
                    if (doctorId) {
                        window.location.href = `doctor_profile.php?doctor_id=${doctorId}`;
                    } else {
                        window.location.href = 'doctors.php';
                    }
                }, 2000);
            });

            // Handle "booking for another patient" checkbox
            document.getElementById('another-patient').addEventListener('change', function() {
                if (this.checked) {
                    // You can add additional fields for the patient information here
                    console.log('Booking for another patient');
                }
            });
        });
    </script>

@endsection
