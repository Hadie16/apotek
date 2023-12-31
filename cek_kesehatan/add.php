<?php
//error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$IK= $_SESSION['id_ttk'];


if(isset($_GET['id1'])){
  $var1 = $_GET['id1'];
$var2 = $_GET['id2'];
$var3 = $_GET['id3'];
$var4 = $_GET['id4'];
$var5 = $_GET['id5'];
$var6 = $_GET['id6'];
}else{
  $var1 = '';
  $var2 = '';
  $var3 = '';
  $var4 = '';
  $var5 = '';
  $var6 = '';
}

if (isset($_POST['submit'])) {
  // $id_pengadaan_obat = $_POST['id_pengadaan_obat'];
  //penjualan_obat
  $id_ttk =  $IK;
  $kode_cek_kesehatan = $_POST['kode_cek_kesehatan'];
  $tanggal_cek_kesehatan = $_POST['tanggal_cek_kesehatan'];
  // $status = $_POST['status'];
  $status = "Proses";

  $total_biaya = $_POST['total_biaya'];

  $catatan ="-";

  if (isset($_POST['catatan'])) {
    // If $_POST['catatan'] is not empty, use the value from the form
    $catatan = $_POST['catatan'];
} else {
    // If $_POST['catatan'] is empty, set a default value
    $catatan = "#";
}

 
  // $id_kasir = '2';

  //pasien
  $firstTableID1 = '';
  if(!empty($_POST['id_pasien'])){
    $firstTableID1 = $_POST['id_pasien'];
  }else{
    $nama_pasien = $_POST['nama_pasien'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat_pasien = $_POST['alamat_pasien'];
    $no_telepon = $_POST['no_telepon'];


    $year = date('Y');

    $query = mysqli_query($con, "SELECT kode_pasien FROM pasien ORDER BY kode_pasien DESC LIMIT 1");
    
    if (mysqli_num_rows($query) > 0) {
      $row = mysqli_fetch_assoc($query);
      $lastKodeNumberPasien = $row['kode_pasien'];
      $lastKodeNumberPasien = intval(substr($lastKodeNumberPasien, 9)); // Extract the numeric part only
      $newKodeNumberPasien = $lastKodeNumberPasien + 1;
    } else {
      $newKodeNumberPasien = 1;
    }
    
    $KodeNumberPasien = 'PSN-' . $year . '-' . str_pad($newKodeNumberPasien, 4, '0', STR_PAD_LEFT);
  
  
    $insert1 = mysqli_query($con, "INSERT INTO pasien(kode_pasien,nama_pasien,jenis_kelamin,tanggal_lahir,alamat_pasien,no_telepon) 
    VALUES('$KodeNumberPasien','$nama_pasien','$jenis_kelamin ','$tanggal_lahir','$alamat_pasien','$no_telepon')");
 
    $firstTableID1 = mysqli_insert_id($con);
  }



  $insert = mysqli_query($con, "INSERT INTO cek_kesehatan(kode_cek_kesehatan,id_pasien,tanggal_cek_kesehatan,status,total_biaya,catatan,id_ttk) 
  VALUES('$kode_cek_kesehatan','$firstTableID1 ','$tanggal_cek_kesehatan','$status','$total_biaya','$catatan','$id_ttk')");
 if ($insert) {
  echo "<p>query berhasil<p/>";
} else {
  die('invalid Query : ' . mysqli_error($con));
}
 $firstTableID = mysqli_insert_id($con);

 
 // Assuming you have established the database connection using mysqli
 
 // Check if the form is submitted
//  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Check if at least one checkbox is checked
  //  if (isset($_POST['checkbox1']) || isset($_POST['checkbox2']) || isset($_POST['checkbox3'])) {
     // Prepare the insert statement
     $stmt = $con->prepare("INSERT INTO detail_cek_kesehatan (id_cek_kesehatan,id_kategori,nilai,biaya) VALUES (?,?,?,?)");
 
     // Bind and execute the statement for each checked checkbox
     if (isset($_POST['checkbox1'])) {
      $nilai = 3.14;
       $stmt->bind_param("iidd", $firstTableID, $_POST['checkbox1'], $nilai, $_POST['biaya1']);
       $stmt->execute();
     }
     if (isset($_POST['checkbox2'])) {
      $nilai = 3.14;
       $stmt->bind_param("iidd", $firstTableID, $_POST['checkbox2'], $nilai, $_POST['biaya2']);
       $stmt->execute();
     }
     if (isset($_POST['checkbox3'])) {
      $nilai = 3.14;
       $stmt->bind_param("iidd", $firstTableID, $_POST['checkbox3'], $nilai, $_POST['biaya3']);
       $stmt->execute();
     }
   
 
     // Close the statement
     $stmt->close();
 
     // Close the database connection
     $con->close();
 
  
     echo "<script>window.location.href = '?page=cek_kesehatan-show';</script>";
     // Redirect or show a success message
     // ...
  //  } else {
  //    // No checkbox is checked, handle the case
  //    // ...
 
      
  
  //  }
//  }
 
 


  // if ($update) {
    // echo "<script>window.location.href = '?page=history-show';</script>";
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
        <h6 class="m-0 font-weight-bold text-info">Cek Kesehatan</h6>

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

    $query = mysqli_query($con, "SELECT kode_cek_kesehatan FROM cek_kesehatan ORDER BY kode_cek_kesehatan DESC LIMIT 1");
    
    if (mysqli_num_rows($query) > 0) {
      $row = mysqli_fetch_assoc($query);
      $lastKodeNumber = $row['kode_cek_kesehatan'];
      $lastKodeNumber = intval(substr($lastKodeNumber, 9)); // Extract the numeric part only
      $newKodeNumber = $lastKodeNumber + 1;
    } else {
      $newKodeNumber = 1;
    }
    
    $KodeNumber = 'CKS-' . $year . '-' . str_pad($newKodeNumber, 4, '0', STR_PAD_LEFT);
    

echo '<input type="text" name="kode_cek_kesehatan" required="required" class="form-control" value="' . $KodeNumber . '" readonly>';
?>

          
            <label for="nim" class="col-sm-4 col-form-label">Tanggal</label>
            <!-- <div class="col-sm-5"> -->
              <!-- <input name="nim" type="text" class="form-control" id="nim" value="Cash" readonly required> -->
              <input type="text" class="form-control" name="tanggal_cek_kesehatan" value="<?php echo date('Y-m-d'); ?>" readonly>

            </div>
          </div>

          <hr>
          <div class="container">

  <div class="text-center">
    <span class="line-text m-0 font-weight-bold text-info">Data Diri</span>
  </div>
</div>
<hr>

          <div class="row mb-3">
            <label for="nama_pasien" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">

              <div class="input-group">
              <input name="id_pasien" type="hidden" class="form-control" id="id_pasien" value="<?php echo $var1 ?>" >
              <input name="nama_pasien" type="text" class="form-control" id="nama_pasien" value="<?php echo $var2 ?>" required>

          

            <div class="input-group-append">
            <button type="button" href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModalPasien" ><i class="fas fa-eye"></i> </button>
            </div>
            </div>
            </div>
          </div>

     

          <div class="row mb-3">
            <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-10">
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" name="jenis_kelamin" required>
                <option value="" selected disabled>- Pilih -</option>
  <option value="Laki-laki" <?php if ($var3 == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
  <option value="Perempuan" <?php if ($var3 == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-8">
              <input name="tanggal_lahir" type="date" class="form-control" id="tanggal_lahir" value="<?php echo $var5 ?>"  required onchange="calculateAge()">
            </div>
            <?php
// Assuming $data['tanggal_lahir'] contains the date of birth in the format 'Y-m-d'
$birthDate = $var5;
$today = new DateTime(); // Current date

// Create a DateTime object from the birth date
$birthdateObj = new DateTime($birthDate);

// Calculate the difference between the birth date and the current date
$interval = $birthdateObj->diff($today);

// Get the age from the interval
$age = $interval->y;
$ages = $age." Tahun";
?>
          <label for="age" class="col-form-label">Usia:</label>
             
              <div class="col-sm-1">

              <!-- <label for="age">Age:</label> -->
<input type="text" style="width: 100px;" class="form-control"  id="age" value="<?php echo $ages ?>" readonly>

            </div>
          </div>


<script>
    function calculateAge() {
  var birthdateInput = document.getElementById('tanggal_lahir');
  var ageInput = document.getElementById('age');

  var birthdate = new Date(birthdateInput.value);
  var today = new Date();

  // Calculate the age
  var age = today.getFullYear() - birthdate.getFullYear();

  // Check if the birthday hasn't occurred yet this year
  if (today.getMonth() < birthdate.getMonth() || (today.getMonth() === birthdate.getMonth() && today.getDate() < birthdate.getDate())) {
    age--;
  }
var year = " Tahun";
  // Set the age value
  ageInput.value = age + year;
}

</script>

<!-- <button type="button" id="powerButton" class="btn btn-primary power-button">Power</button>
<script>
    $('#powerButton').on('click', function() {
  $(this).toggleClass('active');
});

</script> -->

          <div class="row mb-3">
            <label for="alamat_pasien" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
              <input name="alamat_pasien" type="text" class="form-control" id="alamat_pasien" value="<?php echo $var4 ?>"  required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="no_telepon" class="col-sm-2 col-form-label">No HP</label>
            <div class="col-sm-10">
              <input name="no_telepon" type="text" class="form-control" id="no_telepon" value="<?php echo $var6 ?>" required>
            </div>
          </div>


          <hr>

          <div class="container">

  <div class="text-center">
    <span class="line-text m-0 font-weight-bold text-info">Layanan</span>
  </div>
</div>
<hr>


          <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->





    <!-- <button type="button" id="powerButton" class="btn btn-primary power-button">Power</button> -->
   

    <div class="row mb-3 justify-content-center">
  <div class="col-sm-2">
    <input type="checkbox" class="form-check-input" id="checklist">
    <label class="form-check-label" for="checklist">Cek Gula Darah</label>
  </div>
  <div class="col-sm-2">
    <input type="text" id="targetField" class="form-control" name="biaya1" readonly>
    <input type="hidden" id="targetFieldID" class="form-control" name="checkbox1" readonly>
  </div>
</div>



<div id="catatan" style="display:none">
<div class="row mb-3 justify-content-center" >
  <div class="col-sm-2">
    <label class="form-check-label" for="catatan">Catatan</label>
  </div>
  <div class="col-sm-2">
  <select name="catatan" id="" class="form-control" required>
        <option value="-">- Pilih -</option>
        <option value="Puasa">Puasa</option>
        <option value="2 Jam sesudah makan">2 Jam sesudah makan</option>
        <option value="Acak">Acak</option>
    </select>
  </div>
</div>
</div>



<div class="row mb-3 justify-content-center">
  <div class="col-sm-2">
    <input type="checkbox" class="form-check-input" id="checklist2">
    <label class="form-check-label" for="checklist2">Cek Asam Urat</label>
  </div>
  <div class="col-sm-2">
    <input type="text" id="targetField2" class="form-control" name="biaya2" readonly>
    <input type="hidden" id="targetFieldID2" class="form-control" name="checkbox2" readonly>
  </div>
</div>


<div class="row mb-3 justify-content-center">
  <div class="col-sm-2">
    <input type="checkbox" class="form-check-input" id="checklist3">
    <label class="form-check-label" for="checklist3">Cek Kolesterol</label>
  </div>
  <div class="col-sm-2">
    <input type="text" id="targetField3" class="form-control" name="biaya3" readonly>
    <input type="hidden" id="targetFieldID3" class="form-control" name="checkbox3" readonly>
  </div>
</div>




     

<hr>


    <div class="col-sm-10">

  <h1 align="center">Total Biaya</h1>
          <!-- <div class="row mb-3"> -->
            <!-- <label for="jumlah_ketersediaan_obat" class="col-sm-2 col-form-label">Jumlah</label> -->
            <!-- <div class="col-sm-5"> -->
              <div align="center">
                <input type="hidden" name="total_biaya" id="sumField">
               <input type="text" align="center" id="sumFieldDisplay" class="form-control" style="display: inline-block; width: 300px; height: 50px; font-size: 24px;" name="total_biayaDisplay" readonly>   
              </div>

  <br>

              <!-- <input type="number" class="form-control" id="jumlah_ketersediaan_obat" name="jumlah_ketersediaan_obat"> -->
            <!-- </div> -->
          <!-- </div> -->

          <div class="row">

            <div align="center" class="col">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-check"></i>
                Submit</button>
              <!-- <a href="?page=penjualan_obat-show" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a> -->
            </div>

          </div>
        </form>
        </div>

      </div>
    </div>
  </div>
</div>





<!-- modal penerimaan-->
<div class="modal fade" id="myModalPasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog modal-lg" role="document">
  <!-- <div class="modal-dialog"> -->
    <div class="modal-content">
      <form id="inputForm">
        <div class="modal-header">
          <h5 class="modal-title">Pilih Nama Pasien</h5>
          <button type="button" class="btn-close" data-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="idInput" name="id">
          <div class="form-group">
            <!-- <label for="inputValue">Input Nilai:</label>
            <input type="text" class="form-control" id="inputValue" name="inputValue" required> -->
         
            <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewModalCK" style="width: 100%;">
            <thead class="bg-secondary text-white" >
            <?php

include '../connection.php';

$query = mysqli_query($con, 'SELECT * FROM pasien');
//   if (!$query) {
//     die('Query Error: ' . mysqli_error($con));
// }
$mnr=mysqli_num_rows($query);
if ($mnr>0) {?>
              <!-- <thead> -->
              <tr align="center">
              <th >No</th>

              <th >Nama Pasien</th>
                <th >Jenis Kelamin</th>
                <th >Alamat</th>
                <th >Tanggal Lahir</th>
                <th >Telepon</th>
         
                <th >Aksi</th>
              </tr>
            </thead>

            <tbody>
         
             
              <?php
              $no=1;
              while ($data = mysqli_fetch_array($query)) {  ?>

              <tr>
              <td><?php echo $no++; ?></td>

              <td><?php echo $data['nama_pasien']; ?></td>
                <td><?php echo $data['jenis_kelamin']; ?></td>

                <td class="text-nowrap"><?php echo $data['alamat_pasien']; ?></td>
                <td><?php echo $data['tanggal_lahir']?></td>
                <td><?php echo $data['no_telepon']; ?></td>
                
               
            
                <td>
                <a class="btn bg-info text-white" href="?page=cek_kesehatan-add&id1=<?php echo $data['id_pasien']; ?>&id2=<?php echo $data['nama_pasien']; ?>&id3=<?php echo $data['jenis_kelamin']; ?>&id4=<?php echo $data['alamat_pasien']; ?>&id5=<?php echo $data['tanggal_lahir']; ?>&id6=<?php echo $data['no_telepon']; ?>">Pilih</a>

            
                </td>
              </tr>
              
              <?php
              }

            }else{
        
              
              echo "<tr><td style='width:100%'><h1> DATA NOT FOUND </h1></td></tr>";
              
              
       }
              ?>
            </tbody>
          </table>
          </div>
          </div>
        </div>
        <div class="modal-footer">
          <!-- <button type="submit" class="btn btn-primary">Save</button> -->
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </form>
    <!-- </div> -->
  </div>
  </div>

</div>



