<!-- <link rel="stylesheet" href="../css/sb-admin-2.min.css"> -->
<style>
* {
  font-family: Arial, Helvetica, sans-serif;
}

table {
  border-collapse: collapse;
  border-color: black;
}
</style>
<h2 align="center">Laporan Data Obat</h2>
<div class="table-responsive mt-3">
  <table border="1" width="100%" align="center" cellpadding="8">
    <thead>
      <tr>
      <th width="5%">No</th>

        <th width="10%">Kode</th>
        <th width="20%">Gambar</th>
        <th width="30%">Nama</th>
        <th width="5%">Sediaan</th>

        <th width="5%">Jenis</th>
        <th width="25%">Kategori</th>
    
      </tr>
    </thead>

    <tbody>
      <?php
      $no = 1;

      include '../connection.php';
      $query = mysqli_query($con, 'SELECT * FROM obat');
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
      <td  align="center"> <?php echo $no++ ?></td>

        <td align="center"><?php echo $data['kode_obat']; ?></td>
        <td ><img src="../uploads/<?php echo $data['gambar_obat']; ?>" width="200px" alt="Obat Image"></td>

        <td align="center"><?php echo $data['nama_obat']; ?></td>
        <td align="center"><?php echo $data['sediaan_obat']; ?></td>

        <td align="center"><?php echo $data['jenis_obat']; ?></td>
        <td><?php echo $data['kategori_obat']; ?></td>
    
      </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>

<script>
window.print();
</script>