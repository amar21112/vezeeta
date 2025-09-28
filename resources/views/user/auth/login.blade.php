@extends('layouts.app')
@section('title', 'Login')
@section('content')
    <?php include_once 'assets/css/auth.php'; ?>
    <div class="container flex justify-center items-center min-h-screen bg-gray-100">

        <div class="login-container">
            <h2 class="text-2xl font-bold">Login</h2>

            @include('components.alert')
            <form method="POST" action="{{ route('user.login.submit') }}" class="space-y-4">
                @csrf
                {{-- <div>
                    <input type="email" 
                           name="email" 
                           placeholder="Email address" 
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="email"
                           autofocus>
                    @error('email')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div> --}}
                <div>
                    <input type="tel" name="phone" placeholder="Phone number"
                        class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required
                        autocomplete="phone" autofocus>
                    @error('phone')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <input type="password" name="password" placeholder="Password"
                        class="form-control @error('password') is-invalid @enderror" required
                        autocomplete="current-password">
                    @error('password')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="remember-me">
                    <input id="remember" name="remember" type="checkbox" class="mr-2">
                    <label for="remember" class="text-sm text-gray-600">
                        Remember me
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                    Login
                </button>
            </form>
            <p><a href="{{ route('user.register') }}">Create a new account</a> | <a
                    href="{{ route('user.forgot-password') }}">Forgot your password?</a></p>
        </div>
    </div>
@endsection
