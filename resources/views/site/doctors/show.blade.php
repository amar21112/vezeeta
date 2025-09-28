@extends('layouts.app')

@section('title', $doctor->name . ' - Doctor Profile - Vezeeta')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800">Home</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('doctors.search') }}" class="text-blue-600 hover:text-blue-800">Find Doctors</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li>{{ $doctor->name }}</li>
        </ol>
    </nav>

    <!-- Doctor Profile -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 mb-8">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Doctor Image -->
            <div class="flex-shrink-0">
                <div class="w-32 h-32 lg:w-48 lg:h-48 rounded-full overflow-hidden bg-gray-100 border-4 border-blue-100">
                    @if($doctor->image)
                        <img src="{{ $doctor->image }}" alt="{{ $doctor->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-blue-100">
                            <i class="fas fa-user-md text-blue-600 text-6xl"></i>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Doctor Details -->
            <div class="flex-grow">
                <div class="mb-4">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $doctor->name }}</h1>
                    
                    <!-- Specialties -->
                    @if($doctor->specialties->count() > 0)
                        <div class="mb-4">
                            <div class="flex flex-wrap gap-2">
                                @foreach($doctor->specialties as $specialty)
                                    <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $specialty->special_name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Basic Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600">
                        @if($doctor->governorate || $doctor->address)
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-3 text-gray-400"></i>
                                <div>
                                    @if($doctor->address)
                                        {{ $doctor->address }}
                                        @if($doctor->governorate), {{ ucfirst(str_replace('_', ' ', $doctor->governorate)) }}@endif
                                    @elseif($doctor->governorate)
                                        {{ ucfirst(str_replace('_', ' ', $doctor->governorate)) }}
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if($doctor->hospital || $doctor->clinic_name)
                            <div class="flex items-center">
                                <i class="fas fa-hospital mr-3 text-gray-400"></i>
                                <div>{{ $doctor->hospital ?? $doctor->clinic_name }}</div>
                            </div>
                        @endif

                        @if($doctor->phone)
                            <div class="flex items-center">
                                <i class="fas fa-phone mr-3 text-gray-400"></i>
                                <div>{{ $doctor->phone }}</div>
                            </div>
                        @endif

                        @if($doctor->email)
                            <div class="flex items-center">
                                <i class="fas fa-envelope mr-3 text-gray-400"></i>
                                <div>{{ $doctor->email }}</div>
                            </div>
                        @endif

                        @if($doctor->experience_years)
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt mr-3 text-gray-400"></i>
                                <div>{{ $doctor->experience_years }} years of experience</div>
                            </div>
                        @endif

                        @if($doctor->consultation_fee)
                            <div class="flex items-center">
                                <i class="fas fa-money-bill mr-3 text-gray-400"></i>
                                <div>{{ $doctor->consultation_fee }} EGP consultation fee</div>
                            </div>
                        @endif
                    </div>

                    <!-- Special Features -->
                    <div class="mt-4 flex flex-wrap gap-2">
                        @if($doctor->telehealth_available)
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-video mr-1"></i>Telehealth Available
                            </span>
                        @endif
                        @if($doctor->emergency_available)
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-ambulance mr-1"></i>Emergency Available
                            </span>
                        @endif
                        @if($doctor->home_visit_available)
                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-home mr-1"></i>Home Visit Available
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="lg:w-64 flex-shrink-0">
                <div class="bg-gray-50 rounded-lg p-4">
                    @if($doctor->consultation_fee)
                        <div class="text-center mb-4">
                            <div class="text-2xl font-bold text-green-600">{{ $doctor->consultation_fee }} EGP</div>
                            <div class="text-sm text-gray-500">Consultation Fee</div>
                        </div>
                    @endif

                    <div class="space-y-3">
                        <button class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-lg font-medium transition-colors">
                            <i class="fas fa-calendar-plus mr-2"></i>Book Appointment
                        </button>

                        @if($doctor->telehealth_available)
                            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg font-medium transition-colors">
                                <i class="fas fa-video mr-2"></i>Book Telehealth
                            </button>
                        @endif

                        @if($doctor->phone)
                            <a href="tel:{{ $doctor->phone }}" class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-3 rounded-lg font-medium transition-colors block text-center">
                                <i class="fas fa-phone mr-2"></i>Call Now
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    @if($doctor->bio || $doctor->education || $doctor->certifications)
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">About Dr. {{ $doctor->name }}</h2>
            
            @if($doctor->bio)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Biography</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $doctor->bio }}</p>
                </div>
            @endif

            @if($doctor->education)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Education</h3>
                    <p class="text-gray-600">{{ $doctor->education }}</p>
                </div>
            @endif

            @if($doctor->certifications)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Certifications</h3>
                    <p class="text-gray-600">{{ $doctor->certifications }}</p>
                </div>
            @endif
        </div>
    @endif

    <!-- Available Appointments -->
    @if($doctor->appointments->count() > 0)
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Available Appointments</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($doctor->appointments->where('status', 'available')->where('appointment_date', '>=', now())->take(6) as $appointment)
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="text-center">
                            <div class="text-lg font-semibold text-blue-800">
                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                            </div>
                            <div class="text-blue-600">
                                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                            </div>
                            <button class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm transition-colors">
                                Book
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($doctor->appointments->where('status', 'available')->where('appointment_date', '>=', now())->count() > 6)
                <div class="text-center mt-4">
                    <button class="text-blue-600 hover:text-blue-800 underline">
                        View All Available Times
                    </button>
                </div>
            @endif
        </div>
    @endif

    <!-- Contact Information -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Contact Information</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Clinic Details</h3>
                <div class="space-y-2 text-gray-600">
                    @if($doctor->hospital || $doctor->clinic_name)
                        <div class="flex items-center">
                            <i class="fas fa-hospital mr-3 text-gray-400"></i>
                            <span>{{ $doctor->hospital ?? $doctor->clinic_name }}</span>
                        </div>
                    @endif
                    
                    @if($doctor->address)
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt mr-3 text-gray-400 mt-1"></i>
                            <span>{{ $doctor->address }}
                                @if($doctor->governorate), {{ ucfirst(str_replace('_', ' ', $doctor->governorate)) }}@endif
                            </span>
                        </div>
                    @endif
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Get in Touch</h3>
                <div class="space-y-2 text-gray-600">
                    @if($doctor->phone)
                        <div class="flex items-center">
                            <i class="fas fa-phone mr-3 text-gray-400"></i>
                            <span>{{ $doctor->phone }}</span>
                        </div>
                    @endif
                    
                    @if($doctor->email)
                        <div class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-gray-400"></i>
                            <span>{{ $doctor->email }}</span>
                        </div>
                    @endif
                    
                    @if($doctor->website)
                        <div class="flex items-center">
                            <i class="fas fa-globe mr-3 text-gray-400"></i>
                            <a href="{{ $doctor->website }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                Visit Website
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection