
    @extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#0073d1] via-[#0056b3] to-[#004085] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-lg w-full space-y-8">
        <!-- Header Section -->
        <div class="text-center">
            <div class="mx-auto h-20 w-20 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-user-shield text-3xl text-white"></i>
            </div>
            <h2 class="text-3xl font-bold text-white mb-2">Create Admin Account</h2>
            <p class="text-blue-100 text-sm">Join the administration team</p>
        </div>

        <!-- Registration Card -->
        <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl p-8 border border-white/20">
            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.register.submit') }}" class="space-y-6">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user mr-2 text-blue-600"></i>Full Name
                    </label>
                    <div class="relative">
                        <input type="text" 
                               name="name" 
                               id="name"
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('name') border-red-500 @enderror"
                               value="{{ old('name') }}" 
                               required 
                               maxlength="255"
                               placeholder="Enter your full name">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i class="fas fa-id-card text-gray-400"></i>
                        </div>
                    </div>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2 text-blue-600"></i>Email Address
                    </label>
                    <div class="relative">
                        <input type="email" 
                               name="email" 
                               id="email"
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('email') border-red-500 @enderror"
                               value="{{ old('email') }}" 
                               required
                               placeholder="admin@vezeeta.com">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i class="fas fa-at text-gray-400"></i>
                        </div>
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Field -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-phone mr-2 text-blue-600"></i>Phone Number <span class="text-gray-500">(Optional)</span>
                    </label>
                    <div class="relative">
                        <input type="text" 
                               name="phone" 
                               id="phone"
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('phone') border-red-500 @enderror"
                               value="{{ old('phone') }}" 
                               placeholder="+1234567890">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i class="fas fa-mobile-alt text-gray-400"></i>
                        </div>
                    </div>
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Fields Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2 text-blue-600"></i>Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="password" 
                                   id="password"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('password') border-red-500 @enderror"
                                   required 
                                   minlength="8"
                                   placeholder="Minimum 8 characters">
                            <button type="button" 
                                    class="absolute inset-y-0 right-0 flex items-center pr-3"
                                    onclick="togglePassword('password')">
                                <i class="fas fa-eye text-gray-400 hover:text-gray-600 cursor-pointer" id="password-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2 text-blue-600"></i>Confirm Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password_confirmation"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('password_confirmation') border-red-500 @enderror"
                                   required 
                                   minlength="8"
                                   placeholder="Re-enter password">
                            <button type="button" 
                                    class="absolute inset-y-0 right-0 flex items-center pr-3"
                                    onclick="togglePassword('password_confirmation')">
                                <i class="fas fa-eye text-gray-400 hover:text-gray-600 cursor-pointer" id="password_confirmation-eye"></i>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password Strength Indicator -->
                <div id="password-strength" class="hidden">
                    <div class="text-xs text-gray-600 mb-2">Password Strength:</div>
                    <div class="flex space-x-1 mb-2">
                        <div class="h-2 bg-gray-200 rounded-full flex-1"></div>
                        <div class="h-2 bg-gray-200 rounded-full flex-1"></div>
                        <div class="h-2 bg-gray-200 rounded-full flex-1"></div>
                        <div class="h-2 bg-gray-200 rounded-full flex-1"></div>
                    </div>
                    <div class="text-xs text-gray-500" id="strength-text">Enter password</div>
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms" 
                               name="terms" 
                               type="checkbox" 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                               required>
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="text-gray-700">
                            I agree to the 
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500 transition-colors duration-200">Terms and Conditions</a>
                            and 
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500 transition-colors duration-200">Privacy Policy</a>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all duration-200 hover:scale-105 shadow-lg hover:shadow-xl">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-user-plus text-blue-300 group-hover:text-blue-200"></i>
                        </span>
                        Create Admin Account
                    </button>
                </div>

                <!-- Alternative Actions -->
                <div class="text-center pt-6 border-t border-gray-200">
                    <p class="text-sm text-gray-600 mb-4">Already have an admin account?</p>
                    <a href="{{ route('admin.login') }}" 
                       class="inline-flex items-center px-4 py-2 border border-blue-600 text-sm font-medium rounded-lg text-blue-600 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Sign In Instead
                    </a>
                </div>
            </form>
        </div>

        <!-- Footer Links -->
        <div class="text-center">
            <div class="flex justify-center space-x-6 text-blue-100">
                <a href="{{ route('user.register') }}" class="hover:text-white transition-colors duration-200 text-sm">
                    <i class="fas fa-user mr-1"></i>Patient Register
                </a>
                <a href="{{ route('doctor.register') }}" class="hover:text-white transition-colors duration-200 text-sm">
                    <i class="fas fa-user-md mr-1"></i>Doctor Register
                </a>
                <a href="{{ route('home') }}" class="hover:text-white transition-colors duration-200 text-sm">
                    <i class="fas fa-home mr-1"></i>Back to Home
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Scripts -->
<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const eye = document.getElementById(fieldId + '-eye');
    
    if (field.type === 'password') {
        field.type = 'text';
        eye.className = 'fas fa-eye-slash text-gray-400 hover:text-gray-600 cursor-pointer';
    } else {
        field.type = 'password';
        eye.className = 'fas fa-eye text-gray-400 hover:text-gray-600 cursor-pointer';
    }
}

