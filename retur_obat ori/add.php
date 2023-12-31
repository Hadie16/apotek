<?php
if (isset($_POST['submit'])) {
  // $id_retur_obat = $_POST['id_retur_obat'];
  $id_obat = $_POST['id_obat'];
  $jumlah = $_POST['jumlah'];
  $satuan = $_POST['satuan'];

  $tanggal_retur = $_POST['tanggal_retur'];
  $id_penerimaan_obat = $_POST['id_penerimaan_obat'];

  $insert = mysqli_query($con, "INSERT INTO retur_obat(id_obat,jumlah,satuan,tanggal_retur,id_penerimaan_obat) 
  VALUES('$id_obat','$jumlah','$satuan','$tanggal_retur','$id_penerimaan_obat')");

  if ($insert) {
    echo "<script>window.location.href = '?page=retur_obat-show';</script>";
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
        <h6 class="m-0 font-weight-bold text-primary">Retur Obat</h6>
      </div>
      <div class="card-body">
        <form method="POST">

          <!-- <div class="row mb-3">
            <label for="id_retur_obat" class="col-sm-2 col-form-label">ID Retur Obat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="id_retur_obat" name="id_retur_obat" required>
            </div>
          </div> -->

          <div class="row mb-3">
            <label for="id_obat" class="col-sm-2 col-form-label">Nama Obat</label>
            <div class="col-sm-10">
            <select name="id_obat" id="id_obat" class="form-control" required>
        <option value="">- Pilih -</option>
        <?php
        $query = mysqli_query($con, "SELECT id_obat, nama_obat FROM obat");
        while ($row = mysqli_fetch_assoc($query)) {
            $id_obat = $row['id_obat'];
            $nama_obat = $row['nama_obat'];
            echo '<option value="' . $id_obat . '">' . $nama_obat . '</option>';
        }
        ?>
    </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="jumlah" name="jumlah">
            </div>
          </div>
          <div class="row mb-3">
            <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
            <div class="col-sm-10">
          <select  required="required" class="form-control" name="satuan"  >
                            <option value="" >- Pilih -</option>
                            <option value="Box" >Box</option>
                            <option value="Pcs" >Pcs</option>
                            <option value="Botol" >Botol</option>
                            <option value="Tube" >Tube</option>
                          </select>
            </div>
          </div>


          <div class="row mb-3">
  <label for="tanggal_retur" class="col-sm-2 col-form-label">Tanggal Retur</label>
  <div class="col-sm-10">
    <?php $currentDateTime = date("Y-m-d");?>
    <input type="date" class="form-control" id="tanggal_retur" name="tanggal_retur" value="<?php echo $currentDateTime; ?>" readonly>
  </div>
</div>


          <div class="row mb-3">
            <label for="id_penerimaan_obat" class="col-sm-2 col-form-label">Kode Penerimaan</label>
            <div class="col-sm-10">
            <select name="id_penerimaan_obat" id="id_penerimaan_obat" class="form-control" required>
        <option value="">- Pilih -</option>
        <?php
        $query = mysqli_query($con, "SELECT id_penerimaan_obat, kode_penerimaan_obat FROM penerimaan_obat");
        while ($row = mysqli_fetch_assoc($query)) {
            $id_penerimaan_obat = $row['id_penerimaan_obat'];
            $kode_penerimaan_obat = $row['kode_penerimaan_obat'];
            echo '<option value="' . $id_penerimaan_obat . '">' . $kode_penerimaan_obat . '</option>';
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
