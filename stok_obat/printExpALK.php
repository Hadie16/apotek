<?php
include '../template/headerPrint.php';
?>
<br>
<h2 align="center">Laporan Data Alat Kesehatan Expired</h2>
<div class="table-responsive mt-3">
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead>
      <tr>
        <th width="5%">No</th>
 
        <th >Nama</th>
                <th > Jumlah</th>
                <th > Satuan</th>

                <!-- <th > Harga Jual (Rp)</th> -->

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
      $query = mysqli_query($con,"SELECT a.*, c.nama_alkes
      FROM stok_alkes a
      JOIN alkes c ON a.id_alkes = c.id_alkes where tanggal_kadaluarsa_alkes < NOW() and a.jumlah_stok_alkes > 0");
         
          if (!$query) {
            die('Query Error: ' . mysqli_error($con));
        }

      $no=1;
          while ($data = mysqli_fetch_array($query)) {  ?>

          <tr>
      <td> <?php echo $no++ ?></td>
          <td class="text-nowrap"><?php echo $data['nama_alkes']; ?></td>
            <td><?php echo $data['jumlah_stok_alkes']; ?></td>
            <td><?php echo $data['satuan']; ?></td>

        
            <!-- <td><?php echo number_format($data['harga_jual_alkes'], 0, '.', '.'); ?></td> -->

            <td><?php echo $data['tanggal_kadaluarsa_alkes']; ?></td>

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