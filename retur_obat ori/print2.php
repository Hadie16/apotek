<!-- <link rel="stylesheet" href="../css/sb-admin-2.min.css"> -->
<?php include '../template/headerPrint.php';?>
<style>
* {
  font-family: Arial, Helvetica, sans-serif;
}

table {
  border-collapse: collapse;
  border-color: black;
}
</style>
<h2 align="center">Laporan Data Retur Obat</h2>
<div class="table-responsive mt-3">
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead>
      <tr>
        <th width="10%">No</th>
        <th >Nama Obat</th>
              
              <th >Jumlah Retur</th>
              <th >Satuan</th>

              <th > Tanggal Retur</th>
              <th >Kode Penerimaan</th>
      </tr>
    </thead>

    <tbody>
      <?php
      include '../connection.php';
      $query = mysqli_query($con, 'SELECT a.*,b.nama_obat obats,c.kode_penerimaan_obat kode FROM retur_obat a join obat b on a.id_obat=b.id_obat join penerimaan_obat c on a.id_penerimaan_obat=c.id_penerimaan_obat');
      $no=1;
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
        <td align="center"><?php echo $no++; ?></td>
        <td class="text-nowrap"><?php echo $data['obats']; ?></td>
          
              
                <td><?php echo $data['jumlah']; ?></td>
                <td><?php echo $data['Satuan']; ?></td>

                <td><?php echo $data['tanggal_retur']; ?></td>
                <td><?php echo $data['kode']; ?></td>
      </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>
<?php include '../template/footerPrint.php';?>

<script>
window.print();
</script>