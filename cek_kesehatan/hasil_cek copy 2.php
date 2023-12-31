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




} else {
  // Handle the case when no data is found
  echo "No data found.";
}
?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>Kartu Hasil Pemeriksaan</title>
  </head>
  <body>
    <h2>Data Pemeriksaan</h2>
    <p>Nama: <?php echo $nama; ?></p>
    <p>Umur: <?php echo $age; ?></p>
    <p>Jenis Kelamin: <?php echo $jk; ?></p>
    <p>Tanggal Periksa: <?php echo $tgl_cek; ?></p>





  <table border="1" cellspacing="0" cellpadding="5">
    <thead>
      <tr>
        <th>No</th>
        <th>Pemeriksaan</th>
        <th>Hasil</th>
        <th>Normal</th>
      </tr>
    </thead>
    <tbody>
    <?php
  
      // while ($data = mysqli_fetch_assoc($result)) {
      //   // Assuming $nilai contains the "nilai" data from the database
      // echo  $counter++;

      //   $nilai+$counter = $data['nilai'];  
        $counter = 1;
$nilai1 = null;
$nilai2 = null;
$nilai3 = null;

        if (mysqli_num_rows($result) > 0) {
           // Fetch the first row and assign its data to the first nilai
  $row1 = mysqli_fetch_assoc($result);
  $nilai1 = $row1['id_kategori'];

  // Fetch the second row and assign its data to the second nilai
  $row2 = mysqli_fetch_assoc($result);
  $nilai2 = $row2['id_kategori'];

  // Fetch the third row and assign its data to the third nilai
  $row3 = mysqli_fetch_assoc($result);
  $nilai3 = $row3['id_kategori'];
}
      
      ?>
      <tr>
        <td><?php echo $counter; ?></td>
        <td>Asam urat</td>
        <td><?php echo $nilai1; ?></td>
        <td>3.5 - 7.2</td>
      </tr>
      <tr>
        <td><?php echo $counter + 1; ?></td>
        <td>Gula darah</td>
        <td><?php echo $nilai2; ?></td>
        <td>70 - 140</td>
      </tr>
      <tr>
        <td><?php echo $counter + 2; ?></td>
        <td>Kolesterol</td>
        <td><?php echo $nilai3; ?></td>
        <td>150 - 200</td>
      </tr>
      <!-- <tr>
        <td><?php echo $counter + 3; ?></td>
        <td>Hemoglobin</td>
        <td><?php echo $nilai4; ?></td>
        <td>12 - 16</td>
      </tr> -->
      <?php
        // Increment the counter for the next set of rows
        // $counter += 4;
      // }
      ?>
    </tbody>
  </table>

</body>
</html>
