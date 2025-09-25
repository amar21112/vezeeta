@extends('layouts.app')
@section('title', 'Login')
@section('content')
    <?php include_once 'assets/css/auth.php'; ?>
    <div class="container flex justify-center items-center min-h-screen bg-gray-100">

        <div class="login-container">
            <h2 class="text-2xl font-bold">Login</h2>
            <form>
                <input type="text" placeholder="Mobile number or email" required>
                <input type="password" placeholder="Password" required>

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
