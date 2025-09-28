@extends('doctor.dashboard.layout')
@section('title', 'Doctor Dashboard')
@section('page_title', 'Dashboard Overview')
@section('page_subtitle', 'Welcome back, Dr. ' . auth('doctor')->user()->name)

@section('content')
    <!-- Dashboard Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Appointments -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Appointments</p>
                    <p class="text-2xl font-bold text-gray-900">{{ is_object($doctor) && isset($doctor->appointments) ? $doctor->appointments->count() : 0 }}</p>
                    <p class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>
                        +12% this month
                    </p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Active Patients -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Active Patients</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalPatients ?? 0 }}</p>
                    <p class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>
                        +5% this week
                    </p>
                </div>
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-emerald-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Today's Appointments -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Today's Appointments</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $todayAppointments ?? 0 }}</p>
                    <p class="text-sm text-blue-600 mt-1">
                        <i class="fas fa-clock mr-1"></i>
                        Next at 2:30 PM
                    </p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-day text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Revenue -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Monthly Revenue</p>
                    <p class="text-2xl font-bold text-gray-900">₪{{ number_format($monthlyRevenue ?? 0) }}</p>
                    <p class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>
                        +18% this month
                    </p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Appointments -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Appointments</h3>
                    <a href="{{ route('doctor.appointments') }}" class="text-emerald-600 hover:text-emerald-700 font-medium text-sm">
                        View All
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if(isset($recentAppointments) && $recentAppointments->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentAppointments as $appointment)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-emerald-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $appointment->patient->name ?? 'Patient' }}</p>
                                        <p class="text-sm text-gray-500">{{ $appointment->appointment_date ?? 'Date' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                        Scheduled
                                    </span>
                                    <span class="text-sm font-medium text-gray-900">₪{{ $appointment->price ?? 0 }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-calendar text-gray-400 text-xl"></i>
                        </div>
                        <p class="text-gray-500">No recent appointments</p>
                        <a href="{{ route('doctor.appointments.add') }}" class="inline-flex items-center mt-3 text-emerald-600 hover:text-emerald-700 font-medium">
                            <i class="fas fa-plus mr-2"></i>
                            Add New Appointment Slot
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions & Profile Summary -->
        <div class="space-y-6">
            <!-- Profile Summary -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Profile Summary</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Specialities</span>
                        <span class="text-sm font-medium text-gray-900">{{ is_object($doctor) && isset($doctor->specialties) ? $doctor->specialties->count() : 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Experience</span>
                        <span class="text-sm font-medium text-gray-900">{{ is_object($doctor) && isset($doctor->graduate_in) ? now()->year - $doctor->graduate_in : 0 }} years</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Location</span>
                        <span class="text-sm font-medium text-gray-900">{{ is_object($doctor) && isset($doctor->city) ? $doctor->city : 'Not set' }}</span>
                    </div>
                </div>
                
                @if(is_object($doctor) && isset($doctor->specialties) && $doctor->specialties->count() == 0)
                    <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <p class="text-xs text-yellow-800">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            Please add your specialities to complete your profile
                        </p>
                    </div>
                @endif
            </div>
            
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('doctor.appointments.add') }}" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 rounded-lg transition-colors">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-plus text-emerald-600 text-sm"></i>
                        </div>
                        <span class="font-medium">Add Appointment Slot</span>
                    </a>
                    
                    <a href="{{ route('doctor.selectSpecialities') }}" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-stethoscope text-blue-600 text-sm"></i>
                        </div>
                        <span class="font-medium">Manage Specialities</span>
                    </a>
                    
                    <a href="#" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg transition-colors">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user-edit text-purple-600 text-sm"></i>
                        </div>
                        <span class="font-medium">Update Profile</span>
                    </a>
                </div>
            </div>

            <!-- Upcoming Appointments -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Upcoming Today</h3>
                @if(isset($todayAppointmentsList) && $todayAppointmentsList->count() > 0)
                    <div class="space-y-3">
                        @foreach($todayAppointmentsList->take(3) as $appointment)
                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                <div>
                                    <p class="font-medium text-gray-900 text-sm">{{ $appointment->patient->name ?? 'Patient' }}</p>
                                    <p class="text-xs text-gray-500">{{ date('g:i A', strtotime($appointment->appointment_date)) }}</p>
                                </div>
                                <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-clock text-blue-600 text-xs"></i>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-calendar text-gray-300 text-2xl mb-2"></i>
                        <p class="text-gray-500 text-sm">No appointments today</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Appointments Chart -->
    <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Appointments Overview</h3>
        <div class="h-64">
            <canvas id="appointmentsChart"></canvas>
        </div>
    </div>

    <script>
        // Chart.js configuration for appointments overview
        const ctx = document.getElementById('appointmentsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Appointments',
                    data: [12, 19, 15, 25, 22, 30, 28, 35, 32, 40, 38, 45],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
@endsection