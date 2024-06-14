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
<h2 align="center">Laporan Data Alat Kesehatan</h2>
<div class="table-responsive mt-3">
  <table border="1" width="100%" align="center" cellpadding="8">
    <thead>
      <tr>
      <th width="5%">No</th>

        <th width="10%">Kode</th>
      
        <th width="5%">Gambar</th>
  <th width="25%">Nama</th>
        <!-- <th width="10%">Email</th> -->
      </tr>
    </thead>

    <tbody>
      <?php
      $no = 1;
      include '../../connection.php';
      $query = mysqli_query($con, 'SELECT * FROM alkes');
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
      <td><?php echo $no++ ?></td>

      <td><?php echo $data['kode_alkes']; ?></td>
        
     
        <td ><img src="../../uploads/<?php echo $data['gambar_alkes']; ?>" width="200px" alt="alkes Image"></td>
           <td><?php echo $data['nama_alkes']; ?></td>


      
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