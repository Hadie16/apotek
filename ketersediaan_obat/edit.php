<?php
include '../connection.php';
// include '../template/header.php';

$id = $_GET['id'];
// include '../connection.php';
$result = mysqli_query($con, "SELECT * FROM ketersediaan_obat WHERE id_ketersediaan_obat=$id");

while ($data = mysqli_fetch_array($result)) {
  $id_obat = $data['id_obat'];
  $jumlah = $data['jumlah_ketersediaan_obat'];
  $satuan = $data['satuan'];
  $harga_beli_obat = $data['harga_beli_obat'];


  $tanggal = $data['tanggal_kadaluarsa_obat'];

//   $k = $data['id_obat'];

}
if (isset($_POST['submit'])) {
  $u = $_POST['id_obat'];
  $p = $_POST['jumlah_ketersediaan_obat'];
  $s = $_POST['satuan'];
  $hbo = $_POST['harga_beli_obat'];


  $l = $_POST['tanggal_kadaluarsa'];


//   $result = mysqli_query($con, "SELECT * FROM ketersediaan_obat WHERE id_ketersediaan_obat='$id'");
//   $cek = mysqli_num_rows($result);
//   if ($cek > 0) {
//     echo "<script>
//             alert('Gunakan id_obat dengan nama yang lain!');
//             window.location.href = '?page=ketersediaan_obat-add';
//           </script>";
//     exit;
//   }
$update = mysqli_query($con, "UPDATE ketersediaan_obat SET id_obat='$u',jumlah_ketersediaan_obat='$p',satuan='$s',harga_beli_obat='$hbo',tanggal_kadaluarsa_obat='$l' WHERE id_ketersediaan_obat=$id");


// if ($update) {
//     echo "<p>query berhasil<p/>";
// } else {
//     die('invalid Query : ' . mysqli_error($con));
// }
if ($update) {
  echo "<script>window.location.href = '?page=ketersediaan_obat-detail&id=" . $id_obat . "';</script>";
}

}
?>




<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Ketersediaan Obat</h6>
      </div>
      <div class="card-body">
        <form method="POST">
         
          <div class="row mb-3">
            <label for="id_obat" class="col-sm-2 col-form-label">Nama Obat</label>
            <div class="col-sm-10">
            <select name="id_obatShow" class="form-control" disabled>
        <option value="">- Pilih -</option>
        <?php
       $query = mysqli_query($con, "SELECT id_obat, nama_obat FROM obat");
       while ($row = mysqli_fetch_assoc($query)) {
           $id_obats = $row['id_obat'];
           $nama_obat = $row['nama_obat'];

            if ($id_obat == $id_obats) {
              echo '<option value="' . $id_obat . '" selected>' . $nama_obat . '</option>';
          } else {
            echo '<option value="' . $id_obat . '">' . $nama_obat . '</option>';
        }
      }

        ?>
    </select>
            </div>
          </div>

          <div class="row mb-3">
          <input type="hidden" class="form-control" id="" name="id_obat" value="<?php echo $id_obat?>" required>
            <label for="jumlah_ketersediaan_obat" class="col-sm-2 col-form-label">Jumlah</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="jumlah_ketersediaan_obat" name="jumlah_ketersediaan_obat" value="<?php echo $jumlah?>" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
            <div class="col-sm-10">
            <select id="satuan" class="form-control" name="satuan">
  <option value="">- Pilih -</option>
  <option value="Strip" <?php if ($satuan === 'Strip') echo 'selected'; ?>>Strip</option>
  <option value="Sachet" <?php if ($satuan === 'Sachet') echo 'selected'; ?>>Sachet</option>
  <option value="Botol" <?php if ($satuan === 'Botol') echo 'selected'; ?>>Botol</option>
  <option value="Pcs" <?php if ($satuan === 'Pcs') echo 'selected'; ?>>Pcs</option>
  <option value="Tube" <?php if ($satuan === 'Tube') echo 'selected'; ?>>Tube</option>
  <option value="Box" <?php if ($satuan === 'Box') echo 'selected'; ?>>Box</option>

</select>

            </div>
          </div>
          <div class="row mb-3">
            <label for="harga_beli_obat" class="col-sm-2 col-form-label">Harga Beli</label>
            <div class="col-sm-10">
            <input name="harga_beli_obat" type="number" class="form-control" id="harga_beli_obat" value="<?php echo $harga_beli_obat ?>"  required>

            </div>
          </div>
          <div class="row mb-3">
            <label for="tanggal_kadaluarsa" class="col-sm-2 col-form-label">Tanggal</label>
            <div class="col-sm-10">
            <input name="tanggal_kadaluarsa" type="date" class="form-control" id="tanggal_kadaluarsa" value="<?php echo $tanggal ?>"  required>

            </div>
          </div>
        
          <hr>
          <div class="row">
            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=ketersediaan_obat-detail&id=<?php echo $id_obat ?>" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>