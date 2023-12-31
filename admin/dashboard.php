<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>


<!-- <div class="container">
    <h1>Dark/Light Mode Toggle</h1>
    <label class="switch">
      <input type="checkbox" id="mode-toggle">
      <span class="slider round"></span>
    </label>
  </div> -->

<div class="row">
              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                        >
                          Pendapatan (Harian)
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php 
              include '../connection.php';
                          
    //           $daylyQuery = "SELECT SUM(pendapatan) AS dayly_sum, DATE(tanggal) AS day
    //           FROM ( SELECT total_biaya as pendapatan, tanggal_cek_kesehatan as tanggal FROM cek_kesehatan UNION ALL
    // SELECT total_harga as pendapatan, tanggal_penjualan_obat as tanggal  FROM penjualan_obat ) AS combined_data
    //           GROUP BY day";
//     daylyResult = mysqli_query($con, $daylyQuery);

// // Fetch the results
// $daylySum = array();
// while ($row = mysqli_fetch_assoc($daylyResult)) {
//   $daylySum[$row['day']] = $row['dayly_sum'];
// }

// // Get the current day
// $currentDate = date('Y-m-d');

// // Echo the sum for the current day
// $currentdaySum = $daylySum[$currentday];
// echo 'Rp'.number_format($currentdaySum, 0, '.', '.');
              $dailyQuery = "SELECT SUM(pendapatan) AS daily_sum, DATE(tanggal) AS day
              FROM ( 
                SELECT total_biaya as pendapatan, tanggal_cek_kesehatan as tanggal FROM cek_kesehatan
                UNION ALL
                SELECT total_harga as pendapatan, tanggal_penjualan_obat as tanggal FROM penjualan_obat
                UNION ALL
                SELECT total_harga as pendapatan, tanggal_penjualan_alkes as tanggal FROM penjualan_alkes
              ) AS combined_data
              WHERE DATE(tanggal) = CURDATE()
              GROUP BY day";

$dailyResult = mysqli_query($con, $dailyQuery);

// Fetch the results
$dailySum = array();
while ($row = mysqli_fetch_assoc($dailyResult)) {
    $dailySum[$row['day']] = $row['daily_sum'];
}

// Get the current date
$currentDate = date('Y-m-d');

// Echo the sum for the current date
$currentDateSum = $dailySum[$currentDate];
echo 'Rp'.number_format($currentDateSum, 0, '.', '.');




                ?>
                        </div>
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>

                      </div>
                    </div>
                  </div>
                </div>
              </div>


   <!-- Earnings (Monthly) Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-warning text-uppercase mb-1"
                        >
                          Pendapatan (Mingguan)
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
               
                 <?php 
              include '../connection.php';
                          
              $weeklyQuery = "SELECT SUM(pendapatan) AS weekly_sum, WEEK(tanggal) AS week, YEAR(tanggal) AS year
               FROM (
                   SELECT total_biaya as pendapatan, tanggal_cek_kesehatan as tanggal FROM cek_kesehatan
                   UNION ALL
                   SELECT total_harga as pendapatan, tanggal_penjualan_obat as tanggal FROM penjualan_obat
                   UNION ALL
                SELECT total_harga as pendapatan, tanggal_penjualan_alkes as tanggal FROM penjualan_alkes
               ) AS combined_data
               GROUP BY week, year
               ORDER BY year, week";
$weeklyResult = mysqli_query($con, $weeklyQuery);

// Fetch the results
$weeklySum = array();
while ($row = mysqli_fetch_assoc($weeklyResult)) {
    $year = $row['year'];
    $week = $row['week'];
    $weeklySum["$year-$week"] = $row['weekly_sum'];
}

// Get the current year and week
$currentYear = date('Y');
$currentWeek = date('W');

