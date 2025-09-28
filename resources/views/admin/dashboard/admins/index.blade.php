@extends('admin.layouts.app')

@section('title', 'Admin Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Admin Management</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-user-shield me-2"></i>Admin Management
                        </h5>
                        <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add New Admin
                        </a>
                    </div>

                    <div class="card-body">
                        @if ($admins->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Admin</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Created</th>
                                            <th>Last Updated</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admins as $admin_user)
                                            <tr>
                                                <td>{{ $loop->iteration + ($admins->currentPage() - 1) * $admins->perPage() }}
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="user-avatar me-3">
                                                            {{ substr($admin_user->name, 0, 1) }}
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">{{ $admin_user->name }}</h6>
                                                            <small class="text-muted">ID: {{ $admin_user->id }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $admin_user->email }}</td>
                                                <td>{{ $admin_user->phone ?? 'N/A' }}</td>
                                                <td>{{ $admin_user->created_at ? $admin_user->created_at->format('M d, Y') : 'N/A' }}
                                                </td>
                                                <td>{{ $admin_user->updated_at ? $admin_user->updated_at->format('M d, Y H:i') : 'N/A' }}
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        {{-- <a href="{{ route('admin.admins.edit', $admin_user->id) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a> --}}

                                                        @if ($admin_user->id !== auth('admin')->id())
                                                            <form method="POST"
                                                                action="{{ route('admin.admins.delete', $admin_user->id) }}"
                                                                class="d-inline"
                                                                onsubmit="return confirm('Are you sure you want to delete this admin?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-outline-danger">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-sm btn-outline-secondary" disabled>
                                                                <i class="fas fa-user"></i>
                                                            </button>
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
                                        Showing {{ $admins->firstItem() }} to {{ $admins->lastItem() }} of
                                        {{ $admins->total() }} admins
                                    </p>
                                </div>
                                <div>
                                    {{ $admins->links() }}
                                </div>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-user-shield fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No admins found</h5>
                                <p class="text-muted">Create the first admin account to get started.</p>
                                <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Add New Admin
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
