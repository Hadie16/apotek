<?php
$id = $_GET['id'];
$query = mysqli_query($con,  "SELECT * FROM detail_pengadaan_obat WHERE id_detail_pengadaan_obat=$id");
if (!$query) {
  die('Query Error: ' . mysqli_error($con));}
      while ($data = mysqli_fetch_array($query)) { 
      $id_pengadaan_obat =  $data['id_pengadaan_obat'];
      $id_obat = $data['id_obat'];
      $jumlah = $data['jumlah'];
      $satuan = $data['satuan'];
      }


if (isset($_POST['submit'])) {
  $id_pengadaan_obat = $_POST['id_pengadaan_obat'];
  $id_obat = $_POST['id_obat'];
  $jumlah = $_POST['jumlah'];
  $satuan = $_POST['satuan'];

  $insert = mysqli_query($con, "UPDATE detail_pengadaan_obat set id_pengadaan_obat='$id_pengadaan_obat', id_obat='$id_obat', jumlah='$jumlah', satuan='$satuan' WHERE id_detail_pengadaan_obat='$id'");

if ($insert) {
    echo "<script>window.location.href = '?page=detail_pengadaan_obat-show&id=" . $id_pengadaan_obat . "';</script>";
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
        <h6 class="m-0 font-weight-bold text-primary">Detail Pengadaan Obat</h6>
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="row mb-3">
            <label for="id_pengadaan_obat" class="col-sm-2 col-form-label">ID Pengadaan Obat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="id_pengadaan_obat" name="id_pengadaan_obat" value="<?php echo $id_pengadaan_obat?>" readonly>
            </div>
          </div>

          <div class="row mb-3">
            <label for="id_obat" class="col-sm-2 col-form-label">Nama Obat</label>
            <div class="col-sm-10">
            <select name="id_obat" id="id_obat" class="form-control" required>
  <option value="">- Pilih -</option>
  <?php
  $query = mysqli_query($con, "SELECT id_obat, nama_obat FROM obat");
  while ($row = mysqli_fetch_assoc($query)) {
    $obat_id = $row['id_obat'];
    $nama_obat = $row['nama_obat'];
    if ($obat_id == $id_obat) {
      echo '<option value="' . $obat_id . '" selected>' . $nama_obat . '</option>';
    } else {
      echo '<option value="' . $obat_id . '">' . $nama_obat . '</option>';
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
            <select  required="required" class="form-control" name="satuan"  >
                            <option value="" >- Pilih -</option>
                            <option value="Box" <?php if ($satuan == 'Box') echo 'selected'; ?>>Box</option>
                            <option value="Pcs" <?php if ($satuan == 'Pcs') echo 'selected'; ?>>Pcs</option>
                            <option value="Botol" <?php if ($satuan == 'Botol') echo 'selected'; ?>>Botol</option>
                            <option value="Tube" <?php if ($satuan == 'Tube') echo 'selected'; ?>>Tube</option>



                            
                            


                          </select>
          </div>
          </div>



       
          <div class="row">
            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i> Simpan</button>
              <a href="?page=detail_pengadaan_obat-show&id=<?php echo $id_pengadaan_obat; ?>" class="btn btn-danger"><i class="fas fa-chevron-left"></i> Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
