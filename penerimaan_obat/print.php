<?php
include '../template/headerPrint.php';
?>
<br>
<h2 align="center">Laporan Data Detail Penerimaan Obat</h2>
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

$keyword = $_GET['keyword'];

      include '../connection.php';
      $query = mysqli_query($con, 'SELECT a.*,b.nama_supplier nama FROM penerimaan_obat a join supplier b on a.id_supplier=b.id_supplier');
                           
$no = 1;
    
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
      <td><?php echo $no++ ?></td>
                        
      <td><?php echo $data['kode_penerimaan_obat']; ?></td>
                <td><?php echo $data['no_faktur']; ?></td>

                <td class="text-nowrap"><?php echo $data['tanggal_penerimaan_obat']; ?></td>
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