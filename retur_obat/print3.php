<!-- <link rel="stylesheet" href="../css/sb-admin-2.min.css"> -->
<?php include '../template/headerPrint.php';
$startDate = $_GET['startDate']; // Get the start date from the URL
$endDate = $_GET['endDate'];     // Get the end date from the URL
if(empty($endDate)){

  $currentDateTime = date('Y-m-d');

  $endDate = $currentDateTime;
}
if($startDate == $endDate){
  $showDate = $startDate;
}else{
  $showDate = "$startDate Sampai $endDate";

}

?>
<style>
* {
  font-family: Arial, Helvetica, sans-serif;
}

table {
  border-collapse: collapse;
  border-color: black;
}
</style>
<h2 align="center">Laporan Data Retur Obat ( <?php echo $showDate ?>  )</h2>
<div class="table-responsive mt-3">
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead>
      <tr>
        <th>No</th>

        <th >Kode</th>
        <th >Nama Obat</th>
              
              <th >Jumlah Retur</th>
              <th >Satuan</th>
              <th >Batch Number</th>

              <th > Tanggal Kadaluarsa</th>

              <th > Tanggal Retur</th>
              <th >Supplier</th>
      </tr>
    </thead>

    <tbody>
      <?php
        // echo "<p>query berhasil<p/>";

      // include '../connection.php';

      $con = mysqli_connect("localhost", "root", "", "mahabbah");

if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
      $query = mysqli_query($con, "SELECT a.*,b.nama_obat as obats,c.nama_supplier as suppliers,d.* FROM retur_obat a join detail_retur_obat d on a.id_retur_obat=d.id_retur_obat join obat b on d.id_obat=b.id_obat join supplier c on a.id_supplier=c.id_supplier where tanggal_retur BETWEEN '$startDate' AND '$endDate'");

      if ($query) {
        // echo "<p>query berhasil<p/>";
      } else {
        die('invalid Query : ' . mysqli_error($con));
      }
      $no=1;
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
        <td align="center"><?php echo $no++; ?></td>
        <td><?php echo $data['kode_retur_obat']; ?></td>

        <td ><?php echo $data['obats']; ?></td>
          
              
                <td><?php echo $data['jumlah']; ?></td>
                <td><?php echo $data['satuan']; ?></td>
                <td><?php echo $data['batch_number']; ?></td>

                <td><?php echo $data['tanggal_kadaluarsa']; ?></tdc>

                <td><?php echo $data['tanggal_retur']; ?></td>
                <td><?php echo $data['suppliers']; ?></td>

                <!-- <td><?php echo $data['kode']; ?></td> -->
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