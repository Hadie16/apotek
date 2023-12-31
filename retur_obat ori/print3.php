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
<h2 align="center">Laporan Detail Supplier</h2>
<div class="table-responsive mt-3">
  <table border="1" width="70%" align="center" cellpadding="8">
    <tbody>
      <?php
      $id = $_GET['id'];
      // $id = 11;
      include '../connection.php';
      $query = mysqli_query($con, "SELECT * FROM supplier WHERE id_supplier = $id");
      while ($data = mysqli_fetch_array($query)) { ?>
      <!-- <tr>
        <td width=25%>NIM</td>
        <td width=75%><?php echo $data['nim'] ?></td>
      </tr> -->
      <tr>
        <td>Nama</td>
        <td><?php echo $data['nama_supplier'] ?></td>
      </tr>
      <tr>
      
   
      <tr>
        <td>Telepon</td>
        <td><?php echo $data['no_telepon_supplier'] ?></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><?php echo $data['email_supplier'] ?></td>
      </tr>
      <td>Alamat</td>
        <td><?php echo $data['alamat_supplier'] ?></td>
      </tr>


      <!-- <tr>

        <td align="center"><?php echo $data['nim']; ?></td>
        <td><?php echo $data['nama']; ?></td>
        <td align="center"><?php echo $data['jurusan']; ?></td>
        <td align="center"><?php echo $data['jenis_kelamin']; ?></td>
        <td><?php echo $data['alamat']; ?></td>
        <td align="center"><?php echo $data['telepon']; ?></td>
        <td><?php echo $data['email']; ?></td>
      </tr> -->
      <?php
      }
      ?>
    </tbody>
  </table>
</div>

<script>
window.print();
</script>