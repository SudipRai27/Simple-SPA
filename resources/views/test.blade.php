<form action="{{ route('test.post') }}" enctype="multipart/form-data" method="POST">
    <input type="file" multiple name="images[]">
    <input type="submit" value="Submit">
    @csrf
</form>
