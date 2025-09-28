@extends('layouts.app')
@section('title', 'Patient Profile - Vezeeta')
@section('content')

    @include('components.alert')

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-2 py-3 text-sm text-gray-600">
                <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800">Vezeeta</a>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                <span class="text-gray-800">Patient Profile</span>
            </div>
        </div>
    </div>
    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Include Patient Sidebar Component -->
            @php
                // Set sidebar data from authenticated user
                $patient_name = $user->name;
                $patient_id = '#PT-' . date('Y') . '-' . str_pad($user->id, 3, '0', STR_PAD_LEFT);
                $patient_avatar =
                    $user->avatar ??
                    'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face';
                $appointments_count = $user->appointments ? $user->appointments->count() : 0;
                $completed_appointments = $user->appointments
                    ? $user->appointments->where('status', 'completed')->count()
                    : 0;
                $current_page = 'profile';
            @endphp
            @include('components.patient-sidebar', [
                'patient_name' => $patient_name,
                'patient_id' => $patient_id,
                'patient_avatar' => $patient_avatar,
                'appointments_count' => $appointments_count,
                'completed_appointments' => $completed_appointments,
                'current_page' => $current_page,
            ])

            <!-- Main Content -->
            <main class="lg:w-3/4 w-full">
                <div class="bg-white rounded-xl shadow-lg">
                    <!-- Header -->
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-semibold text-gray-900">Manage Profile</h2>
                            <div class="flex items-center space-x-2 text-sm text-gray-500">
                                <i class="fas fa-shield-check text-green-500"></i>
                                <span>Your information is secure</span>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Form -->
                    <div class="p-6">
                        <form id="profileForm" method="POST" action="{{ route('patient.profile.update') }}"
                            class="space-y-6">
                            @csrf
                            @method('PUT')
                            <!-- Personal Information Section -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                    <!-- Name Field -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Full Name <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('name') border-red-500 @enderror"
                                                placeholder="Enter your full name" required>
                                            @error('name')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                                <i class="fas fa-user text-gray-400"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email Field -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Email Address <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('email') border-red-500 @enderror"
                                                placeholder="Enter your email address" required>
                                            @error('email')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                                <i class="fas fa-envelope text-gray-400"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Mobile Number Field -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Mobile Number <span class="text-red-500">*</span>
                                        </label>
                                        <div class="flex space-x-2">
                                            <select name="country_code"
                                                class="block w-32 px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                                <option value="+20" selected>🇪🇬 +20</option>
                                                <option value="+966">🇸🇦 +966</option>
                                                <option value="+971">🇦🇪 +971</option>
                                                <option value="+1">🇺🇸 +1</option>
                                                <option value="+44">🇬🇧 +44</option>
                                            </select>
                                            <div class="relative flex-1">
                                                <input type="tel" name="phone"
                                                    value="{{ old('phone', $user->phone ?? '') }}"
                                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('phone') border-red-500 @enderror"
                                                    placeholder="Enter mobile number">
                                                @error('phone')
                                                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                                @enderror
                                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                                    <i class="fas fa-phone text-gray-400"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Birth Date Field -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Date of Birth
                                        </label>
                                        <div class="relative">
                                            <input type="date" name="birthday"
                                                id="birthday"
                                                value="{{ old('birthday', $user->birthday) }}"
                                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('birthday') border-red-500 @enderror">
                                            @error('birthday')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                                <button type="button" onclick="resetForm()"
                                    class="px-6 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-200 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                                    <i class="fas fa-undo mr-2"></i>
                                    Reset
                                </button>
                                <button type="submit"
                                    class="px-8 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                    <i class="fas fa-save mr-2"></i>
                                    Save Changes
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- Additional Info Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <!-- Account Security -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Account Security</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-shield-check text-green-500"></i>
                                    <span class="text-sm text-gray-700">Two-Factor Authentication</span>
                                </div>
                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Active</span>
                            </div>
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-key text-blue-500"></i>
                                    <span class="text-sm text-gray-700">Password</span>
                                </div>
                                <button class="text-xs text-blue-600 hover:text-blue-800">Change</button>
                            </div>
                            <div class="flex items-center justify-between py-3">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-clock text-gray-400"></i>
                                    <span class="text-sm text-gray-700">Last Login</span>
                                </div>
                                <span class="text-xs text-gray-500">2 hours ago</span>
                            </div>
                        </div>
                    </div>

                    <!-- Medical Info -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Medical Information</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-heartbeat text-red-500"></i>
                                    <span class="text-sm text-gray-700">Blood Type</span>
                                </div>
                                <span class="text-sm font-medium text-gray-900">O+</span>
                            </div>
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-pills text-orange-500"></i>
                                    <span class="text-sm text-gray-700">Allergies</span>
                                </div>
                                <span class="text-sm text-gray-900">Penicillin</span>
                            </div>
                            <div class="flex items-center justify-between py-3">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-notes-medical text-blue-500"></i>
                                    <span class="text-sm text-gray-700">Medical Records</span>
                                </div>
                                <button class="text-xs text-blue-600 hover:text-blue-800">View All</button>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

        </div>
    </div>

    <!-- Success Toast (Hidden by default) -->
    <div id="successToast"
        class="fixed top-4 -right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50">
        <div class="flex items-center space-x-2">
            <i class="fas fa-check-circle"></i>
            <span>Profile updated successfully!</span>
        </div>
    </div>

    <script>
        // Form handling - actual form submission
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            // Show loading state
            const submitBtn = e.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';
            submitBtn.disabled = true;

            // Let the form submit naturally to Laravel backend
            // The loading state will be reset when the page reloads or redirects
        });

        // Reset form function
        function resetForm() {
            if (confirm('Are you sure you want to reset all changes?')) {
                document.getElementById('profileForm').reset();
            }
        }
    </script>
@endsection
