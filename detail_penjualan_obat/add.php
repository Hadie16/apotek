<?php
if (isset($_POST['submit'])) {
  $nim = $_POST['nim'];
  $nama = $_POST['nama'];
  $jurusan = $_POST['jurusan'];
  $jenisKelamin = $_POST['jenisKelamin'];
  $alamat = $_POST['alamat'];
  $telepon = $_POST['telepon'];
  $email = $_POST['email'];
  $insert = mysqli_query($con, "INSERT INTO mahasiswa(nim,nama,jurusan,jenis_kelamin,alamat,telepon,email) VALUES('$nim','$nama','$jurusan','$jenisKelamin','$alamat','$telepon','$email')");

  if ($insert) {
    echo "<script>window.location.href = '?page=mahasiswa-show';</script>";
  }
}
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>
<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Mahasiswa</h6>

      </div>
      <div class="card-body">
        <form method="POST">
          <div class="row mb-3">
            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
            <div class="col-sm-10">
              <input name="nim" type="text" class="form-control" id="nim" required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
            <div class="col-sm-10">
              <select name="jurusan" id="jurusan" class="form-control" name="jurusan" required>
                <option value="-" selected disabled>- Pilih -</option>
                <option value="TI">Teknik Informatika</option>
                <option value="SI">Sistem Informasi</option>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="jenisKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-10">
              <select name="jenisKelamin" id="jenisKelamin" class="form-control" name="jenisKelamin" required>
                <option value="-" selected disabled>- Pilih -</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="alamat" name="alamat">
            </div>
          </div>

          <div class="row mb-3">
            <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="telepon" name="telepon">
            </div>
          </div>

          <div class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="email" name="email">
            </div>
          </div>
          <hr>

          <div class="row">

            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=mahasiswa-show" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>