<?php
include '../template/headerPrint.php';
?>
<br>
<h2 align="center">Laporan Data Cek Kesehatan</h2>
<div class="table-responsive mt-3">
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead>
      <tr>
        <th width="5%">No</th>
 
        <th >Kode Cek Kesehatan</th>
                <th >Nama Pasien</th>
          
                <th >Tanggal Periksa</th>
                <th >Total Biaya (Rp)</th>
                <th >TTK</th>



<!-- align="center" -->
        <!-- <th width="10%">Email</th>
        <th width="5%">Status</th> -->

      </tr>
    </thead>

    <tbody>
      <?php

$keyword = $_GET['keyword'];

      include '../connection.php';
      $query = mysqli_query($con, 'SELECT a.*,b.nama_pasien nama,t.nama_ttk FROM cek_kesehatan a join pasien b on a.id_pasien=b.id_pasien join ttk t on a.id_ttk=t.id_ttk where status="Selesai"');
                           
$no = 1;
    
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
      <td><?php echo $no++ ?></td>
                        
      <td><?php echo $data['kode_cek_kesehatan']; ?></td>
                <td class="text-nowrap"><?php echo $data['nama']; ?></td>
                <td><?php echo $data['tanggal_cek_kesehatan']; ?></td>
                <td><?php echo number_format($data['total_biaya'],0,',','.'); ?></td>
                <td><?php echo $data['nama_ttk']; ?></td>

        

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