<?php
$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM mahasiswa WHERE id=$id");

while ($data = mysqli_fetch_array($result)) {
  $nim          = $data['nim'];
  $nama         = $data['nama'];
  $jurusan      = $data['jurusan'];
  $jenisKelamin = $data['jenis_kelamin'];
  $alamat       = $data['alamat'];
  $telepon      = $data['telepon'];
  $email        = $data['email'];
}

if (isset($_POST['submit'])) {
  $nim          = $_POST['nim'];
  $nama         = $_POST['nama'];
  $jurusan      = $_POST['jurusan'];
  $jenisKelamin = $_POST['jenisKelamin'];
  $alamat       = $_POST['alamat'];
  $telepon      = $_POST['telepon'];
  $email        = $_POST['email'];

  $update = mysqli_query($con, "UPDATE mahasiswa SET nim='$nim',nama='$nama',jurusan='$jurusan',jenis_kelamin='$jenisKelamin',alamat='$alamat',telepon='$telepon',email='$email' WHERE id=$id");

  echo "<script>window.location.href = '?page=mahasiswa-show';</script>";
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
              <input name="nim" type="text" class="form-control" id="nim" value="<?php echo $nim; ?>" required
                placeholder="oke">
            </div>
          </div>

          <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>" required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
            <div class="col-sm-10">
              <select name="jurusan" id="jurusan" class="form-control" name="jurusan" required>
                <option value="-" disabled>- Pilih -</option>
                <option value="TI" <?php if ($jurusan == "TI") echo 'selected'; ?>>Teknik Informatika</option>
                <option value="SI" <?php if ($jurusan == "SI") echo 'selected'; ?>>Sistem Informasi</option>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="jenisKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-10">
              <select name="jenisKelamin" id="jenisKelamin" class="form-control" name="jenisKelamin" required>
                <option value="-" disabled>- Pilih -</option>
                <option value="L" <?php if ($jenisKelamin == 'L') echo 'selected'; ?>>Laki-laki</option>
                <option value="P" <?php if ($jenisKelamin == 'P') echo 'selected'; ?>>Perempuan</option>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat; ?>" required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="telepon" name="telepon" value="<?php echo $telepon; ?>"
                required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="offset-sm-2">

              <button type="submit" class="btn btn-sm btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=mahasiswa-show" class="btn btn-sm btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>