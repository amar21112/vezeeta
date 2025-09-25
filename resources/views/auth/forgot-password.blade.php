@extends('layouts.app')
@section('title', 'Forgot Password')
@section('content')
    <?php include_once 'assets/css/auth.php'; ?>
    <div class="container flex justify-center items-center min-h-screen bg-gray-100">

        <div class="login-container">
            <h2 class="text-2xl font-bold">Forgot Password</h2>
            <form>
                <input type="text" placeholder="Enter your mobile number or email" required>
                <button type="submit">Send Reset Link</button>
            </form>
            <p><a href="login">Back to Login</a></p>
        </div>
    </div>
@endsection
