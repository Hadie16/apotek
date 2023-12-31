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
<h2 align="center">Laporan Detail Tenaga Teknik Kefarmasian</h2>
<div class="table-responsive mt-3">
  <table border="1" width="70%" align="center" cellpadding="8">
    <tbody>
      <?php
      $id = $_GET['id'];
      // $id = 11;
      include '../connection.php';
      $query = mysqli_query($con, "SELECT * FROM ttk WHERE id_ttk = $id");
      while ($data = mysqli_fetch_array($query)) { ?>
  
      <tr>
        <td>Nama</td>
        <td><?php echo $data['nama_ttk'] ?></td>
      </tr>
      <tr>
        <td>Telepon</td>
        <td><?php echo $data['telepon_ttk'] ?></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><?php echo $data['email_ttk'] ?></td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td><?php echo $data['alamat_ttk'] ?></td>
      </tr>
      <tr>
        <td>Status</td>
        <td><?php echo $data['status_ttk'] ?></td>
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