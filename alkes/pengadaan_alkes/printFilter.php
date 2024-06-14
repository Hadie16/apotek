<?php

include '../template/headerPrint.php';
include '../connection.php';

$startDate = $_GET['startDate']; // Get the start date from the URL
$endDate = $_GET['endDate'];     // Get the end date from the URL

if(empty($endDate)){

  $currentDateTime = date('Y-m-d');

  $endDate = $currentDateTime;
}
if($startDate == $endDate){
  $showDate = $startDate;
}else{
  $showDate = "$startDate Sampai $endDate";

}

?>
<br>
<h2 align="center">Laporan Data Pengadaan Alat Kesehatan ( <?php echo $showDate ?>  )</h2>
<div class="table-responsive mt-3">
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead>
      <tr  align="center">
        <th width="5%">no</th>
        <th width="15%">Kode</th>
        <th width="25%">Nama Alkes</th>
        <th width="10%">Jumlah</th>
        <th width="10%">Satuan</th>

        <th width="10%">Tanggal Pengadaan</th>
        <th width="10%">Supplier</th>


<!-- align="center" -->
        <!-- <th width="10%">Email</th>
        <th width="5%">Status</th> -->

      </tr>
    </thead>

    <tbody>
      <?php
      //error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);





// $keyword = $_GET['keyword'];

      include '../connection.php';
      $query = mysqli_query($con, "SELECT *,b.nama_supplier suppliers FROM pengadaan_alkes a join supplier b on a.id_supplier=b.id_supplier join detail_pengadaan_alkes dpo on a.id_pengadaan_alkes=dpo.id_pengadaan_alkes join alkes o on dpo.id_alkes=o.id_alkes where status='Diterima' and DATE(a.tanggal) BETWEEN '$startDate' AND '$endDate'");
    if ($query) {
      // echo "<p>query berhasil<p/>";
  } else {
      die('invalid Query : ' . mysqli_error($con));
  }                   
$no = 1;
    
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
      <td><?php echo $no++ ?></td>
                        
                            <td align="center"><?php echo $data['kode'] ?></td>
                        <td><?php echo $data['nama_alkes'] ?></td>
                         <td align="center"><?php echo $data['jumlah'] ?></td>
                          <td align="center"><?php echo $data['satuan'] ?></td>

                            <td align="center"><?php echo $data['tanggal'] ?></td>
                            <td><?php echo $data['suppliers']; ?></td>

      </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>
<?php include '../template/footerPrint.php';?>
</div>
<script>
window.print();
</script>