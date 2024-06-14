<?php
include '../template/headerPrint.php';
$month1 = $_GET['month'];
$year1 = $_GET['year'];

// $currentMonth = 7;
// $currentMonth = date('F');
// $date = date("F Y"); // get current date in desired format
// $date="";
if($month !== "0"){
  $month = $month1;
  $year = $year1;
  $monthNames = array(
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
  );
  
  // Check if the month is within a valid range
  if ($month >= 1 && $month <= 12) {
    $monthName = $monthNames[$month - 1];
    $date = $monthName . ' ' . $year;
  } else {
    // $date = "Invalid month value";
  $date =$year;

  }
}else{
  $date =$year;
}
?>
<br>

<h2 align="center">Laporan Data Penjualan Alat Kesehatan Tertinggi Periode <?php echo $date; ?> </h2>

<div class="table-responsive mt-3">
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead>
    <tr>
            <th>No</th>

            <th>Nama Alkes</th>
              <th>Total Jual</th>
              <th>Satuan</th>

              <th>Harga (Rp)</th>
              <th>Total Harga (Rp)</th>
            </tr>
          </thead>
          <tbody>
          <?php
              include '../connection.php';
              if($month !== "0"){
if($month==''){
  $month = date('n');
  $year = date('Y');

}
// $currentMonth = 7;
$query = "SELECT a.satuan,a.id_alkes,c.nama_alkes, SUM(jumlah_detail_penjualan_alkes) AS jumlah,harga_detail_penjualan_alkes, SUM(harga_detail_penjualan_alkes) as total_harga FROM detail_penjualan_alkes as a join penjualan_alkes as b on a.id_penjualan_alkes=b.id_penjualan_alkes join alkes c on a.id_alkes=c.id_alkes where month(b.tanggal_penjualan_alkes)=$month and year(b.tanggal_penjualan_alkes)=$year
GROUP BY nama_alkes
ORDER BY jumlah";

              }else{
                $query = "SELECT a.satuan,a.id_alkes,c.nama_alkes, SUM(jumlah_detail_penjualan_alkes) AS jumlah,harga_detail_penjualan_alkes, SUM(harga_detail_penjualan_alkes) as total_harga FROM detail_penjualan_alkes as a join penjualan_alkes as b on a.id_penjualan_alkes=b.id_penjualan_alkes join alkes c on a.id_alkes=c.id_alkes where year(b.tanggal_penjualan_alkes)=$year
GROUP BY nama_alkes
ORDER BY jumlah";


              }
            //   if ($query) {
            //     echo "<p>query berhasil<p/>";
            // } else {
            //     die('invalid Query : ' . mysqli_error($con));
            // }
            // echo var_dump($query);
            // echo mysqli_num_rows($query); 

$monthlyResult = mysqli_query($con, $query);

              $no=1;
              while ($data = mysqli_fetch_array($monthlyResult)) {
                 ?>

<tr>
<td><?php echo $no++?></td>

  <td><?php echo $data['nama_alkes']; ?></td>
  <td><?php echo $data['jumlah']; ?></td>
  <td><?php echo $data['satuan']; ?></td>

  <td><?php echo number_format($data['harga_detail_penjualan_alkes'],0,'.','.'); ?></td>

  <td><?php echo number_format($data['jumlah']*$data['harga_detail_penjualan_alkes'],0,'.','.'); ?></td>

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