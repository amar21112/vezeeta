<!-- resources/views/appointments/create.blade.php -->
    <div class="container">
        <h2>Create Appointments</h2>

        <form action="{{ route('doctor.appointments.store') }}" method="POST">
            @csrf

            {{-- Price field --}}
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number"
                       step="1"
                       min="0"
                       name="price"
                       id="price"
                       class="form-control"
                       placeholder="Enter price"
                       required>
            </div>

            <div id="appointments-wrapper">
                <div class="appointment-field mb-3">
                    <label>Date & Time</label>
                    <input type="datetime-local" name="appointments[]" class="form-control" required>
                </div>
            </div>

            <button type="button" id="add-field" class="btn btn-secondary mb-3">+ Add another</button>

            <button type="submit" class="btn btn-primary">Save Appointments</button>
        </form>

        {{-- Show validation errors --}}
        @error('price')
        <div class="text-danger mt-2">{{ $message }}</div>
        @enderror

        @error('appointments')
        <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
        @foreach($errors->get('appointments.*') as $fieldErrors)
            @foreach($fieldErrors as $error)
                <div class="text-danger mt-1">{{ $error }}</div>
            @endforeach
        @endforeach
    </div>

    <script>
        document.getElementById('add-field').addEventListener('click', function () {
            const wrapper = document.getElementById('appointments-wrapper');
            const div = document.createElement('div');
            div.classList.add('appointment-field','mb-3');
            div.innerHTML = `
        <label>Date & Time</label>
        <input type="datetime-local" name="appointments[]" class="form-control" required>
    `;
            wrapper.appendChild(div);
        });
    </script>
