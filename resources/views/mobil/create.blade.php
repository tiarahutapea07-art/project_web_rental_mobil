<h1>Tambah Mobil</h1>
<form action="/mobil" method="POST">
    @csrf

    <label>Nama Mobil</label><br>
    <input type="text" name="nama_mobil"><br><br>

    <label>Harga Per Hari</label><br>
    <input type="number" name="harga_per_hari"><br><br>

    <button type="submit">Simpan</button>
</form>