
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">

                <h3 class="mb-4 text-center">Login</h3>

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

                <form method="POST" action="{{ route('admin.login.submit') }}">
                    @csrf

                    {{-- Phone --}}
                    <div class="form-group mb-3">
                        <label for="phone">Phone</label>
                        <input type="text"
                               name="phone"
                               id="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone') }}"
                               required
                               autofocus
                               placeholder="Enter your phone number">
                    </div>

                    {{-- Password --}}
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required
                               placeholder="Enter your password">
                    </div>

                    {{-- Submit --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
