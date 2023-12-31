<?php
include '../template/headerPrint.php';
?>
<?php
include '../connection.php';
$id = $_GET['id'];
$result = mysqli_query($con, "SELECT a.*, b.*,c.* FROM cek_kesehatan a JOIN pasien b ON a.id_pasien = b.id_pasien join detail_cek_kesehatan c on a.id_cek_kesehatan=c.id_cek_kesehatan WHERE b.id_pasien = $id");

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
    <title>Laporan History Pemeriksaan Pasien</title>
    <style>
* {
  font-family: Arial, Helvetica, sans-serif;
}

/* table {
  border-collapse: collapse;
  border-color: black;
} */

</style>
<style>
            body { font-family: Arial, sans-serif; }
            table { border-collapse: collapse; width: 100%; }
            th, td { border: 1px solid black; padding: 5px; }
          </style>
  </head>
  <body>
    <h2 align="center"> Laporan Data History Pemeriksaan Pasien</h2>
    <p>Nama: <?php echo $nama; ?></p>
    <p>Umur: <?php echo $age; ?></p>
    <p>Jenis Kelamin: <?php echo $jk; ?></p>
    <!-- <p>Tanggal Periksa: <?php echo $tgl_cek; ?></p> -->




    <div class="table-responsive mt-3">

  <table border="1" cellspacing="0" cellpadding="5">
    <thead>
      <tr>
        <th>No</th>
        <th>Pemeriksaan</th>
        <th>Hasil</th>
        <th>Normal</th>
        <th>Keterangan</th>
        <th>Tanggal Pemeriksaan</th>


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
          // $result = mysqli_query($con, "SELECT *,ck.tanggal_cek_kesehatan as tgl_cek from  detail_cek_kesehatan dck join cek_kesehatan ck on dck.id_cek_kesehatan=ck.id_cek_kesehatan join pasien p on ck.id_pasien=p.id_pasien  where ck.id_pasien = $id and id_kategori != 0");
          $result = mysqli_query($con, "SELECT * from  detail_cek_kesehatan dck join cek_kesehatan ck on dck.id_cek_kesehatan=ck.id_cek_kesehatan join pasien p on ck.id_pasien=p.id_pasien where ck.id_pasien = $id and id_kategori != 0 and status = 'Selesai'");

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
          <td><?php echo $data['tanggal_cek_kesehatan']?></td>
      </tr>

      <?php
        // Increment the counter for the next set of rows
        // $counter += 4;
      }
      ?>
    </tbody>
  </table>
    </div>
    <?php
include '../template/footerPrint.php';
?>
  <script>
window.print();
</script>
</body>
</html>
