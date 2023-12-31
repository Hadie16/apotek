<?php
include '../connection.php';
$id = $_GET['id'];
$result = mysqli_query($con, "SELECT a.*, b.*,c.* FROM cek_kesehatan a JOIN pasien b ON a.id_pasien = b.id_pasien join detail_cek_kesehatan c on a.id_cek_kesehatan=c.id_cek_kesehatan WHERE a.id_cek_kesehatan = $id");

// Check if there are rows in the result
if (mysqli_num_rows($result) > 0) {
  // Fetch the first row
  $data = mysqli_fetch_assoc($result);
  
  // Assuming $birthDate contains the birth date in "Y-m-d" format
  $birthDate = $data['tanggal_lahir'];

  // Create a DateTime object for the birth date
  $birthDateTime = new DateTime($birthDate);

  // Create a DateTime object for the current date (today)
  $currentDateTime = new DateTime();

  // Calculate the difference between the current date and the birth date
  $dateInterval = $currentDateTime->diff($birthDateTime);

  // Get the difference in years from the date interval
  $age = $dateInterval->y;

  // Output the calculated age
  // echo "Age: " . $age . " years";
 $nama =$data['nama_pasien'];
  
 $jk= $data['jenis_kelamin'];
 $tgl_cek= $data['tanggal_cek_kesehatan']; 
 $nilai= $data['nilai']; 
 $catatan= $data['catatan']; 





} else {
  // Handle the case when no data is found
  echo "No data found.";
}
?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>Kartu Hasil Pemeriksaan</title>
    <style>
* {
  font-family: Arial, Helvetica, sans-serif;
}

/* table {
  border-collapse: collapse;
  border-color: black;
} */
#invoice {
  font-family: Arial, sans-serif;
}

.header {
  display: flex;
  align-items: center;
}

.logo {
  flex: 0 0 auto;
  margin-right: 20px;
}

.logo img {
  max-width: 100px; /* Adjust the max width as needed */
  height: auto;
}

.header-text {
  flex: 1 1 auto;
}

.header h2,
.header p {
  text-align: left;
}

.header-line {
  border: none;
  border-top: 1px solid black;
  margin-top: 10px;
}
</style>
<style>
            body { font-family: Arial, sans-serif; }
            table { border-collapse: collapse; width: 100%; }
            th, td { border: 1px solid black; padding: 5px; }
          </style>
              <!-- <h2>Apotek Mahabbah</h2>
    <p>Jalan Makam RT.006/RW.003 Pasayangan Selatan Kecamatan Martapura</p>
    <p>(0823) 58813379</p> -->
  </head>
  <body>
  <div id="invoice">

<div class="header">
    <div class="logo">
      <img src="../assets/img/logo_mahabbah-removebg-preview.png" alt="Logo">
    </div>
    <div class="header-text">
      <h2>Apotek Mahabbah</h2>
      <p>Jalan Makam RT.006/RW.003 Pasayangan Selatan Kecamatan Martapura</p>
      <p>(0823) 58813379</p>
    </div>
  </div>
  <hr class="header-line">

    <h2 align="center">Hasil Pemeriksaan</h2>
    <p>Nama: <?php echo $nama; ?></p>
    <p>Umur: <?php echo $age; ?></p>
    <p>Jenis Kelamin: <?php echo $jk; ?></p>
    <p>Tanggal Periksa: <?php echo date("d-m-Y", strtotime($tgl_cek)) ?></p>




    <div class="table-responsive mt-3">

  <table border="1" cellspacing="0" cellpadding="5">
    <thead>
      <tr>
        <th>No</th>
        <th>Pemeriksaan</th>
        <th>Hasil</th>
        <th>Normal</th>
        <th>Keterangan</th>

      </tr>
    </thead>
    <tbody>
    <?php
  
      // while ($data = mysqli_fetch_assoc($result)) {
      //   // Assuming $nilai contains the "nilai" data from the database
      // echo  $counter++;

      //   $nilai+$counter = $data['nilai'];  
        $counter = 1;

        // if (mysqli_num_rows($result) > 0) {
          $result = mysqli_query($con, "SELECT * from  detail_cek_kesehatan where id_cek_kesehatan = $id and id_kategori != 0");
          while ($data = mysqli_fetch_assoc($result)) {
  // $row = mysqli_fetch_assoc($result);


// }
      
      ?>
      <tr>
        <td><?php echo $counter++; ?></td>
        <td>
          <?php 
          if($data['id_kategori']== 1){
            echo 'Gula Darah';
          }if($data['id_kategori']== 2){
            echo 'Asam Urat';
          }if($data['id_kategori']== 3){
            echo 'Kolesterol';
          
          }
          
          ?>
      </td>
        <td><?php echo $data['nilai']; ?></td>
        <td>  <?php 
          if($data['id_kategori']== 1){
            if($catatan=='Puasa'){
              echo '70 - 110 mg/dl (' . $catatan . ")";
            }elseif($catatan=='Acak'){
              echo '70 - 125 mg/dl (' . $catatan . ")";
            }else{
              echo '100 - 150 mg/dl (' . $catatan . ")";
            }
          }elseif($data['id_kategori']== 2){
            if($jk=='Laki-laki'){
              echo '≤ 7 mg/dl';
            }else{
            echo '≤ 6 mg/dl';
            }
            // echo '3.5 - 7.2';
          }elseif($data['id_kategori']== 3){
            echo '≤ 200 mg/dl';
          
          }
          
          ?></td>
       <td>  <?php 
          if($data['id_kategori']==1){
            if($catatan=='Puasa'){
              if($data['nilai'] < 70){
              echo 'Hipoglikemia';
              }elseif($data['nilai'] > 110){
                echo 'Hiperglikemia';
              }else{
                echo 'Normal';
              }
            }elseif($catatan=='Acak'){
              if($data['nilai'] < 70){
                echo 'Hipoglikemia';
                }elseif($data['nilai'] > 125){
                  echo 'Hiperglikemia';
                }else{
                  echo 'Normal';
                }
            }else{
              if($data['nilai'] < 100){
                echo 'Hipoglikemia';
                }elseif($data['nilai'] > 150){
                  echo 'Hiperglikemia';
                }else{
                  echo 'Normal';
                }
            }
          }elseif($data['id_kategori']==2){
            if($jk=='Laki-laki'){
              if ($data['nilai'] <= 7) {
                echo "Normal";
            } elseif ($data['nilai'] > 7) {
                echo "Hiperurisemia";
            }
            }elseif($jk=='Perempuan'){
                if ($data['nilai'] <= 6) {
                  echo "Normal";
              } elseif ($data['nilai'] > 6) {
                  echo "Hiperurisemia";
              }
            }
            // echo '3.5 - 7.2';
          }elseif($data['id_kategori']==3){
            if ($data['nilai'] <= 200) {
              echo "Normal";
          } elseif ($data['nilai'] > 200) {
              echo "Hiperkolesterolemia";
          }
          
          }
          
          ?></td>
      </tr>

      <?php
        // Increment the counter for the next set of rows
        // $counter += 4;
      }
      ?>
    </tbody>
  </table>
    </div>
  </div>

  <script>
window.print();
</script>
</body>
</html>
