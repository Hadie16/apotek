<?php
$id = $_GET['id'];
$query = mysqli_query($con,  "SELECT * FROM detail_pengadaan_alkes WHERE id_detail_pengadaan_alkes=$id");
if (!$query) {
  die('Query Error: ' . mysqli_error($con));}
      while ($data = mysqli_fetch_array($query)) { 
      $id_pengadaan_alkes =  $data['id_pengadaan_alkes'];
      $id_alkes = $data['id_alkes'];
      $jumlah = $data['jumlah'];
      $satuan = $data['satuan'];
      }


if (isset($_POST['submit'])) {
  $id_pengadaan_alkes = $_POST['id_pengadaan_alkes'];
  $id_alkes = $_POST['id_alkes'];
  $jumlah = $_POST['jumlah'];
  $satuan = $_POST['satuan'];

  $insert = mysqli_query($con, "UPDATE detail_pengadaan_alkes set id_pengadaan_alkes='$id_pengadaan_alkes', id_alkes='$id_alkes', jumlah='$jumlah', satuan='$satuan' WHERE id_detail_pengadaan_alkes='$id'");

if ($insert) {
    echo "<script>window.location.href = '?page=detail_pengadaan_alkes-show&id=" . $id_pengadaan_alkes . "';</script>";
  }
// if ($insert) {
//   echo "<p>query berhasil<p/>";
// } else {
//   die('invalid Query : ' . mysqli_error($con));
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
        <h6 class="m-0 font-weight-bold text-primary">Detail Pengadaan Alkes</h6>
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="row mb-3">
            <label for="id_pengadaan_alkes" class="col-sm-2 col-form-label">ID Pengadaan Alkes</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="id_pengadaan_alkes" name="id_pengadaan_alkes" value="<?php echo $id_pengadaan_alkes?>" readonly>
            </div>
          </div>

          <div class="row mb-3">
            <label for="id_alkes" class="col-sm-2 col-form-label">Nama Alkes</label>
            <div class="col-sm-10">
            <select name="id_alkes" id="id_alkes" class="form-control" required>
  <option value="">- Pilih -</option>
  <?php
  $query = mysqli_query($con, "SELECT id_alkes, nama_alkes FROM alkes");
  while ($row = mysqli_fetch_assoc($query)) {
    $alkes_id = $row['id_alkes'];
    $nama_alkes = $row['nama_alkes'];
    if ($alkes_id == $id_alkes) {
      echo '<option value="' . $alkes_id . '" selected>' . $nama_alkes . '</option>';
    } else {
      echo '<option value="' . $alkes_id . '">' . $nama_alkes . '</option>';
    }
  }
  ?>
</select>

            </div>
          </div>

          <div class="row mb-3">
            <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $jumlah?>"   required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
            <div class="col-sm-10">
            <select id="satuan" class="form-control" name="satuan" required>
            <option value="" >- Pilih -</option>
                            <option value="Box" <?php if ($satuan == 'Box') echo 'selected'; ?>>Box</option>
                            <option value="Pcs" <?php if ($satuan == 'Pcs') echo 'selected'; ?>>Pcs</option>
                            <option value="Unit" <?php if ($satuan == 'Unit') echo 'selected'; ?>>Unit</option>
                            <option value="Pack" <?php if ($satuan == 'Pack') echo 'selected'; ?>>Pack</option>
                            <option value="Botol" <?php if ($satuan == 'Botol') echo 'selected'; ?>>Botol</option>

              </select>
            </div>
          </div>
        
       
          <div class="row">
            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i> Simpan</button>
              <a href="?page=detail_pengadaan_alkes-show&id=<?php echo $id_pengadaan_alkes; ?>" class="btn btn-danger"><i class="fas fa-chevron-left"></i> Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
