<form action="{{route('doctor.specialities.store') }}" method="POST">
    @csrf

    <div class="form-group mb-3">
        <label for="specialities">Select Specialities</label>

        <select name="specialities[]" id="specialities"
                class="form-control @error('specialities') is-invalid @enderror"
                multiple size="6"> {{-- size controls how many options are visible --}}
            @foreach($specialities as $specialist)
            <option value="{{ $specialist->id }}"
                    {{ (collect(old('specialities'))->contains($specialist->id)) ? 'selected' : '' }}>
            {{ $specialist->special_name }}
            </option>
            @endforeach
        </select>

        @error('specialities')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
