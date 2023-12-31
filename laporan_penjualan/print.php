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
    $date = "Invalid month value";
  }
}else{
  $date =$year;
}
?>
<br>

<!-- <h2 align="center">Laporan Data Laba Periode <?php echo $date; ?> <?php echo $year; ?> </h2> -->
<h2 align="center">Laporan Data Laba Periode <?php echo $date; ?>  </h2>

<!-- < align="center"></h4> -->
<div class="table-responsive mt-3">
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead>
      <tr>
      <th width="3%">No</th>
      <th >Nama</th>
<th >Jumlah</th>
<th >Satuan</th>

  <th >Pendapatan</th>
  <th >Pengeluaran</th>
<th >Profit</th>
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
$monthlyQuery = "SELECT *,sum(dpo.jumlah_detail_penjualan_obat) as sj from
detail_penjualan_obat as dpo join penjualan_obat as po on dpo.id_penjualan_obat=po.id_penjualan_obat 
 join ketersediaan_obat as ko on dpo.id_obat=ko.id_obat join obat as o on dpo.id_obat=o.id_obat where month(po.tanggal_penjualan_obat)=$month and year(po.tanggal_penjualan_obat)=$year group by dpo.id_obat";

              }else{

                $monthlyQuery = "SELECT *,sum(dpo.jumlah_detail_penjualan_obat) as sj from
                detail_penjualan_obat as dpo join penjualan_obat as po on dpo.id_penjualan_obat=po.id_penjualan_obat 
                 join ketersediaan_obat as ko on dpo.id_obat=ko.id_obat join obat as o on dpo.id_obat=o.id_obat where year(po.tanggal_penjualan_obat)=$year group by dpo.id_obat";

              }

$monthlyResult = mysqli_query($con, $monthlyQuery);

              $no=1;
              while ($data = mysqli_fetch_array($monthlyResult)) {
                 ?>

              <tr>
                <td><?php echo $no++; ?></td>


                <td><?php echo $data['nama_obat']; ?></td>

                <td><?php echo $data['sj']; ?></td>
                <td><?php echo $data['satuan']; ?></td>

                <td><?php echo "Rp".number_format($v1t = $data['harga_detail_penjualan_obat']*$data['sj'],'0','.','.'); ?></td>
                <td class="d-none"><?php echo $v1tx+=$v1t; ?></td>

                <td><?php echo "Rp".number_format($v2t = $data['harga_beli_obat']*$data['sj'],'0','.','.'); ?></td>
                <td class="d-none"><?php echo $v2tx+=$v2t; ?></td>

                <td><?php echo "Rp".number_format($v1t-$v2t,'0','.','.'); ?></td>

              </tr>
      


              <?php
              }
              ?>
                <tr>
             
                <td colspan="4" class="text-center font-weight-bold" style="border-bottom:1px solid">
                  Total
                </td>
                <!-- <td></td>
                <td></td>
                <td></td>
                <td></td> -->

                <td class="font-weight-bold" style="border-bottom:1px solid"><?php echo "Rp".number_format($v1tx,'0','.','.'); ?></td>

                <td class="font-weight-bold" style="border-bottom:1px solid"><?php echo "Rp".number_format($v2tx,'0','.','.'); ?></td>

                <td class="font-weight-bold" style="border-bottom:1px solid"><?php echo "Rp".number_format($v1tx-$v2tx,'0','.','.'); ?></td>

              </tr>
              <?php
              include '../connection.php';

// $currentMonth = date('n');
// $currentMonth = 7;
if($month !== "0"){
  if($month==''){
    $month = date('n');
    $year = date('Y');
  
  }

$monthlyQuery = "SELECT *,sum(dpo.jumlah_detail_penjualan_alkes) as sj from
detail_penjualan_alkes as dpo join penjualan_alkes as po on dpo.id_penjualan_alkes=po.id_penjualan_alkes 
 join ketersediaan_alkes as ko on dpo.id_alkes=ko.id_alkes join alkes a on dpo.id_alkes=a.id_alkes where month(po.tanggal_penjualan_alkes)=$month and year(po.tanggal_penjualan_alkes)=$year group by dpo.id_alkes";

}else{

  $monthlyQuery = "SELECT *,sum(dpo.jumlah_detail_penjualan_alkes) as sj from
  detail_penjualan_alkes as dpo join penjualan_alkes as po on dpo.id_penjualan_alkes=po.id_penjualan_alkes 
   join ketersediaan_alkes as ko on dpo.id_alkes=ko.id_alkes join alkes a on dpo.id_alkes=a.id_alkes where year(po.tanggal_penjualan_alkes)=$year group by dpo.id_alkes";

}

$monthlyResult = mysqli_query($con, $monthlyQuery);

              $no=1;
              while ($data = mysqli_fetch_array($monthlyResult)) {
                 ?>

              <tr>
                <td><?php echo $no++; ?></td>

                <td><?php echo $data['nama_alkes']; ?></td>
     

                <td><?php echo $data['sj']; ?></td>
                <td><?php echo $data['satuan']; ?></td>

                <td><?php echo "Rp".number_format($alkesv1t = $data['harga_detail_penjualan_alkes']*$data['sj'],'0','.','.'); ?></td>
                <td class="d-none"><?php echo $alkesv1tx+=$alkesv1t; ?></td>

                <td><?php echo "Rp".number_format($alkesv2t = $data['harga_beli_alkes']*$data['sj'],'0','.','.'); ?></td>
                <td class="d-none"><?php echo $alkesv2tx+=$alkesv2t; ?></td>

                <td><?php echo "Rp".number_format($alkesv1t-$alkesv2t,'0','.','.'); ?></td>

              </tr>
              <?php } ?>
              <tr>
                <td colspan="4" class="text-center font-weight-bold" style="border-bottom:1px solid">
                  Total
                </td>
                <!-- <td></td>
                <td></td>
                <td></td>
                <td></td> -->

                <td class="font-weight-bold" style="border-bottom:1px solid"><?php echo "Rp".number_format($alkesv1tx,'0','.','.'); ?></td>

                <td class="font-weight-bold" style="border-bottom:1px solid"><?php echo "Rp".number_format($alkesv2tx,'0','.','.'); ?></td>

                <td class="font-weight-bold" style="border-bottom:1px solid"><?php echo "Rp".number_format($alkesv1tx-$alkesv2tx,'0','.','.'); ?></td>

              </tr>


          
              <tr>
              <td colspan="4" class="text-center font-weight-bold" style="border-bottom:1px solid">
                  Grand Total
                </td>


                <td class="font-weight-bold" style="border-bottom:1px solid"><?php echo "Rp".number_format($grandtotal1=$v1tx+$alkesv1tx,'0','.','.'); ?></td>

                <td class="font-weight-bold" style="border-bottom:1px solid"><?php echo "Rp".number_format($grandtotal2=$v2tx+$alkesv2tx,'0','.','.'); ?></td>

                <td class="font-weight-bold" style="border-bottom:1px solid"><?php echo "Rp".number_format($grandtotal1-$grandtotal2,'0','.','.'); ?></td>

              </tr>

            </tbody>
  </table>
</div>
<?php include '../template/footerPrint.php';?>
</div>
<script>
window.print();
</script>