// Password Strength Checker
document.addEventListener('DOMContentLoaded', function() {
    const passwordField = document.getElementById('password');
    const strengthIndicator = document.getElementById('password-strength');
    const strengthText = document.getElementById('strength-text');
    const strengthBars = strengthIndicator.querySelectorAll('.flex-1');
    
    passwordField.addEventListener('input', function() {
        const password = this.value;
        strengthIndicator.classList.remove('hidden');
        
        let strength = 0;
        let feedback = [];
        
        // Length check
        if (password.length >= 8) strength++;
        else feedback.push('At least 8 characters');
        
        // Uppercase check
        if (/[A-Z]/.test(password)) strength++;
        else feedback.push('One uppercase letter');
        
        // Lowercase check
        if (/[a-z]/.test(password)) strength++;
        else feedback.push('One lowercase letter');
        
        // Number or symbol check
        if (/[\d\W]/.test(password)) strength++;
        else feedback.push('One number or symbol');
        
        // Update bars
        strengthBars.forEach((bar, index) => {
            bar.className = 'h-2 rounded-full flex-1 ' + 
                (index < strength ? getStrengthColor(strength) : 'bg-gray-200');
        });
        
        // Update text
        const strengthLabels = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
        strengthText.textContent = password.length > 0 ? 
            strengthLabels[strength] + (feedback.length > 0 ? ' - Need: ' + feedback.join(', ') : '') : 
            'Enter password';
    });
    
    function getStrengthColor(strength) {
        const colors = ['bg-red-500', 'bg-orange-500', 'bg-yellow-500', 'bg-blue-500', 'bg-green-500'];
        return colors[strength - 1] || 'bg-gray-200';
    }
    
    // Form submission loading
    const form = document.querySelector('form');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    form.addEventListener('submit', function() {
        submitBtn.innerHTML = `
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <i class="fas fa-spinner fa-spin text-blue-300"></i>
            </span>
            Creating Account...
        `;
        submitBtn.disabled = true;
    });
    
    // Password confirmation validation
    const confirmField = document.getElementById('password_confirmation');
    confirmField.addEventListener('input', function() {
        if (this.value !== passwordField.value) {
            this.setCustomValidity('Passwords do not match');
        } else {
            this.setCustomValidity('');
        }
    });
});
</script>

<style>
/* Custom animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.max-w-lg {
    animation: fadeInUp 0.6s ease-out;
}

/* Enhanced form styling */
input:focus {
    transform: translateY(-1px);
    box-shadow: 0 10px 25px rgba(0, 115, 209, 0.1);
}

/* Gradient background animation */
.bg-gradient-to-br {
    background-size: 200% 200%;
    animation: gradientShift 10s ease infinite;
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Glass morphism effect */
.backdrop-blur-sm {
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

/* Button hover effects */
button:hover {
    box-shadow: 0 10px 25px rgba(0, 115, 209, 0.3);
}

/* Grid responsive adjustments */
@media (max-width: 768px) {
    .grid-cols-2 {
        grid-template-columns: repeat(1, minmax(0, 1fr));
    }
}
</style>
@endsection
