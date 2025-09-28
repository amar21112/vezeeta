@extends('layouts.app')
@section('title', 'Change Password - Vezeeta')
@section('content')

    @include('components.alert')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Patient Sidebar -->
            @php
                $patient_name = auth()->user()->name;
                $patient_id = '#PT-' . date('Y') . '-' . str_pad(auth()->id(), 3, '0', STR_PAD_LEFT);
                $patient_avatar = auth()->user()->avatar ?? 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face';
                $current_page = 'settings';
            @endphp
            @include('components.patient-sidebar', [
                'patient_name' => $patient_name,
                'patient_id' => $patient_id,
                'patient_avatar' => $patient_avatar,
                'current_page' => $current_page,
            ])

            <!-- Change Password Form -->
            <main class="lg:w-3/4 w-full">
                <div class="bg-white rounded-xl shadow-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Change Password</h2>
                        <p class="text-sm text-gray-600 mt-1">Update your password to keep your account secure</p>
                    </div>

                    <div class="p-6">
                        <form method="POST" action="{{ route('patient.change-password.update') }}" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <!-- Current Password -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Current Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" name="current_password" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('current_password') border-red-500 @enderror"
                                        required>
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword('current_password')">
                                        <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="current_password_icon"></i>
                                    </button>
                                </div>
                                @error('current_password')
                                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    New Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" name="password" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror"
                                        required>
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword('password')">
                                        <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="password_icon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror
                                <div class="text-xs text-gray-500 mt-1">
                                    Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.
                                </div>
                            </div>

                            <!-- Confirm New Password -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Confirm New Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('password_confirmation') border-red-500 @enderror"
                                        required>
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword('password_confirmation')">
                                        <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="password_confirmation_icon"></i>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Security Tips -->
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-blue-900 mb-2">
                                    <i class="fas fa-shield-alt mr-2"></i>Password Security Tips
                                </h4>
                                <ul class="text-xs text-blue-800 space-y-1">
                                    <li>• Use at least 8 characters</li>
                                    <li>• Include uppercase and lowercase letters</li>
                                    <li>• Add numbers and special characters</li>
                                    <li>• Avoid using personal information</li>
                                    <li>• Don't reuse old passwords</li>
                                </ul>
                            </div>

                            <!-- Form Actions -->
                            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                                <a href="{{ route('patient.settings') }}" class="px-6 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-200 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                                    Cancel
                                </a>
                                <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                    <i class="fas fa-key mr-2"></i>Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function togglePassword(inputName) {
            const input = document.getElementsByName(inputName)[0];
            const icon = document.getElementById(inputName + '_icon');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Password strength indicator
        document.getElementsByName('password')[0].addEventListener('input', function(e) {
            const password = e.target.value;
            const strengthIndicator = document.getElementById('password-strength');
            
            if (password.length < 8) {
                // Weak
            } else if (password.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/)) {
                // Strong
            } else {
                // Medium
            }
        });
    </script>

@endsection