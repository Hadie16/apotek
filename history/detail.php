<?php
$id = $_GET['id'];
// $result = mysqli_query($con, "SELECT * FROM detail_cek_kesehatan WHERE id_detail_cek_kesehatan=$id");
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <?php
           $query = mysqli_query($con,  "SELECT a.*,b.* FROM cek_kesehatan a join pasien b on a.id_pasien=b.id_pasien WHERE b.id_pasien=$id limit 1");
        if (!$query) {
          die('Query Error: ' . mysqli_error($con));}
              while ($data = mysqli_fetch_array($query)) { ?>
        <h6 class="m-0 font-weight-bold text-info">Detail Cek Kesehatan - <span class="text-warning" ><?php echo $data['nama_pasien']; ?></span></h6>

        <!-- <h6 class="m-0 font-weight-bold text-black"><?php echo $data['kode_pasien']?> <span class="text-warning" ><?php echo $data['tanggal_lahir']; ?></span></h6> -->
        <?php
// Assuming $data['tanggal_lahir'] contains the date of birth in the format 'Y-m-d'
$birthDate = $data['tanggal_lahir'];
$today = new DateTime(); // Current date

// Create a DateTime object from the birth date
$birthdateObj = new DateTime($birthDate);

// Calculate the difference between the birth date and the current date
$interval = $birthdateObj->diff($today);

// Get the age from the interval
$age = $interval->y;
?>

<!-- Display the age -->
<h6 class="m-0 font-weight-bold text-black">
  <?php echo $data['kode_pasien']; ?>
  <span class="text-warning">
  <!-- Usia: <?php echo $age; ?> Tahun -->
  </span>
</h6>

        <?php
        $jk= $data['jenis_kelamin'];
       

              }
              $querys = mysqli_query($con,  "SELECT a.*,a.catatan ctt,b.* FROM cek_kesehatan a join pasien b on a.id_pasien=b.id_pasien WHERE b.id_pasien=$id and a.catatan != '-' limit 1");
              if (!$querys) {
                die('Query Error: ' . mysqli_error($con));}
              while ($datas = mysqli_fetch_array($querys)) {
                $catatan= $datas['ctt'];
              }


              ?>

      </div>
   
      <div class="card-body">


          <a href="?page=history-show" class="btn btn-sm btn-danger"><i class="fas fa-chevron-left"></i>
          Kembali</a>
          <a href="../history/print2.php?id=<?php echo $id; ?>"
                    target="_blank" class="btn btn-sm btn-warning"><i class="fas fa-print"></i>
          Cetak</a>
        <hr>

        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewDetailHistory" style="width: 100%;">
            <thead class="bg-secondary text-white" >
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
        <td>
       <?php echo $data['tanggal_cek_kesehatan'] ?>
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
  </div>
</div>