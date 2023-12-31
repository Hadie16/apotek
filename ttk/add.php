<?php
if (isset($_POST['submit'])) {

  $nama_ttk = $_POST['nama_ttk'];
  $telepon_ttk = $_POST['telepon_ttk'];
  $email_ttk = $_POST['email_ttk'];
  $alamat_ttk = $_POST['alamat_ttk'];
  $status_ttk = $_POST['status_ttk'];
  $insert = mysqli_query($con, "INSERT INTO ttk(nama_ttk,telepon_ttk,email_ttk,alamat_ttk,status_ttk) VALUES('$nama_ttk','$telepon_ttk','$email_ttk','$alamat_ttk','$status_ttk')");

  if ($insert) {
    echo "<script>window.location.href = '?page=ttk-show';</script>";
  }
//   if ($insert) {
//     echo "<p>query berhasil<p/>";
// } else {
//     die('invalid Query : ' . mysqli_error($con));
// }
}
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>
<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">TTK</h6>

      </div>
      <div class="card-body">
        <form method="POST">
    

          <div class="row mb-3">
            <label for="nama_ttk" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama_ttk" name="nama_ttk" required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="telepon_ttk" class="col-sm-2 col-form-label">Telepon</label>
            <div class="col-sm-10">
             
            <input type="number" class="form-control" id="telepon_ttk" name="telepon_ttk" required>
             
            </div>
          </div>

          <div class="row mb-3">
            <label for="email_ttk" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="email_ttk" name="email_ttk" required>

            </div>
          </div>

          <div class="row mb-3">
            <label for="alamat_ttk" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="alamat_ttk" name="alamat_ttk">
            </div>
          </div>

          <div class="row mb-3">
            <label for="status_ttk" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
            <select name="status_ttk" id="status_ttk" class="form-control" name="status_ttk" required>
                <option value="-" selected disabled>- Pilih -</option>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
              </select>
            </div>
          </div>

     
          <hr>

          <div class="row">

            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=ttk-show" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>