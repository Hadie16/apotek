<?php
include '../template/headerPrint.php';
?>
<h2 align="center">Laporan Data Pasien</h2>
<div class="table-responsive mt-3">
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead>
      <tr align="center">
   
      <th >No</th>

<th >Nama Pasien</th>
<th >Jenis Kelamin</th>
<th >Alamat</th>
<th >Tanggal Lahir</th>
<th >Telepon</th>
<!-- <th >Aksi</th> -->
  
      </tr>
    </thead>

    <tbody>
      <?php

      include '../connection.php';

      $query = mysqli_query($con, "SELECT * FROM pasien a join cek_kesehatan b on a.id_pasien=b.id_pasien join detail_cek_kesehatan c on b.id_cek_kesehatan=c.id_cek_kesehatan join kategori_cek_kesehatan d on c.id_kategori=d.id_kategori where status='Selesai' group by a.kode_pasien");

  $no=1;
      while ($data = mysqli_fetch_array($query)) {  ?>

      <tr>
      <td><?php echo $no++; ?></td>

        <td><?php echo $data['nama_pasien']; ?></td>
        <td><?php echo $data['jenis_kelamin']; ?></td>

        <td class="text-nowrap"><?php echo $data['alamat_pasien']; ?></td>
        <td><?php echo $data['tanggal_lahir']?></td>
        <td><?php echo $data['no_telepon']; ?></td>
    
        
      </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>
<?php
include '../template/footerPrint.php';
?>
<script>
window.print();
</script>