<?php
if (isset($_POST['submit'])) {
  // $id_supplier = $_POST['id_supplier'];
  $nama_supplier = $_POST['nama_supplier'];
  $no_telepon_supplier = $_POST['no_telepon_supplier'];
  $email_supplier = $_POST['email_supplier'];
  $alamat_supplier = $_POST['alamat_supplier'];

  $insert = mysqli_query($con, "INSERT INTO supplier(nama_supplier,no_telepon_supplier,email_supplier,alamat_supplier) 
  VALUES('$nama_supplier','$no_telepon_supplier','$email_supplier','$alamat_supplier')");

  if ($insert) {
    echo "<script>window.location.href = '?page=supplier-show';</script>";
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
        <h6 class="m-0 font-weight-bold text-primary">Supplier</h6>

      </div>
      <div class="card-body">
        <form method="POST">
          <!-- <div class="row mb-3">
            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
            <div class="col-sm-10">
              <input name="nim" type="text" class="form-control" id="nim" required>
            </div>
          </div> -->

          <div class="row mb-3">
            <label for="nama_supplier" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" required>
            </div>
          </div>



          <div class="row mb-3">
            <label for="no_telepon_supplier" class="col-sm-2 col-form-label">Telepon</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="no_telepon_supplier" name="no_telepon_supplier">
            </div>
          </div>

          <div class="row mb-3">
            <label for="email_supplier" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="email_supplier" name="email_supplier">
            </div>
          </div>
          <hr>

          <div class="row mb-3">
            <label for="alamat_supplier" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="alamat_supplier" name="alamat_supplier">
            </div>
          </div>


          <div class="row">

            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=supplier-show" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>