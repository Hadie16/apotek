<?php
//error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM ketersediaan_obat WHERE id_ketersediaan_obat=$id");

while ($data = mysqli_fetch_array($result)) {

  $id_obat = $data['id_obat'];
  $id_ketersediaan_obat = $data['id_ketersediaan_obat'];


  $jumlah_ketersediaan_obat = $data['jumlah_ketersediaan_obat'];
  $harga_jual_obat = $data['harga_jual_obat'];

  $tanggal_kadaluarsa_obat = $data['tanggal_kadaluarsa_obat'];

  // $tanggal_masuk_obat = $data['tanggal_masuk_obat'];
}



if (isset($_POST['submit'])) {
  $id_ketersediaan_obat = $_POST['id_ketersediaan_obat'];
  $id_obat = $_POST['id_obat'];

  $jumlah_ketersediaan_obat = $_POST['jumlah_ketersediaan_obat'];
  $harga_jual_obat = $_POST['harga_jual_obat'];
  $jumlah_ketersediaan_obat = $_POST['jumlah_ketersediaan_obat'];
  $jumlah_ketersediaan_obats = $_POST['jumlah_ketersediaan_obats'];
  $satuan = $_POST['satuan'];


  $tanggal_kadaluarsa_obat = $_POST['tanggal_kadaluarsa_obat'];

  
  
  
  // if ($insert3) {
  //     echo "<p>query berhasil<p/>";
  //   } else {
  //     die('invalid Query : ' . mysqli_error($con));
  //   }
  
 
  
  $update = mysqli_query($con, "UPDATE ketersediaan_obat SET 
  jumlah_ketersediaan_obat = '$jumlah_ketersediaan_obat',
  satuan = '$satuan',
  harga_jual_obat = '$harga_jual_obat',
  tanggal_kadaluarsa_obat = '$tanggal_kadaluarsa_obat'
WHERE id_ketersediaan_obat = '$id'");

  
  if ($update) {
    // echo "<p>query berhasil<p/>";
  } else {
    die('invalid Query : ' . mysqli_error($con));
  }
  $dataQuery = "SELECT * FROM ketersediaan_obat WHERE id_ketersediaan_obat = '$id_ketersediaan_obat'";
  $dataResult = mysqli_query($con, $dataQuery);
  
  $updateQuery = "UPDATE ketersediaan_obat SET jumlah_ketersediaan_obat = '$jumlah_ketersediaan_obat' WHERE id_ketersediaan_obat = '$id_ketersediaan_obat'";
  mysqli_query($con, $updateQuery);

  if ($updateQuery) {
    // echo "<p>query berhasil<p/>";
  } else {
    die('invalid Query : ' . mysqli_error($con));
  }



  
    echo "<script>window.location.href = '?page=ketersediaan_obat-show';</script>";
  
}
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>
<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">ketersediaan Obat</h6>

      </div>
      <div class="card-body">
        <form method="POST">
          <div class="row mb-3">
          <label for="id_obat" class="col-sm-2 col-form-label">Nama Obat</label>
<div class="col-sm-10">

<!-- <input type="text" id="datepicker"> -->


  <select name="id_ketersediaan_obat" id="id_obat_select_edit" class="form-control" disabled required>
        <option value="">- Pilih -</option>
        <?php
          $query = mysqli_query($con, "SELECT t1.nama_obat,t2.id_ketersediaan_obat FROM obat t1
          JOIN ketersediaan_obat t2 ON t1.id_obat = t2.id_obat where jumlah_ketersediaan_obat > 0 and tanggal_kadaluarsa_obat > CURDATE() order by t2.id_obat");
        // $query = mysqli_query($con, "SELECT id_obat, nama_obat FROM obat");
        while ($row = mysqli_fetch_assoc($query)) {
            // $id_obat = $row['id_obat'];
            $id_ketersediaan_obat2 = $row['id_ketersediaan_obat'];
            $nama_obat = $row['nama_obat'];
            // $jko = $row['jumlah_ketersediaan_obat'];
            // $satuan = $row['satuan'];

            if ($id_obat == $id_obat) {
              echo '<option value="' . $id_ketersediaan_obat2 . '" selected>' . $nama_obat . '</option>';
          } else {
            echo '<option value="' . $id_ketersediaan_obat2 . '" >' . $nama_obat . '</option>';
        }

            // $idd = 2;
            // echo '<option value="' . $id_ketersediaan_obat2 . '" >' . $nama_obat . '</option>';
        }
        ?>
    </select>

</div>
<input type="hidden" class="form-control" id="" name="id_ketersediaan_obat" value="<?php echo $id_ketersediaan_obat?>" required>  

<input type="hidden" class="form-control" id="id_obats" name="id_obat" required>  

          </div>

          <div class="row mb-3">
            <label for="jumlah_ketersediaan_obat" class="col-sm-2 col-form-label">Tambah ketersediaan Obat</label>
            <div class="col-sm-5">
              <input type="number" class="form-control" id="jumlah_ketersediaan_obat" name="jumlah_ketersediaan_obat" oninput="calculateAndUpdate()"  value="<?php echo $jumlah_ketersediaan_obat?>" required>  
            </div>

            <label for="jumlah_ketersediaan_obat" class="col-sm-2 col-form-label">Ketersediaan Obat</label>
            <div class="col-sm-2">
        
            <input type="hidden" class="form-control" id="jumlah_ketersediaan_obat" name="jumlah_ketersediaan_obats"  readonly>
            <input type="hidden" class="form-control" id="satuan" name="satuan" readonly>

              
              <input type="text" class="form-control" id="jumlah_ketersediaan_obat_display" name="jumlah_ketersediaan_obat" readonly>
   
        
            </div>  
            <label for="s" class="col-sm col-form-label" id="unit" name="unit"></label>
            </div>

          <div class="row mb-3">
            <label for="harga_jual_obat" class="col-sm-2 col-form-label">Harga Jual</label>
            <div class="col-sm-5">
            <input type="text" class="form-control" id="harga_jual_obat" name="harga_jual_obat" value="<?php echo $harga_jual_obat ?>" required>

            </div>
            <label for="harga_beli_obat" class="col-sm-2 col-form-label">Harga Beli</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" id="harga_beli_obat" name="harga_beli_obat" readonly>

            </div>
          </div>

    

          <div class="row mb-3">
            <label for="tanggal_kadaluarsa_obat" class="col-sm-2 col-form-label">Tanggal Kadaluarsa</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="tanggal_kadaluarsa_obat" name="tanggal_kadaluarsa_obat" readonly>
            </div>
          </div>
<!-- 
          <div class="row mb-3">
            <label for="tanggal_masuk_obat" class="col-sm-2 col-form-label">Tanggal Masuk</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="tanggal_masuk_obat" name="tanggal_masuk_obat" value="<?php echo date('Y-m-d'); ?>" readonly>
            </div>
          </div> -->

     
          <hr>

          <div class="row">

            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=ketersediaan_obat-show" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>