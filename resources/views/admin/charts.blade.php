<form method="post" action="{{ route('simpanData') }}">
    @csrf
    <input type="text" name="namaSupplier1">
    <button type="submit" class="btn btn-success">go</button>
    <input type="text" name="namaSupplier2">
</form>
