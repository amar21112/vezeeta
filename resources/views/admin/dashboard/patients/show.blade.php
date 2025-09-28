@extends('admin.layouts.app')

@section('title', 'Patient Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.patients') }}">Patients</a></li>
    <li class="breadcrumb-item active">{{ $patient->name }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Patient Information -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-user me-2"></i>Patient Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="user-avatar mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                            {{ substr($patient->name, 0, 1) }}
                        </div>
                        <h4>{{ $patient->name }}</h4>
                        <p class="text-muted">Patient ID: #{{ $patient->id }}</p>
                    </div>

                    <div class="patient-details">
                        <div class="row mb-3">
                            <div class="col-4"><strong>Email:</strong></div>
                            <div class="col-8">{{ $patient->email }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4"><strong>Phone:</strong></div>
                            <div class="col-8">{{ $patient->phone ?? 'Not provided' }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4"><strong>Gender:</strong></div>
                            <div class="col-8">
                                @if($patient->gender)
                                    <span class="badge {{ $patient->gender === 'male' ? 'bg-primary' : 'bg-info' }}">
                                        {{ ucfirst($patient->gender) }}
                                    </span>
                                @else
                                    <span class="text-muted">Not specified</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4"><strong>Date of Birth:</strong></div>
                            <div class="col-8">
                                @if($patient->date_of_birth)
                                    {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('M d, Y') }}
                                    <small class="text-muted">({{ \Carbon\Carbon::parse($patient->date_of_birth)->age }} years old)</small>
                                @else
                                    <span class="text-muted">Not provided</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4"><strong>Address:</strong></div>
                            <div class="col-8">{{ $patient->address ?? 'Not provided' }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4"><strong>Joined:</strong></div>
                            <div class="col-8">{{ $patient->created_at ? $patient->created_at->format('M d, Y h:i A') : 'Not available' }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4"><strong>Last Updated:</strong></div>
                            <div class="col-8">{{ $patient->updated_at ? $patient->updated_at->format('M d, Y h:i A') : 'Not available' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Card -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-chart-pie me-2"></i>Appointment Statistics
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <h4 class="text-primary">{{ $appointments->total() }}</h4>
                            <small class="text-muted">Total Appointments</small>
                        </div>
                        <div class="col-6">
                            <h4 class="text-success">{{ $appointments->where('status', 'completed')->count() }}</h4>
                            <small class="text-muted">Completed</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointment History -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-alt me-2"></i>Appointment History
                    </h5>
                    <span class="badge bg-primary">{{ $appointments->total() }} Total</span>
                </div>
                <div class="card-body">
                    @if($appointments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date & Time</th>
                                        <th>Doctor</th>
                                        <th>Specialty</th>
                                        <th>Status</th>
                                        <th>Booked On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                    <tr>
                                        <td>
                                            <strong>{{ \Carbon\Carbon::parse($appointment->appointment->date)->format('M d, Y') }}</strong><br>
                                            <small class="text-muted">{{ $appointment->appointment->time }}</small>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-2" style="width: 30px; height: 30px; font-size: 0.8rem;">
                                                    {{ substr($appointment->appointment->doctor->name, 0, 1) }}
                                                </div>
                                                Dr. {{ $appointment->appointment->doctor->name }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($appointment->appointment->doctor->specialists->count() > 0)
                                                {{ $appointment->appointment->doctor->specialists->first()->name }}
                                            @else
                                                <span class="text-muted">General</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="status-badge status-{{ $appointment->status }}">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $appointment->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.appointments.show', $appointment->id) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $appointments->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No Appointments</h5>
                            <p class="text-muted">This patient hasn't made any appointments yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('admin.patients') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Patients
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .patient-details .row {
        border-bottom: 1px solid #eee;
        padding: 0.5rem 0;
    }
    
    .patient-details .row:last-child {
        border-bottom: none;
    }
</style>
@endpush