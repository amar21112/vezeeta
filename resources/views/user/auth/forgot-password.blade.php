@extends('layouts.app')
@section('title', 'Forgot Password')
@section('content')
    <?php include_once 'assets/css/auth.php'; ?>
    <div class="container flex justify-center items-center min-h-screen bg-gray-100">

        <div class="login-container">
            <h2 class="text-2xl font-bold">Forgot Password</h2>
            
            @include('components.alert')
            
            <form method="POST" action="#" class="space-y-4">
                @csrf
                <input type="email" name="email" placeholder="Enter your email address" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                <button type="submit">Send Reset Link</button>
            </form>
            <p><a href="{{ route('user.login') }}">Back to Login</a></p>
        </div>
    </div>
@endsection
