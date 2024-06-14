<?php
//error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// $IK= $_SESSION['id_ttk'];
$id = $_GET['id'];



if (isset($_POST['submit'])) {
  // $selectP = $_POST['selectP'];
  //retur_alkes
  $kode_retur_alkes = $_POST['kode_retur_alkes'];
  $tanggal_retur_alkes = $_POST['tanggal_retur_alkes'];
  $id_supplier = $_POST['id_supplier'];

  // $total_harga = $_POST['total_harga'];
  // $no_faktur = $_POST['no_faktur'];

  // $id_ttk = $_POST['id_ttk'];
  // $id_ttk = '2';
 
  $insert = mysqli_query($con, "UPDATE retur_alkes 
  SET kode_retur_alkes = '$kode_retur_alkes',id_supplier = '$id_supplier', tanggal_retur = '$tanggal_retur_alkes'
  WHERE id_retur_alkes = '$id'");


  if (!$insert) {
    die('Query Error: ' . mysqli_error($con));

}else{
  // echo 1;
}

  // $firstTableID = mysqli_insert_id($con);

  $id_detailPO_array = $_POST['id_alkes']; 
  $id_detailRO_array = $_POST['id_detailRO']; 

  // $id_alkes_array = $_POST['id_alkes'];
  $jumlah_array = $_POST['jumlah'];
  $satuan_array = $_POST['satuan'];
  $harga_beli_alkes_array = $_POST['harga_beli_alkes'];

  $batch_number_array = $_POST['batch_number'];
  $tanggal_exp_array = $_POST['tanggal_exp'];
  $tjmh_array = $_POST['tjmh'];



  // $id_ketersediaan_alkes_array = $_POST['id_ketersediaan_alkes'];
  $jumlah_stok_sisa_array = $_POST['jumlah_stok_sisa'];



  // Step 1: Connect to your database
// $servername = "your_servername";
// $username = "your_username";
// $password = "your_password";
// $dbname = "your_database";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// Step 2: Retrieve data from the database
$sqlRo = "SELECT id_detail_retur_alkes, batch_number FROM detail_retur_alkes where id_retur_alkes =". $id;
$resultRo = $con->query($sqlRo);

if ($resultRo->num_rows > 0) {
    $dbValues = array();
    $dbValuesBN = array();

    $dbValuesC = array();
    while ($row = $resultRo->fetch_assoc()) {
        $dbValues[] = $row['id_detail_retur_alkes'];
        $dbValuesBN[] = $row['batch_number'];

        $combinedValue = $row['id_detail_retur_alkes'] . "-" . $row['batch_number'];
      $dbValuesC[] = $combinedValue;
    }
} else {
    $dbValues = array();
    $dbValuesBN = array();

    $dbValuesC = array();
}

// Step 3: Compare the values
$nonMatchingNumbers = array_diff($dbValues, $id_detailRO_array);
$nonMatchingNumbersBN = array_diff($dbValuesBN, $batch_number_array);


// Step 4: Delete values in the database based on non-matching numbers
foreach ($nonMatchingNumbersBN as $nonMatchingNumber) {
  // Select id_alkes and batch_number from detail_retur_alkes
  $sqlRo2 = "SELECT id_alkes, jumlah, batch_number FROM detail_retur_alkes WHERE batch_number = '" . $nonMatchingNumber . "' and id_retur_alkes = " . $id;

  $result = $con->query($sqlRo2);

  if ($result->num_rows > 0) {
      // Fetch the data from the result
      $row = $result->fetch_assoc();
      $id_alkes_up = $row['id_alkes'];
      $batch_number_up = $row['batch_number'];
      $jumlah_up = $row['jumlah'];


      // Now you have the id_alkes and batch_number as variables
      // You can use them to select data from other tables
      // $sqlOtherTable = "SELECT * FROM ketersediaan_alkes WHERE id_alkes = '" . $id_alkes . "' AND batch_number ='".$batch_number."' ";
      $sqlOtherTable = "SELECT * FROM ketersediaan_alkes WHERE  batch_number = '" . $batch_number_up . "'";

      $resultOtherTable = $con->query($sqlOtherTable);

      // Process data from the other_table
      if ($resultOtherTable->num_rows > 0) {
          while ($rowOtherTable = $resultOtherTable->fetch_assoc()) {
              // Access data from the other_table
              $box_up = $rowOtherTable['box'];
              $jumlah_isi_up = $rowOtherTable['jumlah_ketersediaan_alkes'];

              // $otherIdalkes = $id_alkes_up;
              $otherBatchNumber = $batch_number_up; // Use the batch_number from detail_retur_alkes
              $otherJumlahUp = $jumlah_up;


              $jumlah_stok_box_result_up="";
              $jumlah_stok_sisa_result_up="";
              if($box_up==0){
                $jumlah_stok_box_result_up=0;
                $jumlah_stok_sisa_result_up=$otherJumlahUp + $jumlah_isi_up;
              }else{
                $jumlah_stok_box_result_up=intval($otherJumlahUp) + intval($box_up);
                $jumlah_bagi_up = (int)$jumlah_isi_up / (int)$box_up;
                $jumlah_stok_sisa_result_up=(int)$jumlah_stok_box_result_up * (int)$jumlah_bagi_up;
              }
              // Do something with the data
                // == update ketersediaan == mengembalikan angka seperti semula == tidak jadi retur
       $update = mysqli_query($con, "UPDATE ketersediaan_alkes SET box='$jumlah_stok_box_result_up', jumlah_ketersediaan_alkes='$jumlah_stok_sisa_result_up' WHERE batch_number='$otherBatchNumber'");
       // echo "ini dia angkanya".$nonMatchingNumber;
          }
      } else {
          // Handle the case where no matching records were found in other_table
      }

foreach ($nonMatchingNumbers as $nonMatchingNumberID) {

  $sqlRos = "SELECT batch_number FROM detail_retur_alkes WHERE id_detail_retur_alkes = '" . $nonMatchingNumberID . "' and id_retur_alkes = ". $id;

  $resultD = $con->query($sqlRos);

  if ($resultD->num_rows > 0) {
    $sqlRo = "DELETE FROM detail_retur_alkes WHERE id_detail_retur_alkes = '" . $nonMatchingNumberID . "' and id_retur_alkes = ". $id;

    $con->query($sqlRo);
      // if ($con->query($sqlRo) === TRUE) {
        echo "Record with ID " . $nonMatchingNumberID . " successfully deleted.<br>";
    } else {
        // echo "Error deleting record: " . $con->error . "<br>";
        
    }

    }
  } else {
      // Handle the case where no matching record was found in detail_retur_alkes
  }
}


     
// Close the database connection
// $conn->close();

  // Perform the insert operation for each row
  for ($i = 0; $i < count($id_detailPO_array); $i++) {
    // Get the values for the current row
    $id_detailPO = $id_detailPO_array[$i];   
    $id_detailRO = $id_detailRO_array[$i];   

    //  $id_alkes = $id_alkes_array[$i];
    $jumlah = $jumlah_array[$i];

    $satuan = $satuan_array[$i];
    $harga_beli_alkes = $harga_beli_alkes_array[$i];

    $batch_number = $batch_number_array[$i];
    $tanggal_exp = $tanggal_exp_array[$i];
 


    // $harga = $harga_array[$i];
    // $sub_total = $sub_total_array[$i];

  //  $boxsatuan= $boxsatuan_array[$i];
     $tjmh= $tjmh_array[$i];
  
  //    $hargaKet= $hargaKet_array[$i];


  if ($id_detailRO==!0) {
  $insert_query = "UPDATE detail_retur_alkes SET id_retur_alkes = '$id',id_alkes = '$id_detailPO',jumlah = '$jumlah', satuan = '$satuan', batch_number = '$batch_number', tanggal_kadaluarsa = '$tanggal_exp'
  WHERE id_detail_retur_alkes = '$id_detailRO'";
     // Execute the insert query
     $result = mysqli_query($con, $insert_query);
     if ($result) {
      //  echo "<p>query update RO berhasil<p/>";
     } else {
       die('invalid Query : ' . mysqli_error($con));
     }
  }else{
    // Perform the insert query using the current row values
    $insert_query = "INSERT INTO detail_retur_alkes (id_retur_alkes,id_alkes,jumlah,satuan,batch_number,tanggal_kadaluarsa,value) 
                   VALUES ('$id','$id_detailPO','$jumlah','$satuan','$batch_number','$tanggal_exp','$harga_beli_alkes')";
                      // Execute the insert query
                      // echo var_dump($insert_query);
    $result = mysqli_query($con, $insert_query);
    if ($result) {
      // echo "<p>query insert RO berhasil<p/>";
      
    } else {
      
      die('invalid Query : ' . mysqli_error($con));
    }
  }
 
    // $firstTableIDretur = mysqli_insert_id($con);

//========update ketersediaan alkes==========

//  $id_ketersediaan_alkes = $id_ketersediaan_alkes_array[$i];
 $jumlah_stok_sisa = $jumlah_stok_sisa_array[$i];


$select = mysqli_query($con, "SELECT box,jumlah_ketersediaan_alkes FROM ketersediaan_alkes WHERE id_alkes='$id_detailPO' and batch_number='$batch_number'");
while ($row = mysqli_fetch_assoc($select)) {
  $box = $row['box'];
  $jumlah_ko = $row['jumlah_ketersediaan_alkes'];
};
if ($select) {
  // echo "<p>query select berhasil<p/>";
} else {
  die('invalid Query : ' . mysqli_error($con));
}

$jumlah_stok_box_result="";
$jumlah_stok_sisa_result="";
if($box == 0){
  $jumlah_stok_box_result = 0;
  $jumlah_hasil = (int)$tjmh - (int)$jumlah;
  $jumlah_stok_sisa_result = $jumlah_hasil;

}else{
  $jumlah_hasil_box = $tjmh - $jumlah;
  $jumlah_stok_box_result = $jumlah_hasil_box;

  $jumlah_isi_perbox = $jumlah_ko / $box;
  $jumlah_pengurangan_ketersediaan = $jumlah_isi_perbox * $jumlah;
  $jumlah_dasar_ketersediaan = $jumlah_isi_perbox * $tjmh;
  $jumlah_hasil = $jumlah_dasar_ketersediaan - $jumlah_pengurangan_ketersediaan;
  $jumlah_stok_sisa_result = $jumlah_hasil;
  // echo "jumlah_stok_box_result: $jumlah_stok_box_result<br>";
  // echo "jumlah_isi_perbox: $jumlah_isi_perbox<br>";
  // echo "jumlah_pengurangan_ketersediaan: $jumlah_pengurangan_ketersediaan<br>";
  // echo "jumlah_stok_sisa_result: $jumlah_stok_sisa_result<br>";
  
}


    $update = mysqli_query($con, "UPDATE ketersediaan_alkes SET box='$jumlah_stok_box_result', jumlah_ketersediaan_alkes='$jumlah_stok_sisa_result' WHERE id_alkes=$id_detailPO and batch_number='$batch_number'");

if ($update) {
  // echo "<p>query berhasil<p/>";
  echo "<script>window.location.href = '?page=retur_alkes-show';</script>";

} else {
  die('invalid Query : ' . mysqli_error($con));
}


  }
}
//=============fetch data====================


// Connect to your database (you should have a database connection script)
// require_once('db_connection.php'); // Replace with your actual database connection script

// $id = $_GET['id'];

$query1 = "SELECT * FROM retur_alkes a join detail_retur_alkes b on a.id_retur_alkes=b.id_retur_alkes where a.id_retur_alkes=$id";

$result1 = mysqli_query($con, $query1);

while ($data_1 = mysqli_fetch_assoc($result1)) {
$id_supplier = $data_1['id_supplier'];
$kode = $data_1['kode_retur_alkes'];
$tanggal_retur = $data_1['tanggal_retur'];
}

// Query to retrieve data from the database (adjust SQL query accordingly)
$query = "SELECT * FROM retur_alkes a join detail_retur_alkes b on a.id_retur_alkes=b.id_retur_alkes where a.id_retur_alkes=$id";
// $query = "SELECT * FROM detail_retur_alkes a where a.id_retur_alkes=$id";

$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die("Database query failed: " . mysqli_error($con));
}



