@extends('layouts.app')
@section('title', 'Patient Profile - Vezeeta')
@section('content')

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
    <pre>
    <code>
        {{ var_dump($user) }}
        {{ var_dump(auth()->user()) }}
    </code>
</pre>
    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Include Patient Sidebar Component -->
            @php
                // Set sidebar data
                $patient_name = 'Ahmed Mohamed';
                $patient_id = '#PT-2024-001';
                $patient_avatar =
                    'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face';
                $appointments_count = 12;
                $completed_appointments = 8;
                $current_page = 'profile';

                // Include the sidebar component

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
                        <form id="profileForm" class="space-y-6">
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
                                            <input type="text" name="full_name" value="Ahmed Mohamed Ali"
                                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                placeholder="Enter your full name">
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
                                            <input type="email" name="email" value="ahmed.mohamed@email.com"
                                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                placeholder="Enter your email address">
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
                                                <input type="tel" name="mobile" value="1234567890"
                                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                    placeholder="Enter mobile number">
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
                                            <input type="date" name="birth_date" value="1990-05-15"
                                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                                <i class="fas fa-calendar text-gray-400"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Gender Field -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Gender</label>
                                        <div class="flex space-x-6">
                                            <label class="flex items-center">
                                                <input type="radio" name="gender" value="male" checked
                                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                                <span class="ml-2 text-sm text-gray-700">Male</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="radio" name="gender" value="female"
                                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                                <span class="ml-2 text-sm text-gray-700">Female</span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- National ID -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">
                                            National ID
                                        </label>
                                        <div class="relative">
                                            <input type="text" name="national_id" value="29012345678901"
                                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                placeholder="Enter your national ID">
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                                <i class="fas fa-id-card text-gray-400"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Address Information Section -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Address Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                    <!-- City Field -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">City</label>
                                        <div class="relative">
                                            <select name="city"
                                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                                <option value="">Choose city</option>
                                                <option value="cairo" selected>Cairo</option>
                                                <option value="giza">Giza</option>
                                                <option value="alexandria">Alexandria</option>
                                                <option value="asyut">Asyut</option>
                                                <option value="sohag">Sohag</option>
                                            </select>
                                            <div
                                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                <i class="fas fa-city text-gray-400"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Area Field -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Area</label>
                                        <div class="relative">
                                            <select name="area"
                                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                                <option value="">Choose area</option>
                                                <option value="nasr-city" selected>Nasr City</option>
                                                <option value="heliopolis">Heliopolis</option>
                                                <option value="maadi">Maadi</option>
                                                <option value="zamalek">Zamalek</option>
                                            </select>
                                            <div
                                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Full Address -->
                                    <div class="md:col-span-2 space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Full Address</label>
                                        <div class="relative">
                                            <textarea name="full_address" rows="3"
                                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                                                placeholder="Enter your full address">123 Mohamed Street, Nasr City, Cairo, Egypt</textarea>
                                            <div class="absolute top-3 right-3">
                                                <i class="fas fa-home text-gray-400"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Emergency Contact Section -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Emergency Contact</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Contact Name</label>
                                        <input type="text" name="emergency_name" value="Fatma Mohamed Ali"
                                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                            placeholder="Emergency contact name">
                                    </div>

                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Contact Phone</label>
                                        <input type="tel" name="emergency_phone" value="+20 109876543"
                                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                            placeholder="Emergency contact phone">
                                    </div>

                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Relationship</label>
                                        <select name="emergency_relationship"
                                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                            <option value="">Select relationship</option>
                                            <option value="spouse" selected>Spouse</option>
                                            <option value="parent">Parent</option>
                                            <option value="sibling">Sibling</option>
                                            <option value="child">Child</option>
                                            <option value="friend">Friend</option>
                                            <option value="other">Other</option>
                                        </select>
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
        class="fixed top-4 right-6 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50">
        <div class="flex items-center space-x-2">
            <i class="fas fa-check-circle"></i>
            <span>Profile updated successfully!</span>
        </div>
    </div>

    <script>
        // Form handling
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Show loading state
            const submitBtn = e.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';
            submitBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;

                // Show success toast
                showSuccessToast();
            }, 2000);
        });

        // Reset form function
        function resetForm() {
            if (confirm('Are you sure you want to reset all changes?')) {
                document.getElementById('profileForm').reset();
            }
        }

        // Show success toast
        function showSuccessToast() {
            const toast = document.getElementById('successToast');
            toast.classList.remove('translate-x-full');
            toast.classList.add('translate-x-0');

            setTimeout(() => {
                toast.classList.remove('translate-x-0');
                toast.classList.add('translate-x-full');
            }, 3000);
        }

        // Dynamic area loading based on city
        document.querySelector('select[name="city"]').addEventListener('change', function() {
            const areaSelect = document.querySelector('select[name="area"]');
            const areas = {
                'cairo': ['Nasr City', 'Heliopolis', 'Maadi', 'Zamalek', 'Downtown', 'New Cairo'],
                'giza': ['Dokki', 'Mohandessin', 'Agouza', 'Haram', '6th October', 'Sheikh Zayed'],
                'alexandria': ['Sidi Gaber', 'Stanley', 'Smouha', 'Montaza', 'Miami', 'Cleopatra']
            };

            areaSelect.innerHTML = '<option value="">Choose area</option>';

            if (areas[this.value]) {
                areas[this.value].forEach(area => {
                    const option = document.createElement('option');
                    option.value = area.toLowerCase().replace(/\s+/g, '-');
                    option.textContent = area;
                    areaSelect.appendChild(option);
                });
            }
        });
    </script>

    </body>
