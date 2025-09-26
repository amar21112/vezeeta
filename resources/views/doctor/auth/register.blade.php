
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

                <form method="POST" action="{{ route('doctor.register.submit') }}">
                    @csrf

                    {{-- Name --}}
                    <div class="form-group mb-3">
                        <label for="name">First Name</label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required maxlength="255"
                               placeholder="First name">
                    </div>

                    {{-- Surname --}}
                    <div class="form-group mb-3">
                        <label for="surname">Surname</label>
                        <input type="text" name="surname" id="surname"
                               class="form-control @error('surname') is-invalid @enderror"
                               value="{{ old('surname') }}" required maxlength="255"
                               placeholder="Last name">
                    </div>

                    {{-- Email --}}
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required maxlength="255"
                               placeholder="name@example.com">
                    </div>

                    {{-- Phone --}}
                    <div class="form-group mb-3">
                        <label for="phone">Phone (11 digits)</label>
                        <input type="text" name="phone" id="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone') }}" required pattern="\d{11}"
                               placeholder="e.g. 01012345678">
                    </div>

                    {{-- Graduate From --}}
                    <div class="form-group mb-3">
                        <label for="graduate_from">Graduate From</label>
                        <input type="text" name="graduate_from" id="graduate_from"
                               class="form-control @error('graduate_from') is-invalid @enderror"
                               value="{{ old('graduate_from') }}" required maxlength="255"
                               placeholder="University / School name">
                    </div>

                    {{-- Graduate In --}}
                    <div class="form-group mb-3">
                        <label for="graduate_in">Graduate In (year)</label>
                        <input type="number" name="graduate_in" id="graduate_in" min="1900" max="{{ date('Y') }}"
                               class="form-control @error('graduate_in') is-invalid @enderror"
                               value="{{ old('graduate_in') }}" required>
                    </div>

                    {{-- About --}}
                    <div class="form-group mb-3">
                        <label for="about">About</label>
                        <textarea name="about" id="about" rows="3"
                                  class="form-control @error('about') is-invalid @enderror"
                                  required maxlength="255"
                                  placeholder="Short bio or description">{{ old('about') }}</textarea>
                    </div>

                    {{-- Governorate --}}
                    <select name="governorate" id="governorate"
                            class="form-control @error('governorate') is-invalid @enderror" required>
                        <option value="">-- select governorate --</option>
                        @foreach(config('governorates') as $key => $val)
                            <option value="{{ $key }}" {{ old('governorate') == $key ? 'selected' : '' }}>
                                {{ $val }}
                            </option>
                        @endforeach
                    </select>

                    {{-- City --}}
                    <div class="form-group mb-3">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city"
                               class="form-control @error('city') is-invalid @enderror"
                               value="{{ old('city') }}" required maxlength="255"
                               placeholder="Enter your city">
                        @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Street --}}
                    <div class="form-group mb-3">
                        <label for="street">Street</label>
                        <input type="text" name="street" id="street"
                               class="form-control @error('street') is-invalid @enderror"
                               value="{{ old('street') }}" required maxlength="255"
                               placeholder="Street name / number">
                        @error('street')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
