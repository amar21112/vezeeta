@extends('layouts.app')
@section('title', 'Register')
@section('content')
    <?php include_once 'assets/css/auth.php'; ?>
    <div class="container flex justify-center items-center min-h-screen bg-gray-100">
        <div class="login-container">
            <h2 class="text-2xl font-bold">Create an Account</h2>
            <form>
                <input type="text" placeholder="Full Name" required />
                <input type="text" placeholder="Mobile Number or Email" required />
                <input type="password" placeholder="Password" required />
                <input type="password" placeholder="Confirm Password" required />
                <button type="submit">Register</button>
            </form>
            <p><a href="login">Already have an account? Log in</a></p>
        </div>

    </div>
@endsection
