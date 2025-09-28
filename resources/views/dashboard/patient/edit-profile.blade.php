@extends('layouts.app')
@section('title', 'Edit Profile - Vezeeta')
@section('content')

    @include('components.alert')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Patient Sidebar -->
            @php
                $patient_name = $user->name;
                $patient_id = '#PT-' . date('Y') . '-' . str_pad($user->id, 3, '0', STR_PAD_LEFT);
                $patient_avatar = $user->avatar ?? 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face';
                $current_page = 'profile';
            @endphp
            @include('components.patient-sidebar', [
                'patient_name' => $patient_name,
                'patient_id' => $patient_id,
                'patient_avatar' => $patient_avatar,
                'current_page' => $current_page,
            ])

            <!-- Edit Profile Form -->
            <main class="lg:w-3/4 w-full">
                <div class="bg-white rounded-xl shadow-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Edit Profile</h2>
                    </div>

                    <div class="p-6">
                        <form method="POST" action="{{ route('patient.profile.update') }}" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <!-- Personal Information -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    
                                    <!-- Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Full Name <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                                            required>
                                        @error('name')
                                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Email <span class="text-red-500">*</span>
                                        </label>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                                            required>
                                        @error('email')
                                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                        <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('phone') border-red-500 @enderror">
                                        @error('phone')
                                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Birthday -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                        <input type="date" name="birthday" value="{{ old('birthday', $user->birthday) }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('birthday') border-red-500 @enderror">
                                        @error('birthday')
                                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Gender -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                                        <div class="flex space-x-6">
                                            <label class="flex items-center">
                                                <input type="radio" name="gender" value="male" 
                                                    {{ old('gender', $user->gender) == 'male' ? 'checked' : '' }}
                                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                                <span class="ml-2 text-sm text-gray-700">Male</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="radio" name="gender" value="female"
                                                    {{ old('gender', $user->gender) == 'female' ? 'checked' : '' }}
                                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                                <span class="ml-2 text-sm text-gray-700">Female</span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- National ID -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">National ID</label>
                                        <input type="text" name="national_id" value="{{ old('national_id', $user->national_id) }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('national_id') border-red-500 @enderror">
                                        @error('national_id')
                                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Address Information -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Address Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    
                                    <!-- City -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                        <select name="city" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('city') border-red-500 @enderror">
                                            <option value="">Choose city</option>
                                            <option value="cairo" {{ old('city', $user->city) == 'cairo' ? 'selected' : '' }}>Cairo</option>
                                            <option value="giza" {{ old('city', $user->city) == 'giza' ? 'selected' : '' }}>Giza</option>
                                            <option value="alexandria" {{ old('city', $user->city) == 'alexandria' ? 'selected' : '' }}>Alexandria</option>
                                            <option value="asyut" {{ old('city', $user->city) == 'asyut' ? 'selected' : '' }}>Asyut</option>
                                            <option value="sohag" {{ old('city', $user->city) == 'sohag' ? 'selected' : '' }}>Sohag</option>
                                        </select>
                                        @error('city')
                                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Area -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Area</label>
                                        <input type="text" name="area" value="{{ old('area', $user->area) }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('area') border-red-500 @enderror"
                                            placeholder="Enter area">
                                        @error('area')
                                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Address -->
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Address</label>
                                        <textarea name="address" rows="3"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('address') border-red-500 @enderror"
                                            placeholder="Enter your full address">{{ old('address', $user->address) }}</textarea>
                                        @error('address')
                                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Emergency Contact -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Emergency Contact</h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    
                                    <!-- Contact Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Contact Name</label>
                                        <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name', $user->emergency_contact_name) }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('emergency_contact_name') border-red-500 @enderror">
                                        @error('emergency_contact_name')
                                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Contact Phone -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Contact Phone</label>
                                        <input type="tel" name="emergency_contact_phone" value="{{ old('emergency_contact_phone', $user->emergency_contact_phone) }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('emergency_contact_phone') border-red-500 @enderror">
                                        @error('emergency_contact_phone')
                                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Relationship -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Relationship</label>
                                        <select name="emergency_relationship" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('emergency_relationship') border-red-500 @enderror">
                                            <option value="">Select relationship</option>
                                            <option value="spouse" {{ old('emergency_relationship', $user->emergency_relationship) == 'spouse' ? 'selected' : '' }}>Spouse</option>
                                            <option value="parent" {{ old('emergency_relationship', $user->emergency_relationship) == 'parent' ? 'selected' : '' }}>Parent</option>
                                            <option value="sibling" {{ old('emergency_relationship', $user->emergency_relationship) == 'sibling' ? 'selected' : '' }}>Sibling</option>
                                            <option value="child" {{ old('emergency_relationship', $user->emergency_relationship) == 'child' ? 'selected' : '' }}>Child</option>
                                            <option value="friend" {{ old('emergency_relationship', $user->emergency_relationship) == 'friend' ? 'selected' : '' }}>Friend</option>
                                            <option value="other" {{ old('emergency_relationship', $user->emergency_relationship) == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('emergency_relationship')
                                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                                <a href="{{ route('patient.profile') }}" class="px-6 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-200 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                                    Cancel
                                </a>
                                <button type="submit" class="px-8 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

@endsection