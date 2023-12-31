<?php
include '../connection.php';
// include '../template/header.php';

$id = $_GET['id'];
// include '../connection.php';
$result = mysqli_query($con, "SELECT * FROM ketersediaan_alkes WHERE id_ketersediaan_alkes=$id");

while ($data = mysqli_fetch_array($result)) {
  $id_alkes = $data['id_alkes'];
  $jumlah = $data['jumlah_ketersediaan_alkes'];
  $satuan = $data['satuan'];
  $harga_beli_alkes = $data['harga_beli_alkes'];

  $tanggal = $data['tanggal_kadaluarsa_alkes'];

//   $k = $data['id_alkes'];

}
if (isset($_POST['submit'])) {
  $u = $_POST['id_alkes'];
  $p = $_POST['jumlah_ketersediaan_alkes'];
  $s = $_POST['satuan'];
  $hba = $_POST['harga_beli_alkes'];

  $l = $_POST['tanggal_kadaluarsa'];


//   $result = mysqli_query($con, "SELECT * FROM ketersediaan_alkes WHERE id_ketersediaan_alkes='$id'");
//   $cek = mysqli_num_rows($result);
//   if ($cek > 0) {
//     echo "<script>
//             alert('Gunakan id_alkes dengan nama yang lain!');
//             window.location.href = '?page=ketersediaan_alkes-add';
//           </script>";
//     exit;
//   }
$update = mysqli_query($con, "UPDATE ketersediaan_alkes SET id_alkes='$u',jumlah_ketersediaan_alkes='$p',satuan='$s',harga_beli_alkes='$hba',tanggal_kadaluarsa_alkes='$l' WHERE id_ketersediaan_alkes=$id");


// if ($update) {
//     echo "<p>query berhasil<p/>";
// } else {
//     die('invalid Query : ' . mysqli_error($con));
// }
if ($update) {
  echo "<script>window.location.href = '?page=ketersediaan_alkes-detail&id=" . $id_alkes . "';</script>";
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
        <h6 class="m-0 font-weight-bold text-info">Ketersediaan alkes</h6>
      </div>
      <div class="card-body">
        <form method="POST">
         
          <div class="row mb-3">
            <label for="id_alkes" class="col-sm-2 col-form-label">Nama alkes</label>
            <div class="col-sm-10">
            <select name="id_alkes" class="form-control" readonly>
        <option value="">- Pilih -</option>
        <?php
       $query = mysqli_query($con, "SELECT id_alkes, nama_alkes FROM alkes");
       while ($row = mysqli_fetch_assoc($query)) {
           $id_alkess = $row['id_alkes'];
           $nama_alkes = $row['nama_alkes'];

            if ($id_alkes == $id_alkess) {
              echo '<option value="' . $id_alkes . '" selected>' . $nama_alkes . '</option>';
          } else {
            echo '<option value="' . $id_alkes . '">' . $nama_alkes . '</option>';
        }
      }

        ?>
    </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="jumlah_ketersediaan_alkes" class="col-sm-2 col-form-label">Jumlah</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="jumlah_ketersediaan_alkes" name="jumlah_ketersediaan_alkes" value="<?php echo $jumlah?>" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
            <div class="col-sm-10">
            <select id="satuan" class="form-control" name="satuan">
  <option value="">- Pilih -</option>
  <option value="Pcs" <?php if ($satuan === 'Pcs') echo 'selected'; ?>>Pcs</option>
  <option value="Unit" <?php if ($satuan === 'Unit') echo 'selected'; ?>>Unit</option>
  <option value="Pack" <?php if ($satuan === 'Pack') echo 'selected'; ?>>Pack</option>
  <option value="Roll" <?php if ($satuan === 'Roll') echo 'selected'; ?>>Roll</option>
  <option value="Box" <?php if ($satuan === 'Box') echo 'selected'; ?>>Box</option>

</select>

            </div>
          </div>
          <div class="row mb-3">
            <label for="harga_beli_alkes" class="col-sm-2 col-form-label">Harga Beli</label>
            <div class="col-sm-10">
            <input name="harga_beli_alkes" type="number" class="form-control" id="harga_beli_alkes" value="<?php echo $harga_beli_alkes ?>"  required>

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
              <a href="?page=ketersediaan_alkes-detail&id=<?php echo $id_alkes?>" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>