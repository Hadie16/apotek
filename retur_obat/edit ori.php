<?php
$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM retur_obat WHERE id_retur_obat=$id");

while ($data = mysqli_fetch_array($result)) {
  // $nim          = $data['nim'];
  $id_obat = $data['id_obat'];
  $jumlah = $data['jumlah'];
  $satuan = $data['satuan'];

  $tanggal_retur = $data['tanggal_retur'];
  $id_penerimaan_obat = $data['id_penerimaan_obat'];
}

if (isset($_POST['submit'])) {
  // $nim          = $_POST['nim'];
  $id_obat = $_POST['id_obat'];
  $jumlah = $_POST['jumlah'];
  $satuan = $_POST['satuan'];

  $tanggal_retur = $_POST['tanggal_retur'];
  $id_penerimaan_obat = $_POST['id_penerimaan_obat'];

  $update = mysqli_query($con, "UPDATE retur_obat SET id_obat='$id_obat',jumlah='$jumlah',satuan='$satuan',tanggal_retur='$tanggal_retur',id_penerimaan_obat='$id_penerimaan_obat' WHERE id_retur_obat=$id");

  echo "<script>window.location.href = '?page=retur_obat-show';</script>";
}
?>
<?php
// if (isset($_POST['submit'])) {
//   // $id_retur_obat = $_POST['id_retur_obat'];
//   $id_obat = $_POST['id_obat'];
//   $jumlah = $_POST['jumlah'];
//   $tanggal_retur = $_POST['tanggal_retur'];
//   $id_penerimaan_obat = $_POST['id_penerimaan_obat'];

//   $insert = mysqli_query($con, "INSERT INTO retur_obat(id_obat,jumlah,tanggal_retur,id_penerimaan_obat) 
//   VALUES('$id_obat','$jumlah','$tanggal_retur','$id_penerimaan_obat')");

//   if ($insert) {
//     echo "<script>window.location.href = '?page=retur_obat-show';</script>";
//   }
// }
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>
<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Retur Obat</h6>
      </div>
      <div class="card-body">
        <form method="POST">

          <!-- <div class="row mb-3">
            <label for="id_retur_obat" class="col-sm-2 col-form-label">ID Retur obat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="id_retur_obat" name="id_retur_obat" required>
            </div>
          </div> -->

          <div class="row mb-3">
            <label for="id_obat" class="col-sm-2 col-form-label">Nama Obat</label>
            <div class="col-sm-10">
            <select name="id_obat" id="id_obat" class="form-control" name="id_obat" required>
                        <option value="">- pilih -</option>
                        <?php
                        // include "connection.php";
                        $query = mysqli_query($con, "SELECT * FROM obat");
                        while ($data_obat = mysqli_fetch_array($query)) {
                            if ($id_obat == $data_obat['id_obat']) {
                                $select = "selected";
                            } else {
                                $select = "";
                            }
                            echo "<option value ='$data_obat[id_obat]' $select>" . $data_obat['nama_obat'] .
                                "</option>";
                        }
                        ?>
                    </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $jumlah ?>">
            </div>
          </div>
          <div class="row mb-3">
            <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
            <div class="col-sm-10">
            <select id="satuan" class="form-control" name="satuan" required>
            <option value="" >- Pilih -</option>
                            <option value="Box" <?php if ($satuan == 'Box') echo 'selected'; ?>>Box</option>
                            <option value="Pcs" <?php if ($satuan == 'Pcs') echo 'selected'; ?>>Pcs</option>
                            <option value="Botol" <?php if ($satuan == 'Botol') echo 'selected'; ?>>Botol</option>
                            <option value="Tube" <?php if ($satuan == 'Tube') echo 'selected'; ?>>Tube</option>
                          

              </select>
            </div>
          </div>



     
          <div class="row mb-3">
  <label for="tanggal_retur" class="col-sm-2 col-form-label">Tanggal Retur</label>
  <div class="col-sm-10">
    <input type="date" class="form-control" id="tanggal_retur" name="tanggal_retur" value="<?php echo $tanggal_retur?>" >
  </div>
</div>


          <div class="row mb-3">
            <label for="id_penerimaan_obat" class="col-sm-2 col-form-label">Kode Penerimaan</label>
            <div class="col-sm-10">
            <select name="id_penerimaan_obat" id="id_penerimaan_obat" class="form-control" name="id_penerimaan_obat" required>
                        <option value="">- pilih -</option>
                        <?php
                        // include "connection.php";
                        $query = mysqli_query($con, "SELECT * FROM penerimaan_obat");
                        while ($data_penj = mysqli_fetch_array($query)) {
                            if ($id_penerimaan_obat == $data_penj['id_penerimaan_obat']) {
                                $select = "selected";
                            } else {
                                $select = "";
                            }
                            echo "<option value ='$data_penj[id_penerimaan_obat]' $select>" . $data_penj['kode_penerimaan_obat'] .
                                "</option>";
                        }
                        ?>
                    </select>
            </div>
          </div>
          <hr>

          <div class="row">
            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=retur_obat-show" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
