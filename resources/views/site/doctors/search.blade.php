@extends('layouts.app')

@section('title', 'Find Doctors - Vezeeta')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800">Home</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li>Find Doctors</li>
            @if(isset($filters['specialty']) && $filters['specialty'])
                <li><i class="fas fa-chevron-right text-xs"></i></li>
                <li>{{ $filters['specialty'] }}</li>
            @endif
        </ol>
    </nav>

    <!-- Search Header -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                @if(isset($filters['specialty']) && $filters['specialty'])
                    {{ $filters['specialty'] }} Doctors
                @else
                    Find the Right Doctor
                @endif
            </h1>
            <p class="text-gray-600 mb-4">
                @if($doctors->total() > 0)
                    Found {{ $doctors->total() }} doctor{{ $doctors->total() !== 1 ? 's' : '' }}
                    @if(isset($filters['city']) && $filters['city'] && $filters['city'] !== 'all')
                        in {{ ucfirst(str_replace('_', ' ', $filters['city'])) }}
                    @endif
                @else
                    No doctors found matching your criteria
                @endif
            </p>

            <!-- Active Filters -->
            @if(!empty(array_filter($filters)))
                <div class="flex flex-wrap gap-2">
                    <span class="text-sm font-medium text-gray-700">Filters:</span>
                    @if(isset($filters['specialty']) && $filters['specialty'])
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm flex items-center">
                            <i class="fas fa-stethoscope mr-1"></i>
                            {{ $filters['specialty'] }}
                            <a href="{{ request()->fullUrlWithQuery(['specialty' => '']) }}" class="ml-2 text-blue-600 hover:text-blue-800">×</a>
                        </span>
                    @endif
                    @if(isset($filters['city']) && $filters['city'] && $filters['city'] !== 'all')
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm flex items-center">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            {{ ucfirst(str_replace('_', ' ', $filters['city'])) }}
                            <a href="{{ request()->fullUrlWithQuery(['city' => '']) }}" class="ml-2 text-green-600 hover:text-green-800">×</a>
                        </span>
                    @endif
                    @if(isset($filters['area']) && $filters['area'] && $filters['area'] !== 'all')
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm flex items-center">
                            <i class="fas fa-location-arrow mr-1"></i>
                            {{ ucfirst(str_replace(['-', '_'], ' ', $filters['area'])) }}
                            <a href="{{ request()->fullUrlWithQuery(['area' => '']) }}" class="ml-2 text-purple-600 hover:text-purple-800">×</a>
                        </span>
                    @endif
                    @if(isset($filters['query']) && $filters['query'])
                        <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm flex items-center">
                            <i class="fas fa-search mr-1"></i>
                            "{{ $filters['query'] }}"
                            <a href="{{ request()->fullUrlWithQuery(['query' => '']) }}" class="ml-2 text-orange-600 hover:text-orange-800">×</a>
                        </span>
                    @endif
                    @if(isset($filters['search_type']) && $filters['search_type'] === 'telehealth')
                        <span class="bg-cyan-100 text-cyan-800 px-3 py-1 rounded-full text-sm flex items-center">
                            <i class="fas fa-video mr-1"></i>
                            Telehealth
                            <a href="{{ request()->fullUrlWithQuery(['search_type' => '', 'telehealth_type' => '']) }}" class="ml-2 text-cyan-600 hover:text-cyan-800">×</a>
                        </span>
                    @endif
                    @if(!empty(array_filter($filters)))
                        <a href="{{ route('doctors.search') }}" class="text-sm text-blue-600 hover:text-blue-800 underline">
                            Clear all filters
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- Search Results -->
    <div class="grid gap-6">
        @if($doctors->count() > 0)
            @foreach($doctors as $doctor)
                <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                    <div class="flex flex-col lg:flex-row gap-4">
                        <!-- Doctor Image -->
                        <div class="flex-shrink-0">
                            <div class="w-24 h-24 lg:w-32 lg:h-32 rounded-full overflow-hidden bg-gray-100 border-4 border-blue-100">
                                @if($doctor->image)
                                    <img src="{{ $doctor->image }}" alt="{{ $doctor->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-blue-100">
                                        <i class="fas fa-user-md text-blue-600 text-3xl"></i>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Doctor Info -->
                        <div class="flex-grow">
                            <div class="flex flex-col lg:flex-row justify-between gap-4">
                                <div class="flex-grow">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $doctor->name }}</h3>
                                    
                                    <!-- Specialties -->
                                    @if($doctor->specialties->count() > 0)
                                        <div class="mb-3">
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($doctor->specialties as $specialty)
                                                    <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded-full text-sm">
                                                        {{ $specialty->special_name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Location -->
                                    @if($doctor->governorate || $doctor->address)
                                        <div class="mb-2 text-gray-600 flex items-center">
                                            <i class="fas fa-map-marker-alt mr-2"></i>
                                            @if($doctor->address)
                                                {{ $doctor->address }}
                                                @if($doctor->governorate), {{ ucfirst(str_replace('_', ' ', $doctor->governorate)) }}@endif
                                            @elseif($doctor->governorate)
                                                {{ ucfirst(str_replace('_', ' ', $doctor->governorate)) }}
                                            @endif
                                        </div>
                                    @endif

                                    <!-- Hospital/Clinic -->
                                    @if($doctor->hospital || $doctor->clinic_name)
                                        <div class="mb-2 text-gray-600 flex items-center">
                                            <i class="fas fa-hospital mr-2"></i>
                                            {{ $doctor->hospital ?? $doctor->clinic_name }}
                                        </div>
                                    @endif

                                    <!-- Contact Info -->
                                    @if($doctor->phone)
                                        <div class="mb-2 text-gray-600 flex items-center">
                                            <i class="fas fa-phone mr-2"></i>
                                            {{ $doctor->phone }}
                                        </div>
                                    @endif

                                    <!-- Experience -->
                                    @if($doctor->experience_years)
                                        <div class="mb-2 text-gray-600 flex items-center">
                                            <i class="fas fa-calendar-alt mr-2"></i>
                                            {{ $doctor->experience_years }} years of experience
                                        </div>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-col lg:items-end gap-3">
                                    @if($doctor->consultation_fee)
                                        <div class="text-right">
                                            <div class="text-lg font-bold text-green-600">{{ $doctor->consultation_fee }} EGP</div>
                                            <div class="text-sm text-gray-500">Consultation Fee</div>
                                        </div>
                                    @endif

                                    <div class="flex flex-col gap-2">
                                        <a href="{{ route('doctor.show', $doctor->id) }}" 
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-center font-medium transition-colors">
                                            View Profile
                                        </a>
                                        
                                        @if($filters['search_type'] === 'telehealth' && $doctor->telehealth_available)
                                            <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg text-center font-medium transition-colors">
                                                <i class="fas fa-video mr-2"></i>Book Telehealth
                                            </button>
                                        @else
                                            <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg text-center font-medium transition-colors">
                                                <i class="fas fa-calendar-plus mr-2"></i>Book Appointment
                                            </button>
                                        @endif
                                    </div>

                                    @if($doctor->telehealth_available)
                                        <div class="text-center">
                                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">
                                                <i class="fas fa-video mr-1"></i>Telehealth Available
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            <div class="mt-8">
                {{ $doctors->appends(request()->query())->links() }}
            </div>
        @else
            <!-- No Results -->
            <div class="text-center py-12">
                <div class="max-w-md mx-auto">
                    <div class="mb-4">
                        <i class="fas fa-search text-gray-400 text-6xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Doctors Found</h3>
                    <p class="text-gray-600 mb-6">
                        We couldn't find any doctors matching your search criteria. Try adjusting your filters or search terms.
                    </p>
                    <div class="space-y-3">
                        <a href="{{ route('doctors.search') }}" 
                           class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                            Browse All Doctors
                        </a>
                        <div>
                            <a href="{{ route('home') }}" 
                               class="text-blue-600 hover:text-blue-800 underline">
                                Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Search Form (mobile-friendly) -->
    <div class="mt-12">
        <div class="bg-gray-50 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Refine Your Search</h3>
            @include('components.search')
        </div>
    </div>
</div>
@endsection