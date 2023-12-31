<?php
$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM supplier WHERE id_supplier=$id");

while ($data = mysqli_fetch_array($result)) {
  // $nim          = $data['nim'];
  $nama_supplier         = $data['nama_supplier'];
  $no_telepon_supplier   = $data['no_telepon_supplier'];
  $email_supplier        = $data['email_supplier'];
  $alamat_supplier       = $data['alamat_supplier'];
}

if (isset($_POST['submit'])) {
  // $nim          = $_POST['nim'];
  $nama_supplier         = $_POST['nama_supplier'];
  $no_telepon_supplier   = $_POST['no_telepon_supplier'];
  $email_supplier        = $_POST['email_supplier'];
  $alamat_supplier       = $_POST['alamat_supplier'];

  $update = mysqli_query($con, "UPDATE supplier SET nama_supplier='$nama_supplier',no_telepon_supplier='$no_telepon_supplier',email_supplier='$email_supplier',alamat_supplier='$alamat_supplier' WHERE id_supplier=$id");

  echo "<script>window.location.href = '?page=supplier-show';</script>";
}
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>
<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">supplier</h6>
      </div>
      <div class="card-body">
        <form method="POST">
          <!-- <div class="row mb-3">
            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
            <div class="col-sm-10">
              <input name="nim" type="text" class="form-control" id="nim" value="<?php echo $nim; ?>" required
                placeholder="oke">
            </div>
          </div> -->

          <div class="row mb-3">
            <label for="nama_supplier" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="<?php echo $nama_supplier; ?>" required>
            </div>
          </div>


    

          <div class="row mb-3">
            <label for="no_telepon_supplier" class="col-sm-2 col-form-label">Telepon</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="no_telepon_supplier" name="no_telepon_supplier" value="<?php echo $no_telepon_supplier; ?>"
                required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="email_supplier" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="email_supplier" name="email_supplier" value="<?php echo $email_supplier; ?>" required>
            </div>
          </div>


          <div class="row mb-3">
            <label for="alamat_supplier" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="alamat_supplier" name="alamat_supplier" value="<?php echo $alamat_supplier; ?>" required>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="offset-sm-2">

              <button type="submit" class="btn btn-sm btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=supplier-show" class="btn btn-sm btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>