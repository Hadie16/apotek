<?php
include '../template/headerPrint.php';
$month1 = $_GET['month'];
$year1 = $_GET['year'];

// $currentMonth = 7;
// $currentMonth = date('F');
// $date = date("F Y"); // get current date in desired format
// $date="";
if($month !== "0"){
// $date = $month;
// $date = str_replace(
//     array('1', '2', '3', '4', '5', '6', 
//           '7', '8', '9', '10', '11', '12'),
//     array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
//           'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'),
//     $date); // replace month name in English with Indonesian
//echo $date; // output the date
// --------------------------------------
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
  $date = "Invalid month value";
}

}else{
  // $date ='';
  $date =$year;

}
?>
<br>

<h2 align="center">Laporan Data Penjualan Obat Tertinggi Periode <?php echo $date; ?></h2>

<div class="table-responsive mt-3">
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead>
    <tr>
            <th>No</th>

            <th>Nama Obat</th>
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
$query = "SELECT a.satuan,a.id_obat,c.nama_obat, SUM(jumlah_detail_penjualan_obat) AS jumlah,harga_detail_penjualan_obat, SUM(harga_detail_penjualan_obat) as total_harga FROM detail_penjualan_obat as a join penjualan_obat as b on a.id_penjualan_obat=b.id_penjualan_obat join obat c on a.id_obat=c.id_obat where month(b.tanggal_penjualan_obat)=$month and year(b.tanggal_penjualan_obat)=$year
GROUP BY nama_obat
ORDER BY jumlah";

              }else{
                $query = "SELECT a.satuan,a.id_obat,c.nama_obat, SUM(jumlah_detail_penjualan_obat) AS jumlah,harga_detail_penjualan_obat, SUM(harga_detail_penjualan_obat) as total_harga FROM detail_penjualan_obat as a join penjualan_obat as b on a.id_penjualan_obat=b.id_penjualan_obat join obat c on a.id_obat=c.id_obat where year(b.tanggal_penjualan_obat)=$year
GROUP BY nama_obat
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

  <td><?php echo $data['nama_obat']; ?></td>
  <td><?php echo $data['jumlah']; ?></td>
  <td><?php echo $data['satuan']; ?></td>

  <td><?php echo number_format($data['harga_detail_penjualan_obat'],0,'.','.'); ?></td>

  <td><?php echo number_format($data['jumlah']*$data['harga_detail_penjualan_obat'],0,'.','.'); ?></td>

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