// Echo the sum for the current week of the current year
$currentWeekSum = $weeklySum["$currentYear-$currentWeek"];
echo 'Rp'.number_format($currentWeekSum, 0, '.', '.');




                ?>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-info text-uppercase mb-1"
                        >
                          Pendapatan (Bulanan)
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php 
              include '../connection.php';
                          
              $monthlyQuery = "SELECT SUM(pendapatan) AS monthly_sum, MONTH(tanggal) AS month
              FROM ( SELECT total_biaya as pendapatan, tanggal_cek_kesehatan as tanggal FROM cek_kesehatan 
              UNION ALL
              SELECT total_harga as pendapatan, tanggal_penjualan_obat as tanggal  FROM penjualan_obat 
              UNION ALL
                SELECT total_harga as pendapatan, tanggal_penjualan_alkes as tanggal FROM penjualan_alkes ) AS combined_data
              GROUP BY month";
$monthlyResult = mysqli_query($con, $monthlyQuery);

// Fetch the results
$monthlySum = array();
while ($row = mysqli_fetch_assoc($monthlyResult)) {
  $monthlySum[$row['month']] = $row['monthly_sum'];
}

// Get the current month
$currentMonth = date('n');

// Echo the sum for the current month
$currentMonthSum = $monthlySum[$currentMonth];
echo 'Rp'.number_format($currentMonthSum, 0, '.', '.');



                ?>
                        </div>
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>

                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Earnings (annual) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-success text-uppercase mb-1"
                        >
                          Pendapatan (Tahunan)
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
               
                 <?php 
              include '../connection.php';
                          
              $annualQuery = "SELECT SUM(pendapatan) AS annual_sum, YEAR(tanggal) AS year
              FROM ( SELECT total_biaya as pendapatan, tanggal_cek_kesehatan as tanggal FROM cek_kesehatan UNION ALL
    SELECT total_harga as pendapatan, tanggal_penjualan_obat as tanggal  FROM penjualan_obat 
    UNION ALL
                SELECT total_harga as pendapatan, tanggal_penjualan_alkes as tanggal FROM penjualan_alkes ) AS combined_data
              GROUP BY year";
$annualResult = mysqli_query($con, $annualQuery);

// Fetch the results
$annualSum = array();
while ($row = mysqli_fetch_assoc($annualResult)) {
  $annualSum[$row['year']] = $row['annual_sum'];
}

// Get the current year
$currentYear = date('Y');

// Echo the sum for the current year
$currentYearSum = $annualSum[$currentYear];
echo 'Rp'.number_format($currentYearSum, 0, '.', '.');



                ?>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- table -->

            <div class="row">
 
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
              <th>Satuan</th>

            </tr>
          </thead>
          <tbody>
          <?php

include '../connection.php';

$query = mysqli_query($con, 'SELECT a.satuan, a.id_obat,c.nama_obat, SUM(jumlah_detail_penjualan_obat) AS jumlah FROM detail_penjualan_obat as a join penjualan_obat as b on a.id_penjualan_obat=b.id_penjualan_obat join obat c on a.id_obat=c.id_obat WHERE DATE(tanggal_penjualan_obat) = CURRENT_DATE()
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
  <td><?php echo $data['satuan']; ?></td>

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
        <h6 class="m-0 font-weight-bold text-primary">Penjualan Tertinggi Bulan Ini</h6>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
            <th>No</th>

              <th>Nama Obat</th>
          

              <th>Total Jual</th>
                  <th>Satuan</th>
            </tr>
          </thead>
          <tbody>
          <?php

include '../connection.php';

$query = mysqli_query($con, 'SELECT a.satuan,a.id_obat,c.nama_obat, SUM(jumlah_detail_penjualan_obat) AS jumlah FROM detail_penjualan_obat as a join penjualan_obat as b on a.id_penjualan_obat=b.id_penjualan_obat join obat c on a.id_obat=c.id_obat WHERE MONTH(tanggal_penjualan_obat) = MONTH(CURRENT_DATE())
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
  <td><?php echo $data['satuan']; ?></td>

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












