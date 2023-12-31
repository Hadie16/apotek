<?php
$IK= $_SESSION['id_ttk'];
//error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// echo $IK;

if (isset($_POST['submit'])) {
  // $id_pengadaan_alkes = $_POST['id_pengadaan_alkes'];
  //penjualan_alkes
  $kode_penjualan_alkes = $_POST['kode_penjualan_alkes'];
  $tanggal_penjualan_alkes = $_POST['tanggal_penjualan_alkes'];
  $total_harga = $_POST['total_harga'];
  // $id_kasir = $_POST['id_kasir'];
  // $IK= $_SESSION['id_kasir'];
  $id_ttk =  $IK;


  $insert = mysqli_query($con, "INSERT INTO penjualan_alkes(kode_penjualan_alkes,tanggal_penjualan_alkes,total_harga,id_ttk) 
  VALUES('$kode_penjualan_alkes','$tanggal_penjualan_alkes','$total_harga','$id_ttk')");

if ($insert) {
  echo "<p>query berhasil<p/>";
} else {
  die('invalid Query : ' . mysqli_error($con));
}

 $firstTableID = mysqli_insert_id($con);


//kode tambahan
// Retrieve the posted data
$id_stok_alkes_array = $_POST['id_stok_alkes'];
$id_alkes_array = $_POST['id_alkes'];

$jumlah_detail_penjualan_alkes_array = $_POST['jumlah_detail_penjualan_alkes'];
$satuan_array = $_POST['satuan'];

$harga_detail_penjualan_alkes_array = $_POST['harga_detail_penjualan_alkes'];
$total_harga_detail_penjualan_alkes_array = $_POST['total_harga_detail_penjualan_alkes'];

//stok
$jumlah_stok_sisa_array = $_POST['jumlah_stok_sisa'];
$jumlah_stok_alkes_array = $_POST['jumlah_stok_alkes'];



// Perform the insert operation for each row
for ($i = 0; $i < count($id_stok_alkes_array); $i++) {
  // Get the values for the current row
  $id_stok_alkes = $id_stok_alkes_array[$i];
  $id_alkes = $id_alkes_array[$i];

  $jumlah_detail_penjualan_alkes = $jumlah_detail_penjualan_alkes_array[$i];
  $satuan = $satuan_array[$i];

  $harga_detail_penjualan_alkes = $harga_detail_penjualan_alkes_array[$i];
  $total_harga_detail_penjualan_alkes = $total_harga_detail_penjualan_alkes_array[$i];

  //stok
  $jumlah_stok_sisa= $jumlah_stok_sisa_array[$i];
  $jumlah_stok_alkes= $jumlah_stok_alkes_array[$i];



  // Perform the insert query using the current row values
  $insert_query = "INSERT INTO detail_penjualan_alkes (id_penjualan_alkes,id_stok_alkes,id_alkes, jumlah_detail_penjualan_alkes,satuan,harga_detail_penjualan_alkes,total_harga_detail_penjualan_alkes) 
                   VALUES (' $firstTableID','$id_stok_alkes','$id_alkes', '$jumlah_detail_penjualan_alkes','$satuan','$harga_detail_penjualan_alkes','$total_harga_detail_penjualan_alkes')";

  // Execute the insert query
  $result = mysqli_query($con, $insert_query);


$update = mysqli_query($con, "UPDATE stok_alkes SET jumlah_stok_alkes='$jumlah_stok_sisa' WHERE id_stok_alkes=$id_stok_alkes");


//log alkes keluar


// if ($insertLog) {
//   echo "<p>query berhasil<p/>";
// } else {
//   die('invalid Query : ' . mysqli_error($con));
// }


$dataQuery = "SELECT * FROM stok_alkes WHERE id_stok_alkes = $id_stok_alkes AND jumlah_stok_alkes > 0 GROUP BY tanggal_kadaluarsa_alkes";
$dataResult = mysqli_query($con, $dataQuery);

// Iterate over the data
while ($rowData = mysqli_fetch_assoc($dataResult)) {
  $availableStocks = $rowData['jumlah_stok_alkes'];

  // Calculate the quantity to deduct from available stocks
  $deductQuantity = min($jumlah_detail_penjualan_alkes, $availableStocks);

  // Update stocks in the current data row
  $newStocks = $availableStocks - $deductQuantity;
  $updateQuery = "UPDATE stok_alkes SET jumlah_stok_alkes = $newStocks WHERE id_stok_alkes = " . $rowData['id_stok_alkes'];
  mysqli_query($con, $updateQuery);

  // Subtract the deducted quantity from the remaining quantity
  $jumlah_detail_penjualan_alkes -= $deductQuantity;

  // Exit the loop if the remaining quantity is fulfilled
  if ($jumlah_detail_penjualan_alkes <= 0) {
    break;
  }
}
}
?>
<script>
   window.open('../penjualan_alkes/nota.php?id=<?php echo $firstTableID ?>','_blank');
  //  window.location.href = '../penjualan_alkes/nota.php?id=<?php echo $firstTableID ?>'

</script>


<?php }
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>
<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Penjualan Alkes</h6>

      </div>
      <div class="card-body">
        <form method="POST">

          <div class="row mb-3">
          <div class="col-sm-2 offset-sm-1 text-center">
          <img src="../assets/img/logo_mahabbah-removebg-preview.png" alt="Apotek Logo" width="80">
          <p style="color: #333;">Apotek Mahabbah</p>
        </div>
                      <div class="col-sm-5 offset-sm-2">
       
            <?php
    // Get the current year
    $year = date('Y');

    $query = mysqli_query($con, "SELECT kode_penjualan_alkes FROM penjualan_alkes ORDER BY kode_penjualan_alkes DESC LIMIT 1");
    
    if (mysqli_num_rows($query) > 0) {
      $row = mysqli_fetch_assoc($query);
      $lastKodeNumber = $row['kode_penjualan_alkes'];
      $lastKodeNumber = intval(substr($lastKodeNumber, 10)); // Extract the numeric part only
      $newKodeNumber = $lastKodeNumber + 1;
    } else {
      $newKodeNumber = 1;
    }
    
    $KodeNumber = 'PNJS-' . $year . '-' . str_pad($newKodeNumber, 4, '0', STR_PAD_LEFT);

    ?> 
        <label for="nim" class="col-sm-2 col-form-label">Kode</label>
<input type="text" name="kode_penjualan_alkes" required="required" class="form-control" value="<?php echo $KodeNumber ?>" readonly>



          
            <label for="nim" class="col-sm-4 col-form-label">Tanggal</label>
            <!-- <div class="col-sm-5"> -->
              <!-- <input name="nim" type="text" class="form-control" id="nim" value="Cash" readonly required> -->
              <input type="text" class="form-control" name="tanggal_penjualan_alkes" value="<?php echo date('Y-m-d h:i:s'); ?>" readonly>

            </div>
          </div>

          <hr>

          <div class="row mb-3">

          <table id="myTable2" class="table table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Produk</th>
                          <th>Qty</th>
                          <th>Satuan</th>

                          <th>Harga <span class="required">(Rp)</span></th>
                          <!-- <th>Tipe Diskon</th>
                          <th>Diskon</th> -->
                          <th>Sub Total <span class="required">(Rp)</span></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>
                          <select name="id_stok_alkes[]" id="id_stok_alkes_select" class="form-control select-optionPNJALK" required>
        <option value="">- Pilih -</option>
        <?php
          $query = mysqli_query($con, "SELECT t1.nama_alkes,t2.id_stok_alkes FROM alkes t1
          JOIN stok_alkes t2 ON t1.id_alkes = t2.id_alkes where t2.tanggal_kadaluarsa_alkes > CURDATE() and t2.jumlah_stok_alkes>0");
        // $query = mysqli_query($con, "SELECT id_alkes, nama_alkes FROM alkes");
        while ($row = mysqli_fetch_assoc($query)) {
            // $id_alkes1 = $row['id_alkes'];
            $id_stok_alkes2 = $row['id_stok_alkes'];

            $nama_alkes = $row['nama_alkes'];
            // $idd = 2;
            echo '<option value="' . $id_stok_alkes2 . '" >' . $nama_alkes . '</option>';
        }
        ?>
    </select>


    <input type="hidden" class="id_alkes" name="id_alkes[]" readonly>
                        </td>

                        <?php
        
      


        $query = mysqli_query($con, "SELECT jumlah_stok_alkes FROM stok_alkes");
        while ($row = mysqli_fetch_assoc($query)) {
      
            // $id_stok_alkes2 = $row['id_stok_alkes'];

            $jumlah_stok_alkes = $row['jumlah_stok_alkes'];
       
            // echo '<option value="' . $id_stok_alkes2 . '" >' . $nama_alkes . '</option>';
        }
        ?>



    

                          <td><input type="number" required="required" class="form-control qty-inputALK" name="jumlah_detail_penjualan_alkes[]" placeholder="Qty" oninput="checkStock(this)">
  <!-- <p align="center" class="stock-left jumlah_stok_alkes" >kk</p>                         -->
  Stok :<input type="text" class="col-form-control stock-left jumlah_stok_sisaALK border-0 text-secondary" name="jumlah_stok_sisa[]" readonly>
  <input type="hidden" class="stock-left jumlah_stok_alkesALK border-0" name="jumlah_stok_alkes[]" readonly>
      </td>
      <td> <input type="text" required="required" class="form-control satuan" name="satuan[]" readonly></td>


  <!-- <span class="stock-display">Stock: 11</span>         -->
                          <script>
  function checkStock(input) {
    var desiredQuantity = parseInt($(input).val());
    var stock = parseInt($('.stock-left').val());

    // var stockDisplay = $(input).siblings('.stock-display');
    // var stock = parseInt(stockDisplay.text().split(":")[1]);

    if (desiredQuantity <= stock) {
      // Sufficient stock available
      // var reducedStock = desiredQuantity - stock;
      // $('.stock-left').text(reducedStock);

      $(input).removeClass('insufficient-stock');
    } else {
      // Insufficient stock
      // var reducedStock = desiredQuantity - stock;
      // $('.stock-left').text(reducedStock);
      $(input).addClass('insufficient-stock');
    }
  }
</script>

<style>
  .insufficient-stock {
    border-color: red;
  }
</style>

                          <td><input type="text" class="form-control unit-price-input harga_jual_alkes" id="harga_jual_alkes" name="harga_detail_penjualan_alkes[]" placeholder="Harga" required readonly> </td>
                          <!-- <td>
                          <select class="form-control">
                            <option>Discount Type</option>
                            <option>fixed</option>
                          </select></td>
                          <td><input type="text" required="required" class="form-control" placeholder="Discount Price"></td> -->
                          <td><input type="text" required="required" class="form-control total-amount-input" name="total_harga_detail_penjualan_alkes[]" placeholder="0" readonly></td>
                          <td>
    <button class="btn btn-danger delete-row"><i class="fas fa-trash"></i></button>
  </td>
                        </tr>
                      </tbody>
                    </table>

                    </div>

                    <div class="row">

<div class="col ">
  <button id="addRowBtn1" class="btn btn-success"><i class="fas fa-plus"></i>
    Tambah</button>
    <!-- <button class="add-row-btn" data-row-id="1">Add Row</button> -->

</div>
</div>




<hr>

<div class="col-sm-10 ">

  <h1 align="center">Total (Rp)</h1>
          <!-- <div class="row mb-3"> -->
            <!-- <label for="jumlah_ketersediaan_alkes" class="col-sm-2 col-form-label">Jumlah</label> -->
            <!-- <div class="col-sm-5"> -->
              <div align="center">
               <input type="text" align="center" id="grandTotal" class="form-control" style="display: inline-block; width: 300px; height: 50px; font-size: 24px;" name="total_harga" readonly>   
              </div>

<br>

              <!-- <input type="number" class="form-control" id="jumlah_ketersediaan_alkes" name="jumlah_ketersediaan_alkes"> -->
            <!-- </div> -->
          <!-- </div> -->


       

          <div class="row">

            <div align="center" class="col">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=penjualan_alkes-show" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>

          </div>
        </form>
        </div>

      </div>
    </div>
  </div>
</div>