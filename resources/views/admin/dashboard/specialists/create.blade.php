@extends('admin.layouts.app')

@section('title', 'Add New Specialist')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.specialists.index') }}">Specialists</a></li>
    <li class="breadcrumb-item active">Add New Specialist</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-primary text-white">
                    <h5 class="mb-0 d-flex align-items-center">
                        <i class="fas fa-plus-circle me-2"></i>Add New Medical Specialist
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <div class="specialist-icon-large mx-auto mb-3">
                            <i class="fas fa-stethoscope fa-3x text-primary"></i>
                        </div>
                        <p class="text-muted">Create a new medical specialty to categorize doctors</p>
                    </div>

                    <form action="{{ route('admin.specialists.store') }}" method="POST" id="createSpecialistForm">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="special_name" class="form-label fw-bold">
                                <i class="fas fa-stethoscope me-2 text-primary"></i>Specialist Name
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('special_name') is-invalid @enderror" 
                                   id="special_name" 
                                   name="special_name" 
                                   value="{{ old('special_name') }}" 
                                   placeholder="Enter specialist name (e.g., Cardiology, Pediatrics)"
                                   required>
                            @error('special_name')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                </div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Enter the name of the medical specialty (e.g., Cardiology, Dermatology, Orthopedics)
                            </div>
                        </div>

                        <!-- Common Specialists Suggestions -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted mb-2">
                                <i class="fas fa-lightbulb me-2"></i>Common Specialists
                            </label>
                            <div class="d-flex flex-wrap gap-2">
                                <button type="button" class="btn btn-outline-primary btn-sm specialist-suggestion" data-name="Cardiology">
                                    <i class="fas fa-heartbeat me-1"></i>Cardiology
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-sm specialist-suggestion" data-name="Dermatology">
                                    <i class="fas fa-hand-paper me-1"></i>Dermatology
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-sm specialist-suggestion" data-name="Pediatrics">
                                    <i class="fas fa-baby me-1"></i>Pediatrics
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-sm specialist-suggestion" data-name="Orthopedics">
                                    <i class="fas fa-bone me-1"></i>Orthopedics
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-sm specialist-suggestion" data-name="Neurology">
                                    <i class="fas fa-brain me-1"></i>Neurology
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-sm specialist-suggestion" data-name="Ophthalmology">
                                    <i class="fas fa-eye me-1"></i>Ophthalmology
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-sm specialist-suggestion" data-name="Dentistry">
                                    <i class="fas fa-tooth me-1"></i>Dentistry
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-sm specialist-suggestion" data-name="Psychiatry">
                                    <i class="fas fa-user-md me-1"></i>Psychiatry
                                </button>
                            </div>
                            <small class="text-muted">
                                <i class="fas fa-mouse-pointer me-1"></i>Click on any suggestion to use it
                            </small>
                        </div>
                        
                        <div class="d-flex gap-3 justify-content-between">
                            <a href="{{ route('admin.specialists.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Back to List
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-4" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Create Specialist
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="card-footer bg-light">
                    <div class="row text-center text-muted">
                        <div class="col-4">
                            <i class="fas fa-check-circle text-success"></i>
                            <small class="d-block">Easy Setup</small>
                        </div>
                        <div class="col-4">
                            <i class="fas fa-users text-info"></i>
                            <small class="d-block">Organize Doctors</small>
                        </div>
                        <div class="col-4">
                            <i class="fas fa-chart-line text-warning"></i>
                            <small class="d-block">Better Management</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const specialistNameInput = document.getElementById('special_name');
    const form = document.getElementById('createSpecialistForm');
    const submitBtn = document.getElementById('submitBtn');
    
    // Handle specialist suggestions
    document.querySelectorAll('.specialist-suggestion').forEach(button => {
        button.addEventListener('click', function() {
            const suggestionName = this.getAttribute('data-name');
            specialistNameInput.value = suggestionName;
            specialistNameInput.focus();
            
            // Add visual feedback
            this.classList.remove('btn-outline-primary');
            this.classList.add('btn-primary');
            setTimeout(() => {
                this.classList.remove('btn-primary');
                this.classList.add('btn-outline-primary');
            }, 300);
        });
    });
    
    // Form submission with loading state
    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating...';
    });
    
    // Input validation feedback
    specialistNameInput.addEventListener('input', function() {
        const value = this.value.trim();
        if (value.length > 0) {
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
        } else {
            this.classList.remove('is-valid');
        }
    });
    
    // Auto-focus on the input field
    specialistNameInput.focus();
});
</script>
@endpush

@push('styles')
<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff, #0056b3) !important;
}

.specialist-icon-large {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: rgba(0, 123, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid rgba(0, 123, 255, 0.2);
}

.card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
}

.form-control-lg {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.form-control-lg:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    transform: translateY(-1px);
}

.form-control.is-valid {
    border-color: #28a745;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='m2.3 6.73.19-.18-.19-.18L1.57 6l-.19.18L0 4.8l.66-.64 1.14 1.06L4.8 2.2 5.46 2.86 2.3 6.73z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(.375em + .1875rem) center;
    background-size: calc(.75em + .375rem) calc(.75em + .375rem);
}

.specialist-suggestion {
    transition: all 0.2s ease;
    border-radius: 20px;
}

.specialist-suggestion:hover {
    transform: translateY(-2px);
    box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
}

.btn-lg {
    border-radius: 10px;
    padding: 12px 24px;
    font-weight: 600;
}

.card-footer {
    border-top: 1px solid rgba(0,0,0,0.1);
    background: linear-gradient(135deg, #f8f9fa, #e9ecef) !important;
}

.shadow-lg {
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.form-text {
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

.invalid-feedback {
    font-weight: 500;
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
</style>
@endpush
