<?php
//error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM stok_alkes WHERE id_stok_alkes=$id");

while ($data = mysqli_fetch_array($result)) {

  $id_alkes = $data['id_alkes'];
  $id_ketersediaan_alkes = $data['id_ketersediaan_alkes'];


  $jumlah_stok_alkes = $data['jumlah_stok_alkes'];
  $harga_jual_alkes = $data['harga_jual_alkes'];

  $tanggal_kadaluarsa_alkes = $data['tanggal_kadaluarsa_alkes'];

  // $tanggal_masuk_alkes = $data['tanggal_masuk_alkes'];
}



if (isset($_POST['submit'])) {
  $id_ketersediaan_alkes = $_POST['id_ketersediaan_alkes'];
  $id_alkes = $_POST['id_alkes'];

  $jumlah_stok_alkes = $_POST['jumlah_stok_alkes'];
  $harga_jual_alkes = $_POST['harga_jual_alkes'];
  $jumlah_ketersediaan_alkes = $_POST['jumlah_ketersediaan_alkes'];
  $jumlah_ketersediaan_alkess = $_POST['jumlah_ketersediaan_alkess'];
  $satuan = $_POST['satuan'];


  $tanggal_kadaluarsa_alkes = $_POST['tanggal_kadaluarsa_alkes'];

  
  
  
  // if ($insert3) {
  //     echo "<p>query berhasil<p/>";
  //   } else {
  //     die('invalid Query : ' . mysqli_error($con));
  //   }
  
 
  
  $update = mysqli_query($con, "UPDATE stok_alkes SET 
  jumlah_stok_alkes = '$jumlah_stok_alkes',
  satuan = '$satuan',
  harga_jual_alkes = '$harga_jual_alkes',
  tanggal_kadaluarsa_alkes = '$tanggal_kadaluarsa_alkes'
WHERE id_stok_alkes = '$id'");

  
  if ($update) {
    // echo "<p>query berhasil<p/>";
  } else {
    die('invalid Query : ' . mysqli_error($con));
  }
  $dataQuery = "SELECT * FROM ketersediaan_alkes WHERE id_ketersediaan_alkes = '$id_ketersediaan_alkes'";
  $dataResult = mysqli_query($con, $dataQuery);
  
  $updateQuery = "UPDATE ketersediaan_alkes SET jumlah_ketersediaan_alkes = '$jumlah_ketersediaan_alkes' WHERE id_ketersediaan_alkes = '$id_ketersediaan_alkes'";
  mysqli_query($con, $updateQuery);

  if ($updateQuery) {
    // echo "<p>query berhasil<p/>";
  } else {
    die('invalid Query : ' . mysqli_error($con));
  }



  
    echo "<script>window.location.href = '?page=stok_alkes-show';</script>";
  
}
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>
<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Stok Alkes</h6>

      </div>
      <div class="card-body">
        <form method="POST">
          <div class="row mb-3">
          <label for="id_alkes" class="col-sm-2 col-form-label">Nama Alkes</label>
<div class="col-sm-10">

<!-- <input type="text" id="datepicker"> -->


  <select name="id_ketersediaan_alkes" id="id_alkes_select_edit" class="form-control" disabled required>
        <option value="">- Pilih -</option>
        <?php
          $query = mysqli_query($con, "SELECT t1.nama_alkes,t2.id_ketersediaan_alkes FROM alkes t1
          JOIN ketersediaan_alkes t2 ON t1.id_alkes = t2.id_alkes where jumlah_ketersediaan_alkes > 0 and tanggal_kadaluarsa_alkes > CURDATE() and id_ketersediaan_alkes = $id_ketersediaan_alkes order by t2.id_alkes");
        // $query = mysqli_query($con, "SELECT id_alkes, nama_alkes FROM alkes");
        while ($row = mysqli_fetch_assoc($query)) {
            // $id_alkes = $row['id_alkes'];
            $id_ketersediaan_alkes2 = $row['id_ketersediaan_alkes'];
            $nama_alkes = $row['nama_alkes'];
            // $jko = $row['jumlah_ketersediaan_alkes'];
            // $satuan = $row['satuan'];

            if ($id_alkes == $id_alkes) {
              echo '<option value="' . $id_ketersediaan_alkes2 . '" selected>' . $nama_alkes . '</option>';
          } else {
            echo '<option value="' . $id_ketersediaan_alkes2 . '" >' . $nama_alkes . '</option>';
        }

            // $idd = 2;
            // echo '<option value="' . $id_ketersediaan_alkes2 . '" >' . $nama_alkes . '</option>';
        }
        ?>
    </select>

</div>
<input type="hidden" class="form-control" id="" name="id_ketersediaan_alkes" value="<?php echo $id_ketersediaan_alkes?>" required>  

<input type="hidden" class="form-control" id="id_alkess" name="id_alkes" required>  

          </div>

          <div class="row mb-3">
            <label for="jumlah_stok_alkes" class="col-sm-2 col-form-label">Tambah Stok Alkes</label>
            <div class="col-sm-5">
              <input type="number" class="form-control" id="jumlah_stok_alkes" name="jumlah_stok_alkes" oninput="calculateAndUpdate()"  value="<?php echo $jumlah_stok_alkes?>" required>  
            </div>

            <label for="jumlah_ketersediaan_alkes" class="col-sm-2 col-form-label">Ketersediaan Alkes</label>
            <div class="col-sm-2">
        
            <input type="hidden" class="form-control" id="jumlah_ketersediaan_alkes" name="jumlah_ketersediaan_alkess"  readonly>
            <input type="hidden" class="form-control" id="satuan" name="satuan" readonly>

              
              <input type="text" class="form-control" id="jumlah_ketersediaan_alkes_display" name="jumlah_ketersediaan_alkes" readonly>
   
        
            </div>  
            <label for="s" class="col-sm col-form-label" id="unit" name="unit"></label>
            </div>

          <div class="row mb-3">
            <label for="harga_jual_alkes" class="col-sm-2 col-form-label">Harga Jual</label>
            <div class="col-sm-5">
            <input type="text" class="form-control" id="harga_jual_alkes" name="harga_jual_alkes" value="<?php echo $harga_jual_alkes ?>" required>

            </div>
            <label for="harga_beli_alkes" class="col-sm-2 col-form-label">Harga Beli</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" id="harga_beli_alkes" name="harga_beli_alkes" readonly>

            </div>
          </div>

    

          <div class="row mb-3">
            <label for="tanggal_kadaluarsa_alkes" class="col-sm-2 col-form-label">Tanggal Kadaluarsa</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="tanggal_kadaluarsa_alkes" name="tanggal_kadaluarsa_alkes" readonly>
            </div>
          </div>
<!-- 
          <div class="row mb-3">
            <label for="tanggal_masuk_alkes" class="col-sm-2 col-form-label">Tanggal Masuk</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="tanggal_masuk_alkes" name="tanggal_masuk_alkes" value="<?php echo date('Y-m-d'); ?>" readonly>
            </div>
          </div> -->

     
          <hr>

          <div class="row">

            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=stok_alkes-detail&id=<?php echo $id_alkes ?>"  class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>