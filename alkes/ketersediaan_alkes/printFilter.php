<?php
include '../template/headerPrint.php';
include '../connection.php';

$startDate = $_GET['startDate']; // Get the start date from the URL
$endDate = $_GET['endDate']; // Get the start date from the URL

// $endDate = $con->query("SELECT MAX(tanggal_kadaluarsa_alkes) AS max_date FROM ketersediaan_alkes")->fetch_assoc()["max_date"];

if(empty($endDate)){

  $endDate = $con->query("SELECT MAX(tanggal_kadaluarsa_alkes) AS max_date FROM ketersediaan_alkes")->fetch_assoc()["max_date"];
}
if($startDate == $endDate){
  $showDate = $startDate;
}else{
  $showDate = "$startDate Sampai $endDate";

}

?>
<br>
<h2 align="center">Laporan Data Ketersediaan Alat Kesehatan ( <?php echo $showDate ?>  )</h2>
<div class="table-responsive mt-3">
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead>
      <tr>
        <th width="5%">no</th>
 
                <th >Nama Alkes</th>            
                <th >Jumlah</th>
                <th >Satuan</th>
                <th >Harga Beli Alkes (Rp)</th>
             
                <th >Tanggal Kadaluarsa</th>


<!-- align="center" -->
        <!-- <th width="10%">Email</th>
        <th width="5%">Status</th> -->

      </tr>
    </thead>

    <tbody>
      <?php

// $keyword = $_GET['keyword'];

      // include '../connection.php';
      // $query = mysqli_query($con, 'SELECT a.*,b.nama_alkes alkess FROM ketersediaan_alkes a join alkes b on a.id_alkes=b.id_alkes');
      $query = mysqli_query($con, "SELECT a.*, sum(a.jumlah_ketersediaan_alkes) as jumlah_ketersediaan_alkes,(SELECT tanggal_kadaluarsa_alkes FROM ketersediaan_alkes dso WHERE dso.id_alkes = a.id_alkes AND dso.jumlah_ketersediaan_alkes > 0 AND dso.tanggal_kadaluarsa_alkes >= CURDATE() ORDER BY dso.tanggal_kadaluarsa_alkes ASC LIMIT 1) AS tanggal_kadaluarsa_alkesss,b.nama_alkes alkess FROM ketersediaan_alkes a join alkes b on a.id_alkes=b.id_alkes where DATE(tanggal_kadaluarsa_alkes) BETWEEN '$startDate' AND '$endDate' group by id_alkes ");
                           
$no = 1;
    
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
      <td><?php echo $no++ ?></td>
                        
      <td class="text-nowrap"><?php echo $data['alkess']; ?></td>
           
           <td><?php echo $data['jumlah_ketersediaan_alkes']; ?></td>
           <td><?php echo $data['satuan']; ?></td>
           <td><?php echo number_format($data['harga_beli_alkes'],0,'.','.'); ?></td>

           <td><?php echo $data['tanggal_kadaluarsa_alkes']; ?></td>


      </tr>
      <tr>
        <!-- <td colspan="2" align="center"> Total Ketersediaan</td> -->
        <!-- <td></td>
        <td></td> -->

      </tr>

      <?php
      }
      ?>
    </tbody>
  </table>
</div>
<div align="center" style="position: relative; top: 50px; left: 500px;">
  <p>Banjarbaru, <?php $date = date("d F Y"); // get current date in desired format
$date = str_replace(
    array('January', 'February', 'March', 'April', 'May', 'June', 
          'July', 'August', 'September', 'October', 'November', 'December'),
    array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
          'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'),
    $date); // replace month name in English with Indonesian
echo $date; // output the date
?><p>
  <br>
<p> Penanggung Jawab,</p>
<br>
<br>

<br>

<strong><p style="text-decoration: underline; text-decoration-skip-ink: none;">apt. NURUL ASFIA AM,S.Farm.</p></strong>
<!-- <p > NIP. 19800624 200904 2 002</p> -->


</div>
</div>
<script>
window.print();
</script>