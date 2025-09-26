
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

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

                <form method="POST" action="{{ route('admin.register.submit') }}">
                    @csrf

                    {{-- Name --}}
                    <div class="form-group mb-3">
                        <label for="name">First Name</label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required maxlength="255"
                               placeholder="First name">
                    </div>

                    {{-- Phone --}}
                    <div class="form-group mb-3">
                        <label for="phone">Phone (11 digits)</label>
                        <input type="text" name="phone" id="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone') }}" required pattern="\d{11}"
                               placeholder="e.g. 01012345678">
                    </div>


                    {{-- Password --}}
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required minlength="6"
                               placeholder="Minimum 6 characters">
                    </div>

                    {{-- Confirm Password --}}
                    <div class="form-group mb-4">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               required minlength="6"
                               placeholder="Re-enter password">
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
