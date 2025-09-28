@extends('admin.layouts.app')

@section('title', 'Edit Specialist')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.specialists.index') }}">Specialists</a></li>
    <li class="breadcrumb-item active">Edit {{ ucwords($specialist->special_name) }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-warning text-dark">
                    <h5 class="mb-0 d-flex align-items-center">
                        <i class="fas fa-edit me-2"></i>Edit Medical Specialist
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <div class="specialist-icon-large mx-auto mb-3">
                            <i class="fas fa-stethoscope fa-3x text-warning"></i>
                        </div>
                        <h6 class="text-muted">Editing: {{ ucwords($specialist->special_name) }}</h6>
                        <small class="text-muted">ID: #{{ $specialist->id }}</small>
                    </div>

                    <!-- Specialist Info -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-card bg-light p-3 rounded">
                                <h6 class="text-primary mb-2">
                                    <i class="fas fa-user-md me-2"></i>Associated Doctors
                                </h6>
                                <h4 class="mb-0">{{ $specialist->doctors_count ?? 0 }}</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card bg-light p-3 rounded">
                                <h6 class="text-info mb-2">
                                    <i class="fas fa-calendar me-2"></i>Created On
                                </h6>
                                <p class="mb-0">{{ $specialist->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('admin.specialists.update', $specialist->id) }}" method="POST" id="editSpecialistForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="special_name" class="form-label fw-bold">
                                <i class="fas fa-stethoscope me-2 text-warning"></i>Specialist Name
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('special_name') is-invalid @enderror" 
                                   id="special_name" 
                                   name="special_name" 
                                   value="{{ old('special_name', $specialist->special_name) }}" 
                                   placeholder="Enter specialist name"
                                   required>
                            @error('special_name')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                </div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Update the name of the medical specialty
                            </div>
                        </div>

                        @if($specialist->doctors_count > 0)
                            <div class="alert alert-warning">
                                <h6 class="alert-heading">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Important Note
                                </h6>
                                <p class="mb-0">
                                    This specialist is currently associated with <strong>{{ $specialist->doctors_count }}</strong> doctor(s). 
                                    Changing the name will update it for all associated doctors.
                                </p>
                            </div>
                        @endif
                        
                        <div class="d-flex gap-3 justify-content-between">
                            <a href="{{ route('admin.specialists.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Back to List
                            </a>
                            <button type="submit" class="btn btn-warning btn-lg px-4" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Update Specialist
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="card-footer bg-light">
                    <div class="row text-center text-muted">
                        <div class="col-12">
                            <small>
                                <i class="fas fa-clock me-1"></i>
                                Last updated: {{ $specialist->updated_at->format('M d, Y \a\t H:i A') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Associated Doctors -->
            @if($specialist->doctors_count > 0)
            <div class="card shadow mt-4">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-user-md me-2"></i>Associated Doctors ({{ $specialist->doctors_count }})
                    </h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        This specialist is currently associated with {{ $specialist->doctors_count }} doctor(s). 
                        <a href="{{ route('admin.doctors') }}?specialist={{ $specialist->id }}" class="alert-link">
                            View all doctors with this specialty
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const specialistNameInput = document.getElementById('special_name');
    const form = document.getElementById('editSpecialistForm');
    const submitBtn = document.getElementById('submitBtn');
    const originalValue = specialistNameInput.value;
    
    // Form submission with loading state
    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Updating...';
    });
    
    // Input validation feedback
    specialistNameInput.addEventListener('input', function() {
        const value = this.value.trim();
        if (value.length > 0 && value !== originalValue) {
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
            submitBtn.classList.remove('btn-secondary');
            submitBtn.classList.add('btn-warning');
            submitBtn.innerHTML = '<i class="fas fa-save me-2"></i>Update Specialist';
        } else if (value === originalValue) {
            this.classList.remove('is-valid');
            submitBtn.classList.remove('btn-warning');
            submitBtn.classList.add('btn-secondary');
            submitBtn.innerHTML = '<i class="fas fa-save me-2"></i>No Changes';
        } else {
            this.classList.remove('is-valid');
        }
    });
    
    // Auto-focus and select text
    specialistNameInput.focus();
    specialistNameInput.select();
});
</script>
@endpush

@push('styles')
<style>
.bg-gradient-warning {
    background: linear-gradient(135deg, #ffc107, #e0a800) !important;
}

.specialist-icon-large {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: rgba(255, 193, 7, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid rgba(255, 193, 7, 0.3);
}

.card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
}

.info-card {
    border-left: 4px solid #007bff;
    transition: all 0.3s ease;
}

.info-card:hover {
    transform: translateX(2px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.form-control-lg {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.form-control-lg:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
    transform: translateY(-1px);
}

.form-control.is-valid {
    border-color: #28a745;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='m2.3 6.73.19-.18-.19-.18L1.57 6l-.19.18L0 4.8l.66-.64 1.14 1.06L4.8 2.2 5.46 2.86 2.3 6.73z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(.375em + .1875rem) center;
    background-size: calc(.75em + .375rem) calc(.75em + .375rem);
}

.btn-lg {
    border-radius: 10px;
    padding: 12px 24px;
    font-weight: 600;
}

.alert {
    border-radius: 10px;
    border: none;
}

.shadow-lg {
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: slideInUp 0.5s ease-out;
}

.alert-link {
    font-weight: bold;
    text-decoration: underline;
}

.alert-link:hover {
    text-decoration: none;
}
</style>
@endpush