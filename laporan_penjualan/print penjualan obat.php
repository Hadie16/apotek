<?php
include '../template/headerPrint.php';
$currentMonth = 7;
// $currentMonth = date('F');
$date = date("F Y"); // get current date in desired format
$date = str_replace(
    array('January', 'February', 'March', 'April', 'May', 'June', 
          'July', 'August', 'September', 'October', 'November', 'December'),
    array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
          'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'),
    $date); // replace month name in English with Indonesian
echo $date; // output the date
?>
<br>

<h2 align="center">Laporan Data Penjualan Obat Bulan <?php echo $currentMonth; ?></h2>
<div class="table-responsive mt-3">
  <table border="1" width="100%" align="center" cellpadding="8">
    <thead>
      <tr>
      <th width="3%">No</th>
      <th width="15%">Harga Jual</th>
      <th width="15%">Harga Beli</th>
      <th width="15%">Profit</th>
      <th width="10%">Jumlah</th>
      <th width="15%">Pendapatan</th>
      <th width="15%">Pengeluaran</th>
      <th width="12%">Profitx</th>
      </tr>
    </thead>

    <tbody>
      <?php
include '../connection.php';

// $currentMonth = date('n');
// $currentMonth = 7;


$monthlyQuery = "SELECT * from
detail_penjualan_obat as dpo join penjualan_obat as po on dpo.id_penjualan_obat=po.id_penjualan_obat 
 join ketersediaan_obat as ko on dpo.id_obat=ko.id_obat where month(po.tanggal_penjualan_obat)=$currentMonth
";

$monthlyResult = mysqli_query($con, $monthlyQuery);

              $no=1;
              while ($data = mysqli_fetch_array($monthlyResult)) {
                 ?>

              <tr>
                <td><?php echo $no++; ?></td>

                <!-- <td class="text-nowrap"><?php echo $data['obats']; ?></td> -->
          
              
                <!-- <td><?php echo $currentMonthSum ?></td>
                <td><?php echo $currentMonthSumBeli ?></td> -->
                <td><?php echo "Rp".number_format($data['harga_detail_penjualan_obat']); ?></td>
                <td><?php echo "Rp".number_format($data['harga_beli_obat']); ?></td>            
                <td><?php echo "Rp".number_format($data['harga_detail_penjualan_obat']-$data['harga_beli_obat']) ; ?></td>

                <td><?php echo $data['jumlah_detail_penjualan_obat']; ?></td>
                <td><?php echo "Rp".number_format($v1 = $data['harga_detail_penjualan_obat']*$data['jumlah_detail_penjualan_obat']); ?></td>
                <td class="d-none"><?php echo $v1x+=$v1; ?></td>

                <td><?php echo "Rp".number_format($v2 = $data['harga_beli_obat']*$data['jumlah_detail_penjualan_obat']); ?></td>
                <td class="d-none"><?php echo $v2x+=$v2; ?></td>

                <td><?php echo "Rp".number_format($v1-$v2); ?></td>

              </tr>
      <?php
      }
      ?>
        <tr>
                <td colspan="5" class="text-center font-weight-bold">
                  Total
                </td>
                <!-- <td></td>
                <td></td>
                <td></td>
                <td></td> -->

                <td class="font-weight-bold"><?php echo "Rp".number_format($v1x); ?></td>

                <td class="font-weight-bold"><?php echo "Rp".number_format($v2x); ?></td>

                <td class="font-weight-bold"><?php echo "Rp".number_format($v1x-$v2x); ?></td>

              </tr>
    </tbody>
  </table>
</div>
<?php include '../template/footerPrint.php';?>
</div>
<script>
window.print();
</script>