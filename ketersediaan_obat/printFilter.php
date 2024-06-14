<?php
include '../template/headerPrint.php';
include '../connection.php';

$startDate = $_GET['startDate']; // Get the start date from the URL
$endDate = $_GET['endDate'];     // Get the end date from the URL
// $endDate = $con->query("SELECT MAX(tanggal_kadaluarsa_obat) AS max_date FROM ketersediaan_obat")->fetch_assoc()["max_date"];

if(empty($endDate)){

  $currentDateTime = date('Y-m-d');

  // $endDate = $currentDateTime;
  $endDate = $con->query("SELECT MAX(tanggal_kadaluarsa_obat) AS max_date FROM ketersediaan_obat")->fetch_assoc()["max_date"];
}

if($startDate == $endDate){
  $showDate = $startDate;
}else{
  $showDate = "$startDate Sampai $endDate";

}


?>
<br>
<h2 align="center">Laporan Data Ketersediaan Obat ( <?php echo $showDate ?>  )</h2>
<div class="table-responsive mt-3">
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead>
      <tr>
        <th width="5%">no</th>
 
                <th >Nama Obat</th>            
                <th >Jumlah</th>
                <th >Satuan</th>
                <th >Harga Beli Obat (Rp)</th>
             
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
      // $query = mysqli_query($con, 'SELECT a.*,b.nama_obat obats FROM ketersediaan_obat a join obat b on a.id_obat=b.id_obat');
      $query = mysqli_query($con, "SELECT a.*, sum(a.jumlah_ketersediaan_obat) as jumlah_ketersediaan_obat,(SELECT tanggal_kadaluarsa_obat FROM ketersediaan_obat dso WHERE dso.id_obat = a.id_obat AND dso.jumlah_ketersediaan_obat > 0 AND dso.tanggal_kadaluarsa_obat >= CURDATE() ORDER BY dso.tanggal_kadaluarsa_obat ASC LIMIT 1) AS tanggal_kadaluarsa_obatss,b.nama_obat obats FROM ketersediaan_obat a join obat b on a.id_obat=b.id_obat where DATE(tanggal_kadaluarsa_obat) BETWEEN '$startDate' AND '$endDate' group by id_obat ");
                           
$no = 1;
    
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
      <td><?php echo $no++ ?></td>
                        
      <td class="text-nowrap"><?php echo $data['obats']; ?></td>
           
           <td><?php echo $data['jumlah_ketersediaan_obat']; ?></td>
           <td><?php echo $data['satuan']; ?></td>
           <td><?php echo number_format($data['harga_beli_obat'],0,'.','.'); ?></td>

           <td><?php echo $data['tanggal_kadaluarsa_obat']; ?></td>


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