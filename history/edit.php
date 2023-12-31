<?php
$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM pasien WHERE id_pasien=$id");


while ($data = mysqli_fetch_array($result)) {
    $kode_pasien = $data['kode_pasien'];
  $nama_pasien = $data['nama_pasien'];
  $jenis_kelamin = $data['jenis_kelamin'];


//   $email_pasien = $data['email_pasien'];
  $alamat_pasien = $data['alamat_pasien'];
  $tanggal_lahir = $data['tanggal_lahir'];
  $no_telepon = $data['no_telepon'];
}

if (isset($_POST['submit'])) {
    $kode_pasien = $_POST['kode_pasien'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

  $nama_pasien = $_POST['nama_pasien'];

//   $email_pasien = $_POST['email_pasien'];
  $alamat_pasien = $_POST['alamat_pasien'];
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $no_telepon = $_POST['no_telepon'];

  $update = mysqli_query($con, "UPDATE pasien SET kode_pasien='$kode_pasien',nama_pasien='$nama_pasien',jenis_kelamin='$jenis_kelamin',alamat_pasien='$alamat_pasien',tanggal_lahir='$tanggal_lahir', no_telepon='$no_telepon' WHERE id_pasien=$id");

  echo "<script>window.location.href = '?page=history-show';</script>";
}
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>
<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Pasien</h6>
      </div>
      <div class="card-body">
        <form method="POST">

        <div class="row mb-3">
            <label for="kode_pasien" class="col-sm-2 col-form-label">Kode Pasien</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="kode_pasien" name="kode_pasien" value="<?php echo $kode_pasien; ?>" readonly>
            </div>
          </div>

          <div class="row mb-3">
            <label for="nama_pasien" class="col-sm-2 col-form-label">Nama Pasien</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="<?php echo $nama_pasien; ?>" required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-10">
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" name="jenis_kelamin" required>
                <option value="-" disabled>- Pilih -</option>
                <option value="Laki-laki" <?php if ($jenis_kelamin == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                <option value="Perempuan" <?php if ($jenis_kelamin == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
              </select>
            </div>
          </div>

      

  

          <div class="row mb-3">
            <label for="alamat_pasien" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="alamat_pasien" name="alamat_pasien" value="<?php echo $alamat_pasien; ?>" required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-10">
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $tanggal_lahir; ?>" required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="no_telepon" class="col-sm-2 col-form-label">Telepon</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="<?php echo $no_telepon; ?>" required>
            </div>
          </div>
       

      
          <hr>
          <div class="row">
            <div class="offset-sm-2">

              <button type="submit" class="btn btn-sm btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=history-show" class="btn btn-sm btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>