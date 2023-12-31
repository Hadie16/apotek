<?php
include '../template/headerPrint.php';
?>
<br>
<h2 align="center">Laporan Data Stok Obat</h2>
<div class="table-responsive mt-3">
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead>
      <tr>
        <th width="5%">No</th>
 
        <th >Nama obat</th>
                <th > Jumlah Stok Obat</th>
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
      // $query = mysqli_query($con, 'SELECT a.*,sum(a.jumlah_stok_obat),b.nama_obat obats from stok_obat a join obat b on a.id_obat=b.id_obat group by a.id_obat');

      $query = mysqli_query($con, 'SELECT a.*, sum(a.jumlah_stok_obat) as jumlah_stok_obat,(SELECT tanggal_kadaluarsa_obat FROM stok_obat dso WHERE dso.id_obat = a.id_obat AND dso.jumlah_stok_obat > 0 AND dso.tanggal_kadaluarsa_obat >= CURDATE() ORDER BY dso.tanggal_kadaluarsa_obat ASC LIMIT 1) AS tanggal_kadaluarsa_obatss,b.nama_obat obats FROM stok_obat a join obat b on a.id_obat=b.id_obat group by id_obat ');

                           
$no = 1;
    
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
      <td><?php echo $no++ ?></td>
                        
      <td class="text-nowrap"><?php echo $data['obats']; ?></td>
                <td><?php echo $data['jumlah_stok_obat']; ?></td>
                <td><?php echo $data['satuan']; ?></td>

             
                <td><?php echo number_format($data['harga_jual_obat'], 0, '.', '.'); ?></td>

                <td><?php echo $data['tanggal_kadaluarsa_obatss']; ?></td>

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