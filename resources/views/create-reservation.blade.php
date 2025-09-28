@php
    use Illuminate\Support\Facades\Auth;
    $doctorId = request()->query('doctor_id');
    $selectedDate = request()->query('date');
    $selectedTime = request()->query('time');
    $appointmentDate = '';
    if ($selectedDate) {
        $date = \Carbon\Carbon::createFromFormat('Y-m-d', $selectedDate);
        if ($date) {
            $today = \Carbon\Carbon::today();
            $tomorrow = \Carbon\Carbon::tomorrow();
            if ($date->equalTo($today)) {
                $appointmentDate = 'Today ' . $date->format('F d');
            } elseif ($date->equalTo($tomorrow)) {
                $appointmentDate = 'Tomorrow ' . $date->format('F d');
            } else {
                $appointmentDate = $date->format('l F d');
            }
        }
    }
    $page_title = 'Create Reservation - Vezeeta';
    $user = Auth::user();
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
                        {{-- You should fetch doctor from DB in controller and pass to view --}}
                        <img src="{{ $doctor->image ?? 'https://via.placeholder.com/400x400/3B82F6/FFFFFF?text=' . substr($doctor->name ?? '', 0, 1) }}" alt="{{ $doctor->name ?? '' }}" class="w-24 h-24 rounded-full object-cover">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                {{ ($doctor->title ?? 'Doctor') . ' ' . ($doctor->name ?? '') }}
                            </h3>
                            <p class="text-sm text-gray-600">
                                {{ $doctor->specialties->first()->special_name ?? 'General Practice' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Appointment Details -->
                <div class="bg-white rounded-lg shadow-md p-4">
                    <div class="text-center">
                        <p class="text-gray-600 text-sm mb-2">
                            {{ $appointmentDate . ' - ' . $selectedTime }},
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
                    @if (!auth()->check())
                        <div class="mb-4 text-center text-red-600 font-semibold">
                            You must <a href="{{ route('user.login') }}" class="text-blue-600 underline">login</a> to book an appointment.
                        </div>
                    @else
                        <form id="reservation-form" class="space-y-4" method="POST" action="{{ route('reservation.book') }}">
                            @csrf
                            <input type="hidden" name="doctor_id" value="{{ $doctorId }}">
                            <input type="hidden" name="date" value="{{ $selectedDate }}">
                            <input type="hidden" name="time" value="{{ $selectedTime }}">

                            <!-- Name Field -->
                            <div class="relative">
                                <i class="fas fa-user absolute left-3 top-4 text-gray-400"></i>
                                <input type="text" id="patient_name" name="patient_name" required placeholder="محمد مصطفى"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-right" value="{{ $user->name ?? '' }}">
                            </div>

                            <!-- Phone Field -->
                            <div class="relative">
                                <i class="fas fa-phone absolute left-3 top-4 text-gray-400"></i>
                                <div class="flex">
                                    <input type="tel" id="patient_phone" name="patient_phone" required placeholder="+201145662668"
                                        class="flex-1 px-8 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ $user->phone ?? '' }}">
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="relative">
                                <i class="fas fa-envelope absolute left-3 top-4 text-gray-400"></i>
                                <input type="email" id="patient_email" name="patient_email" required
                                    placeholder="moh162534aaa@gmail.com"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ $user->email ?? '' }}">
                            </div>

                            <!-- Booking for Another Patient -->
                            <div class="flex items-center mt-6 mb-6">
                                <input type="checkbox" id="booking_for_another" name="booking_for_another"
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="booking_for_another" class="ml-3 text-sm text-gray-700">
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
                                <a href="{{ route('doctor.profile', $doctorId) }}"
                                    class="flex-1 bg-white border-2 border-gray-300 text-gray-700 py-3 px-6 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-semibold text-lg text-center">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- No JS needed for booking, handled by Laravel backend --}}

@endsection
