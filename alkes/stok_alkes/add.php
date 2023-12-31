<?php
//error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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
  
 
  
    $insert = mysqli_query($con, "INSERT INTO stok_alkes(id_ketersediaan_alkes,id_alkes,jumlah_stok_alkes,satuan,harga_jual_alkes,tanggal_kadaluarsa_alkes) 
    VALUES('$id_ketersediaan_alkes','$id_alkes','$jumlah_stok_alkes','$satuan','$harga_jual_alkes','$tanggal_kadaluarsa_alkes')");
  
  if ($insert) {
    // echo "<p>query berhasil<p/>";
  } else {
    die('invalid Query : ' . mysqli_error($con));
  }
  $dataQuery = "SELECT * FROM ketersediaan_alkes WHERE id_ketersediaan_alkes = $id_ketersediaan_alkes";
  $dataResult = mysqli_query($con, $dataQuery);
  
  $updateQuery = "UPDATE ketersediaan_alkes SET jumlah_ketersediaan_alkes = $jumlah_ketersediaan_alkes WHERE id_ketersediaan_alkes = $id_ketersediaan_alkes";
  mysqli_query($con, $updateQuery);

 



// $dataQuery = "SELECT * FROM ketersediaan_alkes WHERE id_ketersediaan_alkes = $id_ketersediaan_alkes AND jumlah_alkes > 0 ";
// $dataResult = mysqli_query($con, $dataQuery);

// $availableStocks2 = '';

// // Iterate over the data
// while ($rowData = mysqli_fetch_assoc($dataResult)) {

//   // $availableStocks2 = $rowData['jumlah_alkes'];

//   $availableStocks = $rowData['jumlah_alkes'];

//   // Calculate the quantity to deduct from available stocks
//   $deductQuantity = min($jumlah_stok_alkes, $availableStocks);

//   // Update stocks in the current data row
//   $newStocks = $availableStocks - $deductQuantity;
//   $updateQuery = "UPDATE detail_ketersediaan_alkes SET jumlah_alkes = $newStocks WHERE id_detail_ketersediaan_alkes = " . $rowData['id_detail_ketersediaan_alkes'];
//   mysqli_query($con, $updateQuery);

//   // Subtract the deducted quantity from the remaining quantity
//   $jumlah_stok_alkes -= $deductQuantity;

//   // Exit the loop if the remaining quantity is fulfilled
//   if ($jumlah_stok_alkes <= 0) {
//     break;
//   }
// }


  
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


  <select name="id_ketersediaan_alkes" id="id_alkes_select" class="form-control" required>
        <option value="">- Pilih -</option>
        <?php
          $query = mysqli_query($con, "SELECT t1.nama_alkes,t2.id_ketersediaan_alkes FROM alkes t1
          JOIN ketersediaan_alkes t2 ON t1.id_alkes = t2.id_alkes where jumlah_ketersediaan_alkes > 0 and tanggal_kadaluarsa_alkes > CURDATE() order by t2.id_alkes");
        // $query = mysqli_query($con, "SELECT id_alkes, nama_alkes FROM alkes");
        while ($row = mysqli_fetch_assoc($query)) {
            // $id_alkes = $row['id_alkes'];
            $id_ketersediaan_alkes2 = $row['id_ketersediaan_alkes'];
            $nama_alkes = $row['nama_alkes'];
            // $jko = $row['jumlah_ketersediaan_alkes'];
            // $satuan = $row['satuan'];



            // $idd = 2;
            echo '<option value="' . $id_ketersediaan_alkes2 . '" >' . $nama_alkes . '</option>';
        }
        ?>
    </select>

</div>

<input type="hidden" class="form-control" id="id_alkess" name="id_alkes" required>  

          </div>

          <div class="row mb-3">
            <label for="jumlah_stok_alkes" class="col-sm-2 col-form-label">Tambah Stok Alkes</label>
            <div class="col-sm-5">
              <input type="number" class="form-control" id="jumlah_stok_alkes" name="jumlah_stok_alkes" oninput="calculateAndUpdate()" required>  
            </div>

            <label for="jumlah_ketersediaan_alkes" class="col-sm-2 col-form-label">Ketersediaan Alkes</label>
            <div class="col-sm-2">
        
            <input type="hidden" class="form-control" id="jumlah_ketersediaan_alkes" name="jumlah_ketersediaan_alkess" readonly>
            <input type="hidden" class="form-control" id="satuan" name="satuan" readonly>

              
              <input type="text" class="form-control" id="jumlah_ketersediaan_alkes_display" name="jumlah_ketersediaan_alkes" readonly>
   
        
            </div>  
            <label for="s" class="col-sm col-form-label" id="unit" name="unit"></label>
            </div>

          <div class="row mb-3">
            <label for="harga_jual_alkes" class="col-sm-2 col-form-label">Harga Jual</label>
            <div class="col-sm-5">
            <input type="text" class="form-control" id="harga_jual_alkes" name="harga_jual_alkes" required>

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
              <a href="?page=stok_alkes-show" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>