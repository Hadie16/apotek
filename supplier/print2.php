<?php
include '../template/headerPrint.php';
?>
<h2 align="center">Laporan Data Supplier</h2>
<div class="table-responsive mt-3">
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead >
      <tr align="center">
        <th width="10%">No</th>
        <th width="25%">Nama</th>

       
        <th width="20%">Telepon</th>
        <th width="20%">Email</th>
        <th width="35%">Alamat</th>
      </tr>
    </thead>

    <tbody>
      <?php
      include '../connection.php';
      $query = mysqli_query($con, 'SELECT * FROM supplier');
      $no=1;
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
      <td><?php echo $no++ ?></td>

        <td><?php echo $data['nama_supplier']; ?></td>

       
        <td><?php echo $data['no_telepon_supplier']; ?></td>
        <td><?php echo $data['email_supplier']; ?></td>
        <td><?php echo $data['alamat_supplier']; ?></td>
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