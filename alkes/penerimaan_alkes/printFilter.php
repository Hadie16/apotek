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
<h2 align="center">Laporan Data Penerimaan Alat Kesehatan ( <?php echo $showDate ?>  )</h2>
<div class="table-responsive mt-3">
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead>
      <tr>
        <th width="5%">no</th>
        <th >Kode penerimaan</th>
                <th >No Faktur</th>

                <th >Tanggal</th>

          
                <th >Total Harga (Rp)</th>
                <th >Supplier</th>


<!-- align="center" -->
        <!-- <th width="10%">Email</th>
        <th width="5%">Status</th> -->

      </tr>
    </thead>

    <tbody>
      <?php

// $keyword = $_GET['keyword'];

      include '../connection.php';
      $query = mysqli_query($con, "SELECT a.*,b.nama_supplier nama FROM penerimaan_alkes a join supplier b on a.id_supplier=b.id_supplier where DATE(a.tanggal_penerimaan_alkes) BETWEEN '$startDate' AND '$endDate'");
                           
$no = 1;
    
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
      <td><?php echo $no++ ?></td>
                        
      <td><?php echo $data['kode_penerimaan_alkes']; ?></td>
                <td><?php echo $data['no_faktur']; ?></td>

                <td class="text-nowrap"><?php echo $data['tanggal_penerimaan_alkes']; ?></td>
                <td><?php echo number_format($data['total_harga'],0,'.','.') ?></td>
                <td><?php echo $data['nama']; ?></td>

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