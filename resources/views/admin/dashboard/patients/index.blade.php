@extends('admin.layouts.app')

@section('title', 'Patients Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Patients</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-users me-2"></i>Patients Management
                        </h5>
                    </div>

                    <div class="card-body">
                        <!-- Search and Filters -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <form method="GET" action="{{ route('admin.patients') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search"
                                            placeholder="Search patients by name, email, or phone..."
                                            value="{{ request('search') }}">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6 text-end">
                                @if (request('search'))
                                    <a href="{{ route('admin.patients') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-2"></i>Clear Search
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Patients Table -->
                        @if ($patients->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Patient</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Gender</th>
                                            <th>Date of Birth</th>
                                            <th>Joined</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patients as $patient)
                                            <tr>
                                                <td>{{ $loop->iteration + ($patients->currentPage() - 1) * $patients->perPage() }}
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="user-avatar me-3">
                                                            {{ substr($patient->name, 0, 1) }}
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">{{ $patient->name }}</h6>
                                                            <small class="text-muted">ID: {{ $patient->id }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $patient->email }}</td>
                                                <td>{{ $patient->phone ?? 'N/A' }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $patient->gender === 'male' ? 'bg-primary' : 'bg-info' }}">
                                                        {{ $patient->gender ? ucfirst($patient->gender) : 'N/A' }}
                                                    </span>
                                                </td>
                                                <td>{{ $patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->format('M d, Y') : 'N/A' }}
                                                </td>
                                                <td>{{ $patient->created_at ? $patient->created_at->format('M d, Y') : 'N/A' }}
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.patients.show', $patient->id) }}"
                                                            class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
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
                                        Showing {{ $patients->firstItem() }} to {{ $patients->lastItem() }} of
                                        {{ $patients->total() }} patients
                                    </p>
                                </div>
                                <div>
                                    {{ $patients->links() }}
                                </div>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No patients found</h5>
                                @if (request('search'))
                                    <p class="text-muted">No patients match your search criteria.</p>
                                    <a href="{{ route('admin.patients') }}" class="btn btn-primary">
                                        <i class="fas fa-list me-2"></i>View All Patients
                                    </a>
                                @else
                                    <p class="text-muted">No patients have registered yet.</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