?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>
<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Retur Alkes</h6>

      </div>
      <div class="card-body">
 
        <form method="POST">

          <div class="row mb-3">
          <div class="col-sm-2 offset-sm-1 text-center">
    <img src="../assets/img/logo_mahabbah-removebg-preview.png" alt="Apotek Logo" width="80">
    <p style="color: #333;">Apotek Mahabbah</p>
  </div>
            <div class="col-sm-5 offset-sm-2">
              <label for="nim" class="col-sm-2 col-form-label">Kode</label>

              <?php
    // Get the current year
    $year = date('Y');

    // $query = mysqli_query($con, "SELECT kode_retur_alkes FROM retur_alkes ORDER BY kode_retur_alkes DESC LIMIT 1");
    
    // if (mysqli_num_rows($query) > 0) {
    //   $row = mysqli_fetch_assoc($query);
    //   $lastKodeNumber = $row['kode_retur_alkes'];
    //   $lastKodeNumber = intval(substr($lastKodeNumber, 9)); // Extract the numeric part only
    //   $newKodeNumber = $lastKodeNumber + 1;
    // } else {
    //   $newKodeNumber = 1;
    // }
    
    // $KodeNumber = 'RET-' . $year . '-' . str_pad($newKodeNumber, 4, '0', STR_PAD_LEFT);
          ?>
              <input type="text" name="kode_retur_alkes" required="required" class="form-control" value="<?php echo $kode?>" readonly>
        


              <label for="nim" class="col-sm-4 col-form-label">Tanggal Retur</label>
              <!-- <div class="col-sm-5"> -->
              <!-- <input name="nim" type="text" class="form-control" id="nim" value="Cash" readonly required> -->
              <input type="text" class="form-control" name="tanggal_retur_alkes" value="<?php echo $tanggal_retur ?>" readonly>

              <!-- <form method="POST"> -->

                <!-- <label for="nim" class="col-sm-8 col-form-label">No Faktur</label>
                <input type="hidden" class="form-control" name="id_pengadaan_alkes" value="<?php echo $varP; ?>" readonly>

                <input type="text" class="form-control" name="no_faktur"  placeholder="Nomer Faktur" required> -->
                   <label for="nim" class="col-sm-8 col-form-label">Supplier</label>
                <select  name="id_supplier" id="" class="form-control" required>
                      <option value="">- Pilih -</option>
                      <?php

                      $query = mysqli_query($con, "SELECT * FROM supplier");
        
                      while ($row = mysqli_fetch_assoc($query)) {
                        $id_alkes1 = $row['id_supplier'];
                        // $id_D = $row['id_ketersediaan_alkes'];
                        $nama = $row['nama_supplier'];

                        if ($id_supplier == $id_alkes1) {
                          $select = "selected";
                      } else {
                          $select = "";
                      }
                        // $kode_retur_alkes = $row['kode_retur_alkes'];
                        // $idd = 2;
                        echo '<option value="' . $id_alkes1 . '"'.$select.' >' . $nama . '</option>';
                      }

                      ?>
                    </select>
                <!-- <button type="submit" class="btn btn-primary" name="submit2"><i class="fas fa-plane"></i>
                  Go</button> -->
              <!-- </form> -->

            </div>
          </div>

          <hr>

          <div class="row mb-3">

            <table id="myTableRETS" class="table table-bordered" style="width:100%">
              <thead>
                <tr align="center">
                  <th>#</th>
                  <th>Produk</th>
                  <th>Qty</th>
                  <th>Satuan</th>
                 
                  <th>Batch Number</th>
                  <th>Exp. Date</th>
                  <!-- <th>Harga <span class="required">(Rp)</span></th> -->
                  <!-- <th>Tipe Diskon</th>
                          <th>Diskon</th> -->
                  <!-- <th>Total Harga <span class="required">(Rp)</span></th> -->


                </tr>
              </thead>
              <tbody>
              <?php
              // Loop through the database results and populate rows
            //   echo 'jojo';
            $no=1;
        while ($data = mysqli_fetch_assoc($result)) {
echo '<tr>';

echo '<td>'.$no++.'</td>';
echo '<td width="15%">';
echo '<select id="select-option-retur" name="id_detailPO[]" id="" class="form-control select-option-retur" required>';
echo '<option value="">- Pilih -</option>';

$query = mysqli_query($con, "SELECT a.*,b.nama_alkes nama FROM ketersediaan_alkes a join alkes b on a.id_alkes=b.id_alkes order by nama");
if (!$query) {
    die("Database query failed: " . mysqli_error($con));
}else{
    echo 'jj';
}

while ($row = mysqli_fetch_assoc($query)) {
    $id_alkes1 = $row['batch_number'];
    $nama = $row['nama'];
    $id_kett = $row['id_ketersediaan_alkes'];


    if ($data['batch_number'] == $id_alkes1) {
        $select = "selected";
    } else {
        $select = "";
    }

    echo '<option value="' . $id_kett . '" '.$select.' data-trigger="change">' . $nama . ' - ' . $id_alkes1 . '</option>';
}

echo '</select>';
echo '<input type="hidden" class="id_alkes" name="id_alkes[]"  id="id_alkes">';

// hehe
echo '<input type="hidden" class="form-control id_detailRO" value="' . $data['id_detail_retur_alkes'] . '" name="id_detailRO[]">';


echo '<p class="text-center mb-0">-</p>';
echo '<label  class="col-form-label">Stok Gudang</label>';
echo '</td>';
echo '<td width="9%"><input type="number"  class="form-control qty-inputs jumlahALK" value="' . $data['jumlah'] . '" name="jumlah[]" placeholder="Qty">';
// echo '<input type="number" class="form-control jumlah_tambah" name="idsads[]">';

echo '<p class="text-center mb-0">-</p>';
// hehe
echo '<input type="hidden" class="form-control jumlah_stok_sisa_hitung" name="tjmh[]">';
echo '<input type="text" class="form-control jumlah_stok_sisa border-0 text-secondary" name="jumlah_stok_sisa[]" readonly>';
echo '</td>';
echo '<td width="10%"><input type="text" class="form-control unit-price-input satuanALK"  id="satuan" name="satuan[]" placeholder="Satuan" readonly required>';
echo'<input type="hidden" class="form-control harga_beli_alkes" name="harga_beli_alkes[]">';

echo '<p class="text-center mb-0">-</p>';
echo '<input type="text" class="form-control satuanALK border-0 text-secondary" name="jumlah_stok_sisa[]" readonly>';
echo '</td>';
echo '<td width="20%"><input name="batch_number[]" id="BNRetur" class="form-control BNRetur_retur" readonly required>';

echo '<td><input type="date" class="form-control tanggal_exps" name="tanggal_exp[]" id="tanggal_exps" required readonly></td>';
echo '<td>';
echo '<button class="btn btn-danger delete-rowRET"><i class="fas fa-trash"></i></button>';
echo '</td>';
echo '</tr>';
        }
?>


              </tbody>
            </table>

          </div>

          <div class="row">

            <div class="col ">
              <button id="addRowBtnRET" class="btn btn-success"><i class="fas fa-plus"></i>
                Tambah</button>
              <!-- <button class="add-row-btn" data-row-id="1">Add Row</button> -->

            </div>
          </div>




          <hr>




            <div class="row">

              <div align="center" class="col">
                <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i>Simpan</button>
                <a href="?page=retur_alkes-show" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                  Kembali</a>
              </div>

            </div>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- </div>
</div> -->
