@extends('admin.layouts.app')

@section('title', 'Appointments Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Appointments</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-check me-2"></i>Appointments Management
                    </h5>
                </div>
                
                <div class="card-body">
                    <!-- Filters -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <form method="GET" action="{{ route('admin.appointments') }}">
                                @if(request('date_from')) <input type="hidden" name="date_from" value="{{ request('date_from') }}"> @endif
                                @if(request('date_to')) <input type="hidden" name="date_to" value="{{ request('date_to') }}"> @endif
                                <select class="form-select" name="status" onchange="this.form.submit()">
                                    <option value="">All Statuses</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <form method="GET" action="{{ route('admin.appointments') }}">
                                @if(request('status')) <input type="hidden" name="status" value="{{ request('status') }}"> @endif
                                @if(request('date_to')) <input type="hidden" name="date_to" value="{{ request('date_to') }}"> @endif
                                <input type="date" class="form-control" name="date_from" 
                                       value="{{ request('date_from') }}" 
                                       onchange="this.form.submit()"
                                       placeholder="From Date">
                            </form>
                        </div>
                        <div class="col-md-3">
                            <form method="GET" action="{{ route('admin.appointments') }}">
                                @if(request('status')) <input type="hidden" name="status" value="{{ request('status') }}"> @endif
                                @if(request('date_from')) <input type="hidden" name="date_from" value="{{ request('date_from') }}"> @endif
                                <input type="date" class="form-control" name="date_to" 
                                       value="{{ request('date_to') }}" 
                                       onchange="this.form.submit()"
                                       placeholder="To Date">
                            </form>
                        </div>
                        <div class="col-md-3 text-end">
                            @if(request()->hasAny(['status', 'date_from', 'date_to']))
                                <a href="{{ route('admin.appointments') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Clear Filters
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Appointments Table -->
                    @if($appointments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Patient</th>
                                        <th>Doctor</th>
                                        <th>Date & Time</th>
                                        <th>Status</th>
                                        <th>Booked On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                    <tr>
                                        <td>{{ $loop->iteration + ($appointments->currentPage() - 1) * $appointments->perPage() }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-3">
                                                    {{ substr($appointment->patient->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $appointment->patient->name }}</h6>
                                                    <small class="text-muted">{{ $appointment->patient->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-2">
                                                    {{ substr($appointment->appointment->doctor->name, 0, 1) }}
                                                </div>
                                                Dr. {{ $appointment->appointment->doctor->name }}
                                            </div>
                                        </td>
                                        <td>
                                            <strong>{{ \Carbon\Carbon::parse($appointment->appointment->date)->format('M d, Y') }}</strong><br>
                                            <small class="text-muted">{{ $appointment->appointment->time }}</small>
                                        </td>
                                        <td>
                                            <span class="status-badge status-{{ $appointment->status }}">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $appointment->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.appointments.show', $appointment->id) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                                @if($appointment->status === 'pending')
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-warning dropdown-toggle" 
                                                                type="button" data-bs-toggle="dropdown">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <form method="POST" action="{{ route('admin.appointments.update-status', $appointment->id) }}">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" name="status" value="confirmed">
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i class="fas fa-check text-success me-2"></i>Confirm
                                                                    </button>
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <form method="POST" action="{{ route('admin.appointments.update-status', $appointment->id) }}">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" name="status" value="cancelled">
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i class="fas fa-times text-danger me-2"></i>Cancel
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div>
                                <p class="text-muted mb-0">
                                    Showing {{ $appointments->firstItem() }} to {{ $appointments->lastItem() }} of {{ $appointments->total() }} appointments
                                </p>
                            </div>
                            <div>
                                {{ $appointments->appends(request()->query())->links() }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No appointments found</h5>
                            @if(request()->hasAny(['status', 'date_from', 'date_to']))
                                <p class="text-muted">No appointments match your filter criteria.</p>
                                <a href="{{ route('admin.appointments') }}" class="btn btn-primary">
                                    <i class="fas fa-list me-2"></i>View All Appointments
                                </a>
                            @else
                                <p class="text-muted">No appointments have been made yet.</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection