@extends('layouts.app')
@section('title', 'Doctor Login - Vezeeta')
@section('content')

    @include('components.alert')

    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="text-center">
                <div class="mx-auto h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-md text-blue-600 text-2xl"></i>
                </div>
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
                    Doctor Sign In
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Access your doctor dashboard
                    <a href="{{ route('doctor.register') }}" class="font-medium text-blue-600 hover:text-blue-500 ml-1">
                        or create new account
                    </a>
                </p>
            </div>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow-xl rounded-xl border border-gray-100 sm:px-10">
                
                {{-- Display validation errors --}}
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

                <form method="POST" action="{{ route('doctor.login.submit') }}" class="space-y-6">
                    @csrf

                    {{-- Phone --}}
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                            <input type="tel"
                                   name="phone"
                                   id="phone"
                                   class="appearance-none block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('phone') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                   value="{{ old('phone') }}"
                                   required
                                   autofocus
                                   pattern="[0-9]{11}"
                                   maxlength="11"
                                   placeholder="01012345678">
                        </div>
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   class="appearance-none block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('password') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                   required
                                   placeholder="Enter your password">
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                                Remember me
                            </label>
                        </div>
                        <div class="text-sm">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                                Forgot password?
                            </a>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div>
                        <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Sign In to Dashboard
                        </button>
                    </div>

                    {{-- Register Link --}}
                    <div class="text-center pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-600">
                            Don't have a doctor account?
                            <a href="{{ route('doctor.register') }}" class="font-medium text-blue-600 hover:text-blue-500 transition-colors">
                                Register here
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
