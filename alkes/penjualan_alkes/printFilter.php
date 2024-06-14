<?php
include '../template/headerPrint.php';

// $keyword = $_GET['keyword'];
$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];
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
<h2 align="center">Laporan Data Penjualan Alat Kesehatan (<?php echo $showDate ?>  )</h2>
<div class="table-responsive mt-3">
  <table border="1" width="100%" align="center" cellpadding="8">
    <thead>
      <tr>
        <th width="5%">No</th>
 
        <th >Kode Penjualan</th>
                <th >Tanggal</th>
          
                <th >Pendapatan (Rp)</th>
                <th >TTK</th>


<!-- align="center" -->
        <!-- <th width="10%">Email</th>
        <th width="5%">Status</th> -->

      </tr>
    </thead>

    <tbody>
<?php


include '../connection.php';
// $query = mysqli_query($con, "SELECT a.*, b.nama_ttk AS nama 
//                             FROM penjualan_alkes a 
//                             JOIN ttk b ON a.id_ttk = b.id_ttk
//                             WHERE a.tanggal_penjualan_alkes BETWEEN '$stardDate' AND '$endDate'");
                             $query = mysqli_query($con, "SELECT a.*,b.nama_ttk nama FROM penjualan_alkes a join ttk b on a.id_ttk=b.id_ttk WHERE DATE(a.tanggal_penjualan_alkes) BETWEEN '$startDate' AND '$endDate'");

$no = 1;
    
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
      <td><?php echo $no++ ?></td>
                        
      <td><?php echo $data['kode_penjualan_alkes']; ?></td>
                <td class="text-nowrap"><?php echo $data['tanggal_penjualan_alkes']; ?></td>
                <td><?php echo number_format($data['total_harga'],0,'.','.'); ?></td>

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