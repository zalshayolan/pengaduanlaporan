<h2>Form Pengaduan</h2>
<a href="/siswa/pengaduan">Kembali</a>
<hr>

<form method="POST" action="/siswa/pengaduan/store" enctype="multipart/form-data">
    @csrf

    <label>Judul</label><br>
    <input type="text" name="judul"><br><br>

    <label>Kategori</label><br>
    <input type="text" name="kategori"><br><br>

    <label>Lokasi</label><br>
    <input type="text" name="lokasi"><br><br>

    <label>Deskripsi</label><br>
    <textarea name="deskripsi"></textarea><br><br>

    <label>Foto</label><br>
    <input type="file" name="foto"><br><br>

    <button type="submit">Kirim</button>
</form>
