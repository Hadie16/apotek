<?php
//error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM stok_obat WHERE id_stok_obat=$id");

while ($data = mysqli_fetch_array($result)) {

  $id_obat = $data['id_obat'];

  $jumlah_stok_obat = $data['jumlah_stok_obat'];
  $harga_jual_obat = $data['harga_jual_obat'];

  $tanggal_kadaluarsa_obat = $data['tanggal_kadaluarsa_obat'];

  // $tanggal_masuk_obat = $data['tanggal_masuk_obat'];
}

if (isset($_POST['submit'])) {

  // $id_obat = $_POST['id_obat'];

  $jumlah_stok_obat = $_POST['jumlah_stok_obat'];
  $harga_jual_obat = $_POST['harga_jual_obat'];

  $tanggal_kadaluarsa_obat = $_POST['tanggal_kadaluarsa_obat'];

  // $tanggal_masuk_obat = $_POST['tanggal_masuk_obat'];

  $update = mysqli_query($con, "UPDATE stok_obat SET jumlah_stok_obat='$jumlah_stok_obat',harga_jual_obat='$harga_jual_obat',tanggal_kadaluarsa_obat='$tanggal_kadaluarsa_obat' WHERE id_stok_obat=$id");


  echo "<script>window.location.href = '?page=stok_obat-show';</script>";
}
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>
<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Stok Obat</h6>

      </div>
      <div class="card-body">
        <form method="POST">
          <div class="row mb-3">
          <label for="id_obat" class="col-sm-2 col-form-label">Nama Obat</label>
<div class="col-sm-10">

<!-- <input type="text" id="datepicker"> -->


  <select name="id_ketersediaan_obat" id="id_obat_select" class="form-control" required>
        <option value="">- Pilih -</option>
        <?php
          $query = mysqli_query($con, "SELECT t1.nama_obat,t2.id_ketersediaan_obat FROM obat t1
          JOIN ketersediaan_obat t2 ON t1.id_obat = t2.id_obat");
        // $query = mysqli_query($con, "SELECT id_obat, nama_obat FROM obat");
        while ($row = mysqli_fetch_assoc($query)) {
            // $id_obat = $row['id_obat'];
            $id_ketersediaan_obat2 = $row['id_ketersediaan_obat'];
            $nama_obat = $row['nama_obat'];

            if ($id_obat == $id_obat) {
              echo '<option value="' . $id_ketersediaan_obat2 . '" selected>' . $nama_obat . '</option>';
          } else {
            echo '<option value="' . $id_ketersediaan_obat2 . '" >' . $nama_obat . '</option>';
        }
      }

        ?>
    </select>

</div>

<input type="hidden" class="form-control" id="id_obats" name="id_obat" required>  

          </div>

          <div class="row mb-3">
            <label for="jumlah_stok_obat" class="col-sm-2 col-form-label">Tambah Stok Obat</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="jumlah_stok_obat" name="jumlah_stok_obat"   value="<?php echo $jumlah_stok_obat ?>" required>  
            </div>

            <!-- <label for="s" class="col-sm col-form-label" id="unit" name="unit"></label> -->
            </div>

          <div class="row mb-3">
            <label for="harga_jual_obat" class="col-sm-2 col-form-label">Harga Jual</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="harga_jual_obat" name="harga_jual_obat" value="<?php echo $harga_jual_obat ?>" required>
            </div>
            </div>


          <div class="row mb-3">
            <label for="tanggal_kadaluarsa_obat" class="col-sm-2 col-form-label">Tanggal Kadaluarsa</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="tanggal_kadaluarsa_obat" name="tanggal_kadaluarsa_obat" value="<?php echo $tanggal_kadaluarsa_obat ?>">
            </div>
          </div>

     
          <hr>

          <div class="row">

            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=stok_obat-show" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>