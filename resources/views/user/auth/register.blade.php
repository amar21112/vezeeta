@extends('layouts.app')
@section('title', 'Register')
@section('content')
    <?php include_once 'assets/css/auth.php'; ?>
    <div class="container flex justify-center items-center min-h-screen bg-gray-100">
        <div class="login-container">
            <h2 class="text-2xl font-bold">Create an Account</h2>
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('user.register.submit') }}">
                @csrf
                <input type="text" placeholder="Full Name" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required maxlength="255" />

                <input type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required maxlength="255" />

                <input type="tel" placeholder="Phone" class="form-control @error('phone') is-invalid @enderror"
                    name="phone" value="{{ old('phone') }}" required maxlength="11" pattern="[0-9]{11}" />

                <input type="date" placeholder="Date of Birth"
                    class="form-control @error('birthday') is-invalid @enderror" name="birthday"
                    value="{{ old('birthday') }}" required />

                <div class="password-input-wrapper" style="position: relative;">
                    <input type="password" placeholder="Password"
                        class="form-control @error('password') is-invalid @enderror" name="password" id="password"
                        required />
                    <i class="fas fa-eye text-blue-400 password-toggle" onclick="togglePassword('password')"
                        style="position: absolute; right: 25px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                </div>

                <div class="password-input-wrapper" style="position: relative;">
                    <input type="password" placeholder="Confirm Password"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation" id="password_confirmation" required />
                    <i class="fas fa-eye text-blue-400 password-toggle" onclick="togglePassword('password_confirmation')"
                        style="position: absolute; right: 25px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                </div>

                <script>
                    function togglePassword(fieldId) {
                        const field = document.getElementById(fieldId);
                        const icon = field.nextElementSibling;

                        if (field.type === 'password') {
                            field.type = 'text';
                            icon.classList.remove('fa-eye', 'text-blue-400');
                            icon.classList.add('fa-eye-slash', 'text-gray-400');
                        } else {
                            field.type = 'password';
                            icon.classList.remove('fa-eye-slash', 'text-gray-400');
                            icon.classList.add('fa-eye', 'text-blue-400');
                        }
                    }
                </script>

                <button type="submit">Register</button>
            </form>
            <p><a href="login">Already have an account? Log in</a></p>
        </div>

    </div>
@endsection
