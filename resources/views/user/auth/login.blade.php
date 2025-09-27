@extends('layouts.app')
@section('title', 'Login')
@section('content')
    <?php include_once 'assets/css/auth.php'; ?>
    <div class="container flex justify-center items-center min-h-screen bg-gray-100">

        <div class="login-container">
            <h2 class="text-2xl font-bold">Login</h2>
            {{-- Display validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('user.login.submit') }}">
                @csrf
                <input type="text" placeholder="Mobile number" class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone') }}" required>

                <input type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror"
                    required>

                <div class="remember-me">
                    <input id="remember" type="checkbox">
                    <label for="remember">
                        Remember me
                    </label>
                </div>

                <button type="submit">Login</button>
            </form>
            <p><a href="register">Create a new account</a> | <a href="forgot-password">Forgot your password?</a></p>
        </div>
    </div>
@endsection
