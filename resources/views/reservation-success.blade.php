@extends('layouts.app')
@section('title', 'Reservation Success - Vezeeta')

@section('content')
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="max-w-md mx-auto">
            <!-- Success Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <!-- Success Icon -->
                <div class="mb-4">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto">
                        <i class="fas fa-check text-green-600 text-2xl"></i>
                    </div>
                </div>

                <!-- Success Message -->
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Reservation Confirmed!</h1>
                <p class="text-gray-600 mb-6">Your appointment has been successfully booked.</p>

                <!-- Appointment Details -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6 text-left">
                    <h3 class="font-semibold text-gray-900 mb-3">Appointment Details:</h3>
                    
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <i class="fas fa-user-md text-blue-600 w-5 mr-3"></i>
                            <span class="text-sm">
                                <strong>Doctor:</strong> {{ $reservation->doctor->name }} {{ $reservation->doctor->surname }}
                            </span>
                        </div>
                        
                        <div class="flex items-center">
                            <i class="fas fa-calendar text-blue-600 w-5 mr-3"></i>
                            <span class="text-sm">
                                <strong>Date:</strong> {{ \Carbon\Carbon::parse($reservation->appointment->date)->format('l, F j, Y') }}
                            </span>
                        </div>
                        
                        <div class="flex items-center">
                            <i class="fas fa-clock text-blue-600 w-5 mr-3"></i>
                            <span class="text-sm">
                                <strong>Time:</strong> {{ \Carbon\Carbon::parse($reservation->appointment->time)->format('g:i A') }}
                            </span>
                        </div>
                        
                        <div class="flex items-center">
                            <i class="fas fa-user text-blue-600 w-5 mr-3"></i>
                            <span class="text-sm">
                                <strong>Patient:</strong> {{ $reservation->patient_name }}
                            </span>
                        </div>
                        
                        <div class="flex items-center">
                            <i class="fas fa-phone text-blue-600 w-5 mr-3"></i>
                            <span class="text-sm">
                                <strong>Phone:</strong> {{ $reservation->patient_phone }}
                            </span>
                        </div>
                        
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-blue-600 w-5 mr-3"></i>
                            <span class="text-sm">
                                <strong>Email:</strong> {{ $reservation->patient_email }}
                            </span>
                        </div>
                        
                        <div class="flex items-center">
                            <i class="fas fa-info-circle text-blue-600 w-5 mr-3"></i>
                            <span class="text-sm">
                                <strong>Status:</strong> 
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Important Notice -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-600 mr-2 mt-0.5"></i>
                        <div class="text-sm text-blue-800">
                            <p class="font-semibold mb-1">Important:</p>
                            <p>Please arrive 15 minutes before your scheduled appointment time. You will receive a confirmation email shortly.</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                    <a href="{{ route('doctors.page') }}" 
                       class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium inline-block">
                        Find More Doctors
                    </a>
                    
                    <a href="{{ route('home') }}" 
                       class="w-full border border-gray-300 text-gray-700 py-3 px-6 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-medium inline-block">
                        Back to Home
                    </a>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="mt-6 text-center text-sm text-gray-600">
                <p>Need help? Contact us at <a href="mailto:support@vezeeta.com" class="text-blue-600 hover:underline">support@vezeeta.com</a></p>
            </div>
        </div>
    </div>
@endsection