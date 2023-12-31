<?php
//error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_POST['submit'])) {
  $id_ketersediaan_obat = $_POST['id_ketersediaan_obat'];
  $id_obat = $_POST['id_obat'];

  $jumlah_stok_obat = $_POST['jumlah_stok_obat'];
  $harga_jual_obat = $_POST['harga_jual_obat'];
  $jumlah_ketersediaan_obat = $_POST['jumlah_ketersediaan_obat'];
  $tanggal_kadaluarsa_obat = $_POST['tanggal_kadaluarsa_obat'];
  // $merk_obat = $_POST['merk_obat'];
  $tanggal_masuk_obat = $_POST['tanggal_masuk_obat'];

  // $insert = mysqli_query($con, "INSERT INTO stok_obat(id_ketersediaan_obat,id_obat,jumlah_stok_obat,harga_jual_obat,tanggal_kadaluarsa_obat) VALUES('$id_ketersediaan_obat','$id_obat','$jumlah_stok_obat','$harga_jual_obat','$tanggal_kadaluarsa_obat')");


  // Check if the medicine_id exists in the second table (medicine_stock table)
  $query = "SELECT * FROM stok_obat WHERE id_obat = $id_obat";
  // $result = mysqli_query($con, $query);
  $result = mysqli_query($con, $query);
  
  
  $insert3='';
  $firstTableID2='';
  $id_table='';
  
  if (mysqli_num_rows($result) > 0) {
    // Update existing row
    $row = mysqli_fetch_assoc($result);
    $id_table = $row['id_stok_obat'];
  
    $currentStockQuantity = $row['jumlah_stok_obat'];
    $newStockQuantity = $currentStockQuantity + $jumlah_stok_obat;
  
    // Determine the closest expiration date
    $currentExpiredDate = $row['tanggal_kadaluarsa_obat'];
    // $closestExpiredDate = // compare $currentExpiredDate and $expiredStockDate to get the closest date
    $expiredStockDate = $tanggal_kadaluarsa_obat;
  
    $currentExpiredTimestamp = strtotime($currentExpiredDate);
    $expiredStockTimestamp = strtotime($tanggal_kadaluarsa_obat);
    
    // Compare the timestamps to find the closest expiration date
    if ($expiredStockTimestamp < $currentExpiredTimestamp) {
      $closestExpiredDate = $expiredStockDate;
    } else {
      $closestExpiredDate = $currentExpiredDate;
    }
  
    // Update the row with the new stock quantity and closest expiration date
    $updateQuery = "UPDATE stok_obat SET jumlah_stok_obat = '$newStockQuantity',harga_jual_obat='$harga_jual_obat', tanggal_kadaluarsa_obat = '$closestExpiredDate' WHERE id_obat = '$id_obat'";
    $update2 = mysqli_query($con, $updateQuery);
  } else {
    // Insert a new row
    $insertQuery = "INSERT INTO stok_obat (id_obat, jumlah_stok_obat,harga_jual_obat, tanggal_kadaluarsa_obat) VALUES ('$id_obat', '$jumlah_stok_obat','$harga_jual_obat', '$tanggal_kadaluarsa_obat')";
    // mysqli_query($con, $insertQuery);
    $insert3 = mysqli_query($con, $insertQuery);
  $firstTableID2 = mysqli_insert_id($con);
  
  }
  
  
  
  // if ($insert3) {
  //     echo "<p>query berhasil<p/>";
  //   } else {
  //     die('invalid Query : ' . mysqli_error($con));
  //   }
  
  if ($insert3){
    $id_StokObat = $firstTableID2;
  
  } else {
    $id_StokObat = $id_table;  
  }
  // $id_StokObat = 1;
  
    $insert = mysqli_query($con, "INSERT INTO detail_stok_obat(id_stok_obat,id_ketersediaan_obat,id_obat,jumlah_stok_obat,harga_jual_obat,tanggal_kadaluarsa,tanggal_masuk_obat) 
    VALUES('$id_StokObat','$id_ketersediaan_obat','$id_obat','$jumlah_stok_obat','$harga_jual_obat','$tanggal_kadaluarsa_obat','$tanggal_masuk_obat')");
  
  // if ($insert) {
  //   echo "<p>query berhasil<p/>";
  // } else {
  //   die('invalid Query : ' . mysqli_error($con));
  // }
  $id_detailStok = mysqli_insert_id($con);


  $insert4 = mysqli_query($con, "INSERT INTO stok_obat_masuk(id_detail_stok_obat,id_obat,jumlah,waktu) 
  VALUES('$id_detailStok','$id_obat','$jumlah_stok_obat','$tanggal_masuk_obat')");

$updateKet = mysqli_query($con, "UPDATE ketersediaan_obat SET jumlah_ketersediaan_obat='$jumlah_ketersediaan_obat' WHERE id_ketersediaan_obat=$id_ketersediaan_obat");


$dataQuery = "SELECT * FROM detail_ketersediaan_obat WHERE id_ketersediaan_obat = $id_ketersediaan_obat AND jumlah_obat_masuk > 0 ";
$dataResult = mysqli_query($con, $dataQuery);

// Iterate over the data
while ($rowData = mysqli_fetch_assoc($dataResult)) {
  $availableStocks = $rowData['jumlah_obat_masuk'];

  // Calculate the quantity to deduct from available stocks
  $deductQuantity = min($jumlah_stok_obat, $availableStocks);

  // Update stocks in the current data row
  $newStocks = $availableStocks - $deductQuantity;
  $updateQuery = "UPDATE detail_ketersediaan_obat SET jumlah_obat_masuk = $newStocks WHERE id_detail_ketersediaan_obat = " . $rowData['id_detail_ketersediaan_obat'];
  mysqli_query($con, $updateQuery);

  // Subtract the deducted quantity from the remaining quantity
  $jumlah_stok_obat -= $deductQuantity;

  // Exit the loop if the remaining quantity is fulfilled
  if ($jumlah_stok_obat <= 0) {
    break;
  }
}

  // if ($insert) {
  //   echo "<script>window.location.href = '?page=stok_obat-show';</script>";
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
        <h6 class="m-0 font-weight-bold text-primary">Stok Obat</h6>

      </div>
      <div class="card-body">
        <form method="POST">
          <div class="row mb-3">
        
          <label for="id_obat" class="col-sm-2 col-form-label">Nama Obat</label>
<div class="col-sm-8">

<!-- <input type="text" id="datepicker"> -->


  <select name="id_ketersediaan_obat" id="id_obat_select" class="form-control" required>
        <option value="">- Pilih -</option>
        <?php
          $query = mysqli_query($con, "SELECT t1.nama_obat,t2.id_ketersediaan_obat FROM obat t1
          JOIN ketersediaan_obat t2 ON t1.id_obat = t2.id_obat");
        // $query = mysqli_query($con, "SELECT id_obat, nama_obat FROM obat");
        while ($row = mysqli_fetch_assoc($query)) {
            // $id_obat = $row['id_obat'];
            $id_ketersediaan_obat2 = $row['id_ketersediaan_obat'];
            $nama_obat = $row['nama_obat'];

            // $idd = 2;
            echo '<option value="' . $id_ketersediaan_obat2 . '" >' . $nama_obat . '</option>';
        }
        ?>
    </select>

 
        
</div>
<div class="col-sm-2">
        
        <button data-id="<?php echo $data['id_cek_kesehatan']; ?>" type="button" id="openModalButton" class="btn btn-warning input-data-btns" data-toggle="modal" data-target="#myModalPenerimaan">search</button>
</div>
<input type="hidden" class="form-control" id="id_obats" name="id_obat" required>  

          </div>

          <div class="row mb-3">
            <label for="jumlah_stok_obat" class="col-sm-2 col-form-label">Tambah Stok Obat</label>
            <div class="col-sm-5">
              <input type="number" class="form-control" id="jumlah_stok_obat" name="jumlah_stok_obat" required>  
            </div>

            <label for="jumlah_ketersediaan_obat" class="col-sm-2 col-form-label">Ketersediaan Obat</label>
            <div class="col-sm-2">
        
              
              <input type="text" class="form-control" id="jumlah_ketersediaan_obat" name="jumlah_ketersediaan_obat" readonly>
        
            </div>  
            <label for="s" class="col-sm col-form-label" id="unit" name="unit"></label>
            </div>

          <div class="row mb-3">
            <label for="harga_jual_obat" class="col-sm-2 col-form-label">Harga Jual</label>
            <div class="col-sm-5">
            <input type="text" class="form-control" id="harga_jual_obat" name="harga_jual_obat" required>

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

          <div class="row mb-3">
            <label for="tanggal_masuk_obat" class="col-sm-2 col-form-label">Tanggal Masuk</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="tanggal_masuk_obat" name="tanggal_masuk_obat" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
            </div>
          </div>

     
          <hr>

          <div class="row">

            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=stok_obat-show" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Form -->
<!-- <form id="myForm">
  <input type="text" id="input1" placeholder="Input 1">
  <input type="text" id="input2" placeholder="Input 2"> -->
  <!-- Add more input fields as needed -->
  <!-- <button id="openModalButton">Open Modal</button>
</form> -->


<!-- modal cek kesehatan-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">

  <div class="modal-dialog">
    <div class="modal-content">
      <form id="inputForm">
        <div class="modal-header">
          <h5 class="modal-title">Input Data</h5>
          <button type="button" class="btn-close" data-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="idInput" name="id">
          <div class="form-group">
            <label for="inputValue">Input Nilai:</label>
            <input type="text" class="form-control" id="inputValue" name="inputValue" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>




<!-- -------- -->
<div class="modal fade" id="myModdalPenerimaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <!-- <h5 class="modal-title">Input Nilai</h5> -->
        <button type="button" class="btn-close" data-dismiss="modal"></button>
      </div>
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_GET['id'];

if (isset($_POST['submit'])) {
  $kode_penjualan_obat = $_POST['kode_penjualan_obat'];


$update = mysqli_query($con, "UPDATE stok_obat SET jumlah_stok_obat='$jumlah_stok_obat' WHERE id_stok_obat=$id_stok_obat");

}

?>

      
      <!-- Modal Body -->
      <div class="modal-body">
      <form method="POST">

        <!-- <p>Modal content goes here.</p> -->
        <div class="row mb-3">
            <!-- <label for="nilai" class="col-sm-2 col-form-label">Nilai</label> -->
            <div class="col-sm-10">
            <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewProses" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
                <th >Kode Pengadaan</th>
                <!-- <th >Jumlah Jenis Barang</th> -->
                <th >Total Harga</th>
                <th >Tanggal Pengadaan</th>
                <th >Supplier</th>

                <th >Status</th>
                <th >Aksi</th>


              </tr>
            </thead>

            <tbody>
              <?php

              include '../connection.php';

              $query = mysqli_query($con, 'SELECT a.*,b.nama_supplier suppliers FROM pengadaan_obat a join supplier b on a.id_supplier=b.id_supplier where status="Dipesan" OR status="Draft"');
             
              if (!$query) {
                die('Query Error: ' . mysqli_error($con));
            }
    
          
              while ($data = mysqli_fetch_array($query)) {  ?>

              <tr>
              <td><?php echo $data['kode']; ?></td>
                <!-- <td class="text-nowrap"><?php echo $data['jenis_produk']; ?></td> -->
                <td><?php echo $data['total_harga']; ?></td>
                <td><?php echo $data['tanggal']; ?></td>
                <td><?php echo $data['suppliers']; ?></td>



                <td><p class="bg-warning text-white text-center "><?php echo $data['status']; ?></p></td>

            
                <td align="center">
       
                <!-- <a class="btn text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Konfirmasi Pesanan"><i class="fas fa-check"></i></a> -->
                <!-- <a class="btn text-info" href="?page=stok_obat-edit&id=<?php echo $data['id']; ?>"><i
                      class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data"></i>
                  </a> -->
                  <a class="btn text-success" href="../pengadaan_obat/print2.php?id=<?php echo $data['id_pengadaan_obat']; ?>"
                    target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Surat Pemesanan"><i class="fas fa-print"></i>
                  </a>

                  <a class="btn text-danger" href="?page=pengadaan_obat-delete&id=<?php echo $data['id_pengadaan_obat']; ?>"
                    onclick="return confirm('Anda yakin mau menghapus item ini ?')" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data"><i class="fas fa-trash"></i>
                  </a>
                  

                  <a class="btn text-info" href="?page=pengadaan_obat-detail&id=<?php echo $data['id_pengadaan_obat']; ?>"
                    target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Data"><i class="fas fa-eye"></i>
                  </a>

            
                </td>
              </tr>

              <?php
              }
              ?>
            </tbody>
          </table>
        </div>


            </div>
          </div>
      </form>
      </div>


<!-- modal cek kesehatan-->
<div class="modal fade" id="myModalPenerimaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">

  <div class="modal-dialog">
    <div class="modal-content">
      <form id="inputForm">
        <div class="modal-header">
          <h5 class="modal-title">Input Data</h5>
          <button type="button" class="btn-close" data-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="idInput" name="id">
          <div class="form-group">
            <label for="inputValue">Input Nilai:</label>
            <input type="text" class="form-control" id="inputValue" name="inputValue" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>




<!-- -------- -->
<div class="modal fade" id="myModdal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Input Nilai</h5>
        <button type="button" class="btn-close" data-dismiss="modal"></button>
      </div>
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_GET['id'];

if (isset($_POST['submit'])) {
  $kode_penjualan_obat = $_POST['kode_penjualan_obat'];


$update = mysqli_query($con, "UPDATE stok_obat SET jumlah_stok_obat='$jumlah_stok_obat' WHERE id_stok_obat=$id_stok_obat");

}

?>

      
      <!-- Modal Body -->
      <div class="modal-body">
      <form method="POST">

        <!-- <p>Modal content goes here.</p> -->
        <div class="row mb-3">
            <label for="nilai" class="col-sm-2 col-form-label">Nilai</label>
            <div class="col-sm-10">
              <input name="nilai" type="number" class="form-control" id="nilai" required>
            </div>
          </div>
      </form>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>

    </div>
  </div>
</div>