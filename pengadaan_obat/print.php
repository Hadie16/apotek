<?php
include '../template/headerPrint.php';
?>
<br>
<h2 align="center">Laporan Data Pengadaan Obat</h2>
<div class="table-responsive mt-3">
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead>
      <tr>
        <th width="5%">no</th>
        <th width="15%">Kode</th>
        <th width="25%">Nama Obat</th>
        <th width="10%">Jumlah</th>
        <th width="10%">Satuan</th>

        <th width="10%">Tanggal Pengadaan</th>
        <th width="10%">Supplier</th>


<!-- align="center" -->
        <!-- <th width="10%">Email</th>
        <th width="5%">Status</th> -->

      </tr>
    </thead>

    <tbody>
      <?php
      //error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);





// $keyword = $_GET['keyword'];

      include '../connection.php';
      $query = mysqli_query($con, 'SELECT *,b.nama_supplier suppliers FROM pengadaan_obat a join supplier b on a.id_supplier=b.id_supplier join detail_pengadaan_obat dpo on a.id_pengadaan_obat=dpo.id_pengadaan_obat join obat o on dpo.id_obat=o.id_obat where status="Diterima"');
    if ($query) {
      // echo "<p>query berhasil<p/>";
  } else {
      die('invalid Query : ' . mysqli_error($con));
  }                   
$no = 1;
    
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
      <td><?php echo $no++ ?></td>
                        
                            <td align="center"><?php echo $data['kode'] ?></td>
                        <td><?php echo $data['nama_obat'] ?></td>
                         <td align="center"><?php echo $data['jumlah'] ?></td>
                          <td align="center"><?php echo $data['satuan'] ?></td>

                            <td align="center"><?php echo $data['tanggal'] ?></td>
                            <td><?php echo $data['suppliers']; ?></td>

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