@extends('admin.layouts.app')

@section('title', 'Doctors Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Doctors</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-user-md me-2"></i>Doctors Management
                        </h5>
                    </div>

                    <div class="card-body">
                        <!-- Search and Filters -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <form method="GET" action="{{ route('admin.doctors') }}" class="d-flex">
                                    <input type="text" class="form-control me-2" name="search"
                                        placeholder="Search doctors..." value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <form method="GET" action="{{ route('admin.doctors') }}">
                                    @if (request('search'))
                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                    @endif
                                    <select class="form-select" name="specialist" onchange="this.form.submit()">
                                        <option value="">All Specialists</option>
                                        @foreach ($specialists as $specialist)
                                            <option value="{{ $specialist->id }}"
                                                {{ request('specialist') == $specialist->id ? 'selected' : '' }}>
                                                {{ $specialist->special_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                            <div class="col-md-4 text-end">
                                @if (request('search') || request('specialist'))
                                    <a href="{{ route('admin.doctors') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-2"></i>Clear Filters
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Doctors Table -->
                        @if ($doctors->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Doctor</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Specialties</th>
                                            <th>Status</th>
                                            <th>Joined</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($doctors as $doctor)
                                            <tr>
                                                <td>{{ $loop->iteration + ($doctors->currentPage() - 1) * $doctors->perPage() }}
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="user-avatar me-3">
                                                            {{ substr($doctor->name, 0, 1) }}
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">Dr. {{ $doctor->name }}</h6>
                                                            <small class="text-muted">ID: {{ $doctor->id }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $doctor->email }}</td>
                                                <td>{{ $doctor->phone ?? 'N/A' }}</td>
                                                <td>
                                                    @if ($doctor->specialties->count() > 0)
                                                        @foreach ($doctor->specialties->take(2) as $specialty)
                                                            <span
                                                                class="badge bg-info me-1">{{ $specialty->special_name }}</span>
                                                        @endforeach
                                                        @if ($doctor->specialties->count() > 2)
                                                            <span
                                                                class="text-muted">+{{ $doctor->specialties->count() - 2 }}
                                                                more</span>
                                                        @endif
                                                    @else
                                                        <span class="text-muted">No specialties</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge {{ $doctor->is_active ? 'bg-success' : 'bg-warning' }}">
                                                        {{ $doctor->is_active ? 'Active' : 'Pending' }}
                                                    </span>
                                                </td>
                                                <td>{{ $doctor->created_at ? $doctor->created_at->format('M d, Y') : 'Not available' }}
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        {{-- <a href="{{ route('admin.doctors.show', $doctor->id) }}"
                                                            class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a> --}}

                                                        <form method="POST"
                                                            action="{{ route('admin.doctors.toggle-status', $doctor->id) }}"
                                                            class="d-inline"
                                                            onsubmit="return confirm('Are you sure you want to {{ $doctor->is_active ? 'suspend' : 'activate' }} this doctor?')">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit"
                                                                class="btn btn-sm {{ $doctor->is_active ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                                                <i
                                                                    class="fas {{ $doctor->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                                            </button>
                                                        </form>
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
                                        Showing {{ $doctors->firstItem() }} to {{ $doctors->lastItem() }} of
                                        {{ $doctors->total() }} doctors
                                    </p>
                                </div>
                                <div>
                                    {{ $doctors->appends(request()->query())->links() }}
                                </div>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-user-md fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No doctors found</h5>
                                @if (request('search') || request('specialist'))
                                    <p class="text-muted">No doctors match your search criteria.</p>
                                    <a href="{{ route('admin.doctors') }}" class="btn btn-primary">
                                        <i class="fas fa-list me-2"></i>View All Doctors
                                    </a>
                                @else
                                    <p class="text-muted">No doctors have registered yet.</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
