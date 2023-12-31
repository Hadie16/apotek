<?php
$id = $_GET['id'];
$query = mysqli_query($con,  "SELECT * FROM pengadaan_alkes WHERE id_pengadaan_alkes=$id");
if (!$query) {
  die('Query Error: ' . mysqli_error($con));}
      while ($data = mysqli_fetch_array($query)) { 
      $id_pengadaan_alkes =  $data['id_pengadaan_alkes'];
      }


if (isset($_POST['submit'])) {
  $id_pengadaan_alkes = $_POST['id_pengadaan_alkes'];
  $id_alkes = $_POST['id_alkes'];
  $jumlah = $_POST['jumlah'];
  $satuan = $_POST['satuan'];

  $insert = mysqli_query($con, "INSERT INTO detail_pengadaan_alkes(id_pengadaan_alkes, id_alkes, jumlah, satuan) 
    VALUES('$id_pengadaan_alkes', '$id_alkes', '$jumlah', '$satuan')");

if ($insert) {
    echo "<script>window.location.href = '?page=detail_pengadaan_alkes-show&id=" . $id_pengadaan_alkes . "';</script>";
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
        <h6 class="m-0 font-weight-bold text-primary">Detail Pengadaan alkes</h6>
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="row mb-3">
            <label for="id_pengadaan_alkes" class="col-sm-2 col-form-label">ID Pengadaan alkes</label>
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
            $id_alkes = $row['id_alkes'];
            $nama_alkes = $row['nama_alkes'];
            echo '<option value="' . $id_alkes . '">' . $nama_alkes . '</option>';
        }
        ?>
    </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="jumlah" name="jumlah" required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
            <div class="col-sm-10">
            <select  required="required" class="form-control" name="satuan"  >
                            <option value="" >- Pilih -</option>
                            <option value="Box" >Box</option>
                            <option value="Pcs" >Pcs</option>
                            <option value="Unit" >Unit</option>
                            <option value="Pack" >Pack</option>
                            <option value="Botol" >Botol</option>



                            
                            


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