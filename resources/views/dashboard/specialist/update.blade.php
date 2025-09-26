<form action="{{ route('speciality.update',$special->id) }}" method="POST">
    @csrf

    <label for="special_name">{{$special->name}}</label>
    <input type="text"
           name="special_name"
           id="special_name"
           style="text-transform: lowercase;"
           oninput="this.value = this.value.toLowerCase();"
           required>

    <button type="submit">Submit</button>
</form>
