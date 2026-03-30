<h1>Edit Mobil</h1>
<form action="/mobil/{{ $mobil->id }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Mobil</label><br>
    <input type="text" name="nama_mobil" value="{{ $mobil->nama_mobil }}"><br><br>

    <label>Harga Per Hari</label><br>
    <input type="number" name="harga_per_hari" value="{{ $mobil->harga_per_hari }}"><br><br>

    <button type="submit">Update</button>
</form>