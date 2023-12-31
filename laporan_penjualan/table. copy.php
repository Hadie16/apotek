<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>





            <!-- </div> -->

            <!-- table -->

            <div class="row">
  <div class="col-md-6">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Penjualan Tertinggi Bulan Ini</h6>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
            <th>No</th>

              <th>Nama Obat</th>
              <th>Total Jual</th>
            </tr>
          </thead>
          <tbody>
          <?php

include '../connection.php';

$query = mysqli_query($con, 'SELECT a.id_obat,c.nama_obat, SUM(jumlah_detail_penjualan_obat) AS jumlah FROM detail_penjualan_obat as a join penjualan_obat as b on a.id_penjualan_obat=b.id_penjualan_obat join obat c on a.id_obat=c.id_obat WHERE MONTH(tanggal_penjualan_obat) = MONTH(CURRENT_DATE())
GROUP BY nama_obat
ORDER BY jumlah DESC
LIMIT 5');


if (!$query) {
  die('Query Error: ' . mysqli_error($con));
}
$no=1;
while ($data = mysqli_fetch_array($query)) {  ?>

<tr>
<td><?php echo $no++?></td>

  <td><?php echo $data['nama_obat']; ?></td>
  <td><?php echo $data['jumlah']; ?></td>
</tr>

<?php
}
?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">Penjualan Tertinggi Hari Ini</h6>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
            <th>No</th>

              <th>Nama Obat</th>
              <th>Total Jual</th>
            </tr>
          </thead>
          <tbody>
          <?php

include '../connection.php';

$query = mysqli_query($con, 'SELECT a.id_obat,c.nama_obat, SUM(jumlah_detail_penjualan_obat) AS jumlah FROM detail_penjualan_obat as a join penjualan_obat as b on a.id_penjualan_obat=b.id_penjualan_obat join obat c on a.id_obat=c.id_obat WHERE DATE(tanggal_penjualan_obat) = CURRENT_DATE()
GROUP BY nama_obat
ORDER BY jumlah DESC
LIMIT 5');

if (!$query) {
  die('Query Error: ' . mysqli_error($con));
}
$no=1;
while ($data = mysqli_fetch_array($query)) {  ?>

<tr>
<td><?php echo $no++?></td>

  <td><?php echo $data['nama_obat']; ?></td>
  <td><?php echo $data['jumlah']; ?></td>
</tr>

<?php
}
?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>






