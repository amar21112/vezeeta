@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="mb-3">Welcome back, {{ auth('admin')->user()->name }}!</h1>
            <p class="text-muted">Here's what's happening with your clinic today.</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-5">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #00d4aa, #00b894);">
                <div class="stats-number">{{ $stats['total_patients'] }}</div>
                <div class="stats-label">
                    <i class="fas fa-users me-2"></i>Total Patients
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #74b9ff, #0984e3);">
                <div class="stats-number">{{ $stats['total_doctors'] }}</div>
                <div class="stats-label">
                    <i class="fas fa-user-md me-2"></i>Total Doctors
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #fdcb6e, #e17055);">
                <div class="stats-number">{{ $stats['total_appointments'] }}</div>
                <div class="stats-label">
                    <i class="fas fa-calendar-check me-2"></i>Total Appointments
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #a29bfe, #6c5ce7);">
                <div class="stats-number">{{ $stats['total_specialists'] }}</div>
                <div class="stats-label">
                    <i class="fas fa-stethoscope me-2"></i>Specialists
                </div>
            </div>
        </div>
    </div>

    <!-- Appointment Status Overview -->
    <div class="row mb-5">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-clock me-2"></i>Pending Appointments
                </div>
                <div class="card-body text-center">
                    <h2 class="text-warning">{{ $stats['pending_appointments'] }}</h2>
                    <p class="text-muted">Awaiting confirmation</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-check-circle me-2"></i>Completed Appointments
                </div>
                <div class="card-body text-center">
                    <h2 class="text-success">{{ $stats['completed_appointments'] }}</h2>
                    <p class="text-muted">Successfully completed</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-times-circle me-2"></i>Cancelled Appointments
                </div>
                <div class="card-body text-center">
                    <h2 class="text-danger">{{ $stats['cancelled_appointments'] }}</h2>
                    <p class="text-muted">Cancelled by patients</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="row">
        <!-- Recent Appointments -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-calendar-alt me-2"></i>Recent Appointments</span>
                    <a href="{{ route('admin.appointments') }}" class="btn btn-sm btn-outline-light">View All</a>
                </div>
                <div class="card-body">
                    @if($recent_appointments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Patient</th>
                                        <th>Doctor</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recent_appointments as $appointment)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-2" style="width: 30px; height: 30px; font-size: 0.8rem;">
                                                    {{ substr($appointment->patient->name, 0, 1) }}
                                                </div>
                                                {{ $appointment->patient->name }}
                                            </div>
                                        </td>
                                        <td>Dr. {{ $appointment->appointment->doctor->name }}</td>
                                        <td>{{ $appointment->appointment->date }}</td>
                                        <td>
                                            <span class="status-badge status-{{ $appointment->status }}">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No recent appointments</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Doctors -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-user-md me-2"></i>New Doctors</span>
                    <a href="{{ route('admin.doctors') }}" class="btn btn-sm btn-outline-light">View All</a>
                </div>
                <div class="card-body">
                    @if($recent_doctors->count() > 0)
                        @foreach($recent_doctors as $doctor)
                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                            <div class="user-avatar me-3">
                                {{ substr($doctor->name, 0, 1) }}
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Dr. {{ $doctor->name }}</h6>
                                <small class="text-muted">
                                    @if($doctor->specialties->count() > 0)
                                        {{ $doctor->specialties->pluck('special_name')->implode(', ') }}
                                    @else
                                        General Practice
                                    @endif
                                </small>
                            </div>
                            <div class="text-end">
                                <span class="badge {{ $doctor->is_active ? 'bg-success' : 'bg-warning' }}">
                                    {{ $doctor->is_active ? 'Active' : 'Pending' }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-user-md fa-2x text-muted mb-3"></i>
                            <p class="text-muted">No recent doctors</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mt-4">
                <div class="card-header">
                    <i class="fas fa-bolt me-2"></i>Quick Actions
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.specialists.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add Specialist
                        </a>
                        <a href="{{ route('admin.admins.create') }}" class="btn btn-outline-primary">
                            <i class="fas fa-user-plus me-2"></i>Add Admin
                        </a>
                        <a href="{{ route('admin.reports') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-chart-line me-2"></i>View Reports
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Add any dashboard-specific JavaScript here
    console.log('Admin Dashboard loaded');
</script>
@endpush