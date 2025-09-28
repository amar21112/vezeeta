@extends('layouts.app')
@section('title', 'Doctor Registration - Vezeeta')
@section('content')

    @include('components.alert')

    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-8">
                <div class="mx-auto h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-md text-blue-600 text-2xl"></i>
                </div>
                <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">
                    Join as a Doctor
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('doctor.login') }}" class="font-medium text-blue-600 hover:text-blue-500 ml-1">
                        Sign in here
                    </a>
                </p>
            </div>

            <div class="bg-white shadow-xl rounded-xl border border-gray-100 overflow-hidden">
                <div class="px-8 py-6 bg-gradient-to-r from-blue-600 to-blue-700">
                    <h3 class="text-lg font-semibold text-white">Doctor Registration Form</h3>
                    <p class="text-blue-100 text-sm mt-1">Please fill in all required information to create your doctor account</p>
                </div>

                <div class="px-8 py-6">
                    {{-- Show validation errors --}}
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-triangle text-red-400"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('doctor.register.submit') }}" class="space-y-6">
                        @csrf

                        <!-- Personal Information -->
                        <div class="border-b border-gray-200 pb-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- First Name --}}
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        First Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="name" id="name"
                                           class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('name') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                           value="{{ old('name') }}" required maxlength="255"
                                           placeholder="Enter first name">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Last Name --}}
                                <div>
                                    <label for="surname" class="block text-sm font-medium text-gray-700 mb-2">
                                        Last Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="surname" id="surname"
                                           class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('surname') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                           value="{{ old('surname') }}" required maxlength="255"
                                           placeholder="Enter last name">
                                    @error('surname')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="border-b border-gray-200 pb-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Email --}}
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Email Address <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-envelope text-gray-400"></i>
                                        </div>
                                        <input type="email" name="email" id="email"
                                               class="appearance-none block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('email') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                               value="{{ old('email') }}" required maxlength="255"
                                               placeholder="doctor@example.com">
                                    </div>
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Phone --}}
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                        Phone Number <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-phone text-gray-400"></i>
                                        </div>
                                        <input type="text" name="phone" id="phone"
                                               class="appearance-none block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('phone') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                               value="{{ old('phone') }}" required pattern="\d{11}"
                                               placeholder="01012345678">
                                    </div>
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Education & Experience -->
                        <div class="border-b border-gray-200 pb-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Education & Experience</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Graduate From --}}
                                <div>
                                    <label for="graduate_from" class="block text-sm font-medium text-gray-700 mb-2">
                                        Graduate From <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="graduate_from" id="graduate_from"
                                           class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('graduate_from') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                           value="{{ old('graduate_from') }}" required maxlength="255"
                                           placeholder="Cairo University Faculty of Medicine">
                                    @error('graduate_from')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Graduate Year --}}
                                <div>
                                    <label for="graduate_in" class="block text-sm font-medium text-gray-700 mb-2">
                                        Graduation Year <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="graduate_in" id="graduate_in" 
                                           min="1900" max="{{ date('Y') }}"
                                           class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('graduate_in') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                           value="{{ old('graduate_in') }}" required
                                           placeholder="{{ date('Y') }}">
                                    @error('graduate_in')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- About --}}
                            <div class="mt-6">
                                <label for="about" class="block text-sm font-medium text-gray-700 mb-2">
                                    About Yourself <span class="text-red-500">*</span>
                                </label>
                                <textarea name="about" id="about" rows="3"
                                          class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('about') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                          required maxlength="255"
                                          placeholder="Brief description of your experience and specializations">{{ old('about') }}</textarea>
                                @error('about')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Location Information -->
                        <div class="border-b border-gray-200 pb-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Location Information</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                {{-- Governorate --}}
                                <div>
                                    <label for="governorate" class="block text-sm font-medium text-gray-700 mb-2">
                                        Governorate <span class="text-red-500">*</span>
                                    </label>
                                    <select name="governorate" id="governorate"
                                            class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('governorate') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror" required>
                                        <option value="">Select Governorate</option>
                                        @foreach(config('governorates') as $key => $val)
                                            <option class="text-capitalize" value="{{ $key }}" {{ old('governorate') == $key ? 'selected' : '' }}>
                                                {{ $val }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('governorate')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- City --}}
                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                                        City <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="city" id="city"
                                           class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('city') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                           value="{{ old('city') }}" required maxlength="255"
                                           placeholder="Enter your city">
                                    @error('city')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Street --}}
                                <div>
                                    <label for="street" class="block text-sm font-medium text-gray-700 mb-2">
                                        Street Address <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="street" id="street"
                                           class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('street') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                           value="{{ old('street') }}" required maxlength="255"
                                           placeholder="Street name and number">
                                    @error('street')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Security -->
                        <div class="pb-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Security</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Password --}}
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                        Password <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-lock text-gray-400"></i>
                                        </div>
                                        <input type="password" name="password" id="password"
                                               class="appearance-none block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('password') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                               required minlength="6"
                                               placeholder="Minimum 6 characters">
                                    </div>
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Confirm Password --}}
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                        Confirm Password <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-lock text-gray-400"></i>
                                        </div>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                               class="appearance-none block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('password_confirmation') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                               required minlength="6"
                                               placeholder="Re-enter password">
                                    </div>
                                    @error('password_confirmation')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Terms and Conditions --}}
                        <div class="flex items-center">
                            <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="terms" class="ml-2 block text-sm text-gray-700">
                                I agree to the 
                                <a href="#" class="text-blue-600 hover:text-blue-500">Terms of Service</a> 
                                and 
                                <a href="#" class="text-blue-600 hover:text-blue-500">Privacy Policy</a>
                            </label>
                        </div>

                        {{-- Submit --}}
                        <div class="pt-6">
                            <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                <i class="fas fa-user-plus mr-2"></i>
                                Create Doctor Account
                            </button>
                        </div>

                        {{-- Login Link --}}
                        <div class="text-center pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-600">
                                Already have an account?
                                <a href="{{ route('doctor.login') }}" class="font-medium text-blue-600 hover:text-blue-500 transition-colors">
                                    Sign in here
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
