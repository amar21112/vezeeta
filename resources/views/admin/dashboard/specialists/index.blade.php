@extends('admin.layouts.app')

@section('title', 'Specialists Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Specialists</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-stethoscope me-2"></i>Medical Specialists Management
                    </h5>
                    <a href="{{ route('admin.specialists.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add New Specialist
                    </a>
                </div>
                
                <div class="card-body">
                    <!-- Search Section -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <form method="GET" action="{{ route('admin.specialists.index') }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" 
                                           placeholder="Search specialists by name..."
                                           value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 text-end">
                            @if(request('search'))
                                <a href="{{ route('admin.specialists.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Clear Search
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-stethoscope fa-2x mb-2"></i>
                                    <h4>{{ $specialists->total() }}</h4>
                                    <small>Total Specialists</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-user-md fa-2x mb-2"></i>
                                    <h4>{{ $specialists->sum('doctors_count') }}</h4>
                                    <small>Total Doctors</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-chart-line fa-2x mb-2"></i>
                                    <h4>{{ $specialists->where('doctors_count', '>', 0)->count() }}</h4>
                                    <small>Active Specialists</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-plus-circle fa-2x mb-2"></i>
                                    <h4>{{ $specialists->where('doctors_count', 0)->count() }}</h4>
                                    <small>Without Doctors</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Specialists Table -->
                    @if($specialists->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="50">#</th>
                                        <th>Specialist Name</th>
                                        <th>Doctors Count</th>
                                        <th>Created Date</th>
                                        <th>Last Updated</th>
                                        <th width="120">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($specialists as $specialist)
                                    <tr>
                                        <td>{{ $loop->iteration + ($specialists->currentPage() - 1) * $specialists->perPage() }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="specialist-icon me-3">
                                                    <i class="fas fa-stethoscope text-primary fa-lg"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ ucwords($specialist->special_name) }}</h6>
                                                    <small class="text-muted">ID: {{ $specialist->id }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($specialist->doctors_count > 0)
                                                <span class="badge bg-success fs-6">
                                                    <i class="fas fa-user-md me-1"></i>{{ $specialist->doctors_count }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary fs-6">
                                                    <i class="fas fa-minus me-1"></i>0
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span>{{ $specialist->created_at->format('M d, Y') }}</span>
                                                <small class="text-muted">{{ $specialist->created_at->format('H:i A') }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span>{{ $specialist->updated_at->format('M d, Y') }}</span>
                                                <small class="text-muted">{{ $specialist->updated_at->format('H:i A') }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.specialists.edit', $specialist->id) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="Edit Specialist">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                @if($specialist->doctors_count == 0)
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            onclick="confirmDelete({{ $specialist->id }}, '{{ $specialist->special_name }}')"
                                                            title="Delete Specialist">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @else
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-secondary" 
                                                            disabled
                                                            title="Cannot delete - has associated doctors">
                                                        <i class="fas fa-ban"></i>
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
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 pt-3 border-top">
                            <div class="mb-2 mb-md-0">
                                <p class="text-muted mb-0 small">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Showing <strong>{{ $specialists->firstItem() }}</strong> to <strong>{{ $specialists->lastItem() }}</strong> 
                                    of <strong>{{ $specialists->total() }}</strong> specialists
                                </p>
                            </div>
                            <div class="pagination-wrapper">
                                {{ $specialists->appends(request()->query())->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-stethoscope fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No specialists found</h5>
                            @if(request('search'))
                                <p class="text-muted">No specialists match your search criteria.</p>
                                <a href="{{ route('admin.specialists.index') }}" class="btn btn-primary">
                                    <i class="fas fa-list me-2"></i>View All Specialists
                                </a>
                            @else
                                <p class="text-muted">Start by creating your first medical specialist.</p>
                                <a href="{{ route('admin.specialists.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Add First Specialist
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle text-danger me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the specialist <strong id="specialistName"></strong>?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-info-circle me-2"></i>
                    This action cannot be undone.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Specialist
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(id, name) {
    document.getElementById('specialistName').textContent = name;
    document.getElementById('deleteForm').action = `/admin/dashboard/specialists/${id}`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Add loading states to buttons
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
                
                // Re-enable after 3 seconds if still disabled
                setTimeout(() => {
                    if (submitBtn.disabled) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    }
                }, 3000);
            }
        });
    });
});
</script>
@endpush

@push('styles')
<style>
.specialist-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(0, 116, 209, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid rgba(0, 116, 209, 0.2);
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background-color: rgba(0, 116, 209, 0.05);
}

.btn-group .btn {
    margin-right: 2px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

.badge {
    font-weight: 500;
}

.modal-content {
    border-radius: 15px;
    border: none;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.modal-header {
    border-bottom: 1px solid #dee2e6;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
}

.alert {
    border-radius: 10px;
}

/* Enhanced Pagination Styles */
.pagination-wrapper {
    display: flex;
    align-items: center;
}

.pagination {
    margin-bottom: 0;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.pagination .page-item {
    margin: 0 2px;
}

.pagination .page-item:first-child {
    margin-left: 0;
}

.pagination .page-item:last-child {
    margin-right: 0;
}

.pagination .page-link {
    border: none;
    color: #6c757d;
    font-weight: 500;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
    transition: all 0.3s ease;
    background-color: #f8f9fa;
    margin: 0 1px;
}

.pagination .page-link:hover {
    background-color: #e9ecef;
    color: #495057;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.pagination .page-item.active .page-link {
    background-color: #007bff;
    color: white;
    box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
    transform: translateY(-1px);
}

.pagination .page-item.disabled .page-link {
    color: #adb5bd;
    background-color: #f8f9fa;
    opacity: 0.5;
}

.pagination .page-link:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Previous/Next button icons */
.pagination .page-item:first-child .page-link::before {
    content: '‹';
    font-weight: bold;
    font-size: 1.2em;
}

.pagination .page-item:last-child .page-link::before {
    content: '›';
    font-weight: bold;
    font-size: 1.2em;
}

/* Responsive pagination */
@media (max-width: 576px) {
    .pagination-wrapper {
        justify-content: center;
        width: 100%;
    }
    
    .pagination .page-link {
        padding: 0.4rem 0.6rem;
        font-size: 0.875rem;
    }
    
    /* Hide page numbers on small screens, only show prev/next */
    .pagination .page-item:not(:first-child):not(:last-child) {
        display: none;
    }
    
    .pagination .page-item.active {
        display: inline-block;
    }
}

/* Border top styling */
.border-top {
    border-top: 2px solid #e9ecef !important;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.card {
    animation: fadeIn 0.5s ease-out;
}
</style>
@endpush
