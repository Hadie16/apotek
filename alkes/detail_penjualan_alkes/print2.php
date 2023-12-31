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
<h2 align="center">Laporan Data Mahasiswa</h2>
<div class="table-responsive mt-3">
  <table border="1" width="100%" align="center" cellpadding="8">
    <thead>
      <tr>
        <th width="10%">NIM</th>
        <th width="25%">Nama</th>
        <th width="5%">Jurusan</th>
        <th width="5%">Jenis Kelamin</th>
        <th width="35%">Alamat</th>
        <th width="10%">Telepon</th>
        <th width="10%">Email</th>
      </tr>
    </thead>

    <tbody>
      <?php
      include '../connection.php';
      $query = mysqli_query($con, 'SELECT * FROM mahasiswa');
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
        <td align="center"><?php echo $data['nim']; ?></td>
        <td><?php echo $data['nama']; ?></td>
        <td align="center"><?php echo $data['jurusan']; ?></td>
        <td align="center"><?php echo $data['jenis_kelamin']; ?></td>
        <td><?php echo $data['alamat']; ?></td>
        <td align="center"><?php echo $data['telepon']; ?></td>
        <td><?php echo $data['email']; ?></td>
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