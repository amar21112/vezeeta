 <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <h3 class="mb-4 text-center">Register</h3>

                {{-- Show validation errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('user.register.submit') }}">
                    @csrf

                    {{-- Name --}}
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}"
                               required
                               maxlength="255"
                               placeholder="Your full name">
                    </div>

                    {{-- Email --}}
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}"
                               required
                               maxlength="255"
                               placeholder="name@example.com">
                    </div>

                    {{-- Phone --}}
                    <div class="form-group mb-3">
                        <label for="phone">Phone</label>
                        <input type="text"
                               id="phone"
                               name="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone') }}"
                               required
                               pattern="\d{11}"
                               placeholder="11-digit phone number">
                    </div>

                    {{-- Birthday --}}
                    <div class="form-group mb-3">
                        <label for="birthday">Birthday</label>
                        <input type="date"
                               id="birthday"
                               name="birthday"
                               class="form-control @error('birthday') is-invalid @enderror"
                               value="{{ old('birthday') }}"
                               required>
                    </div>

                    {{-- Password --}}
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password"
                               id="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required
                               minlength="6"
                               placeholder="Minimum 6 characters">
                    </div>

                    {{-- Confirm Password --}}
                    <div class="form-group mb-4">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password"
                               id="password_confirmation"
                               name="password_confirmation"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               required
                               minlength="6"
                               placeholder="Re-enter your password">
                    </div>

                    {{-- Submit --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Register
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


