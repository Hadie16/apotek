<?php
include '../template/headerPrint.php';
?>
<br>
<h2 align="center">Laporan Data Stok Alat Kesehatan</h2>
<div class="table-responsive mt-3">
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead>
      <tr align="center">
        <th width="5%">No</th>
 
        <th >Nama Alkes</th>
                <th > Jumlah Stok Alkes</th>
                <th > Satuan</th>

                <th > Harga Jual (Rp)</th>

                             <th >Tanggal Kedaluwarsa</th>


<!-- align="center" -->
        <!-- <th width="10%">Email</th>
        <th width="5%">Status</th> -->

      </tr>
    </thead>

    <tbody>
      <?php

$keyword = $_GET['keyword'];

      include '../connection.php';
      // $query = mysqli_query($con, 'SELECT a.*,sum(a.jumlah_stok_alkes),b.nama_alkes alkess from stok_alkes a join alkes b on a.id_alkes=b.id_alkes group by a.id_alkes');

      $query = mysqli_query($con, 'SELECT a.*, sum(a.jumlah_stok_alkes) as jumlah_stok_alkes,(SELECT tanggal_kadaluarsa_alkes FROM stok_alkes dso WHERE dso.id_alkes = a.id_alkes AND dso.jumlah_stok_alkes > 0 AND dso.tanggal_kadaluarsa_alkes >= CURDATE() ORDER BY dso.tanggal_kadaluarsa_alkes ASC LIMIT 1) AS tanggal_kadaluarsa_alkesss,b.nama_alkes alkess FROM stok_alkes a join alkes b on a.id_alkes=b.id_alkes group by id_alkes ');

                           
$no = 1;
    
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
      <td><?php echo $no++ ?></td>
                        
      <td class="text-nowrap"><?php echo $data['alkess']; ?></td>
                <td><?php echo $data['jumlah_stok_alkes']; ?></td>
                <td><?php echo $data['satuan']; ?></td>

             
                <td><?php echo number_format($data['harga_jual_alkes'], 0, '.', '.'); ?></td>

                <td><?php echo $data['tanggal_kadaluarsa_alkesss']; ?></td>

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