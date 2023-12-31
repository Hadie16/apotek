<?php
include '../template/headerPrint.php';
$startDate = $_GET['startDate']; // Get the start date from the URL
$endDate = $_GET['endDate'];     // Get the end date from the URL
?>
<br>
<h2 align="center">Laporan Data Penjualan Obat</h2>
<div class="table-responsive mt-3">
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead>
      <tr align="center">
        <th width="5%">No</th>
 
        <th >Kode Penjualan</th>
                <th >Waktu Penjualan</th>
          
                <th >Pendapatan (Rp)</th>
                <th >TTK</th>


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
// $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';


      include '../connection.php';

  //     if(!empty($_GET['keyword'])){
  // $keyword = $_GET['keyword'];
      $query = mysqli_query($con, "SELECT a.*,b.nama_ttk nama FROM penjualan_obat a join ttk b on a.id_ttk=b.id_ttk WHERE DATE(a.tanggal_penjualan_obat) BETWEEN '$startDate' AND '$endDate'");
  //     }else{
        // $query = mysqli_query($con, "SELECT a.*,b.nama_ttk nama FROM penjualan_obat a join ttk b on a.id_ttk=b.id_ttk");
      



//   if ($query) {
//      echo "<p>query berhasil<p/>";
//  } else {
//      die('invalid Query : ' . mysqli_error($con));
//  }

  
$no = 1;
    
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
      <td><?php echo $no++ ?></td>
                        
      <td><?php echo $data['kode_penjualan_obat']; ?></td>
                <td class="text-nowrap"><?php echo $data['tanggal_penjualan_obat']; ?></td>
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