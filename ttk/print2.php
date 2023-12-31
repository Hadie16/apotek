<?php
include '../template/headerPrint.php';
?>
<h2 align="center">Laporan Data Tenaga Teknik Kefarmasian</h2>
<div class="table-responsive mt-3">
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead>
      <tr align="center">
      <th width="10%">No</th>
   
        <th width="25%">Nama</th>
        <th width="10%">Telepon</th>
        <th width="10%">Email</th>
        <th width="30%">Alamat</th>
        <th width="10%">Status</th>
  
      </tr>
    </thead>

    <tbody>
      <?php
      include '../connection.php';
      $query = mysqli_query($con, 'SELECT * FROM ttk');
      $no=1;
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
      <td><?php echo $no++ ?></td>
    
        <td><?php echo $data['nama_ttk']; ?></td>
        <td ><?php echo $data['telepon_ttk']; ?></td>
        <td ><?php echo $data['email_ttk']; ?></td>
        <td><?php echo $data['alamat_ttk']; ?></td>
        <td ><?php echo $data['status_ttk']; ?></td>
     
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