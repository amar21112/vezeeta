<form action="{{ route('speciality.store') }}" method="POST">
    @csrf

    <label for="special_name">Special Name:</label>
    <input type="text"
           name="special_name"
           id="special_name"
           style="text-transform: lowercase;"
           oninput="this.value = this.value.toLowerCase();"
           required>

    <button type="submit">Submit</button>
</form>
