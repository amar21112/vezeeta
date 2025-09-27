<form action="{{route('patient.book.appointment') }}" method="POST">
    @csrf

    <input type="number" name="id" required placeholder="enter id">

    <button type="submit" class="btn btn-primary">Save</button>
</form>
