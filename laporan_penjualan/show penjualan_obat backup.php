<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">

<div class="card-body">
<div class="row">
      <div class="col-sm-4">
        <a href="../laporan_penjualan/print.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a>
          <button onclick="toggleDivs('myDiv1', 'myDiv2','myDiv3','myDiv4','myDivBtn')" class="btn btn-sm" style="background:skyblue;color:white"  id="myDivBtn" ><i class="fas fa-filter"></i></button>
          </div>
          <div class="row">   
            <div class="col-5" style="display: none;" id="myDiv1">
               <input type="date" id="startDateKobat" name="min" class="form-control" >
  </div>
  <div class="col-1" style="display: none;" id="myDiv4">
  <label for="endDateKobat" class="col-form-label">To</label>
  </div> 
               <div class="col-5" style="display: none;" id="myDiv2">
      <input type="date" id="endDateKobat" name="max" class="form-control">
  </div>
  <div class="col-1" style="display: none;" id="myDiv3">
  <button id="filterButtonKobat" class="btn btn-warning" ><i class="fas fa-print"></i></button>
  </div>       
  </div>
        <hr>
<div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="vieObat" style="width: 100%;">
            <thead class="bg-white text-secondary" >
              <!-- <thead> -->
              <tr align="center">
                <th >No</th>
                <!-- <th >Nama Obat</th> -->
                <th >Harga Jual</th>
                <th >Harga Beli</th>
                <th >Profit</th>

                <th >Jumlah</th>
                  <th >Pendapatan</th>
                  <th >Pengeluaran</th>
                <th >Profitx</th>

              </tr>
            </thead>

            <tbody>
              <?php
              include '../connection.php';

// $currentMonth = date('n');
$currentMonth = 7;


$monthlyQuery = "SELECT * from
detail_penjualan_obat as dpo join penjualan_obat as po on dpo.id_penjualan_obat=po.id_penjualan_obat 
 join ketersediaan_obat as ko on dpo.id_obat=ko.id_obat where month(po.tanggal_penjualan_obat)=$currentMonth
";

$monthlyResult = mysqli_query($con, $monthlyQuery);

              $no=1;
              while ($data = mysqli_fetch_array($monthlyResult)) {
                 ?>

              <tr>
                <td><?php echo $no++; ?></td>

                <!-- <td class="text-nowrap"><?php echo $data['obats']; ?></td> -->
          
              
                <!-- <td><?php echo $currentMonthSum ?></td>
                <td><?php echo $currentMonthSumBeli ?></td> -->
                <td><?php echo "Rp".number_format($data['harga_detail_penjualan_obat']); ?></td>
                <td><?php echo "Rp".number_format($data['harga_beli_obat']); ?></td>            
                <td><?php echo "Rp".number_format($data['harga_detail_penjualan_obat']-$data['harga_beli_obat']) ; ?></td>

                <td><?php echo $data['jumlah_detail_penjualan_obat']; ?></td>
                <td><?php echo "Rp".number_format($v1 = $data['harga_detail_penjualan_obat']*$data['jumlah_detail_penjualan_obat']); ?></td>
                <td class="d-none"><?php echo $v1x+=$v1; ?></td>

                <td><?php echo "Rp".number_format($v2 = $data['harga_beli_obat']*$data['jumlah_detail_penjualan_obat']); ?></td>
                <td class="d-none"><?php echo $v2x+=$v2; ?></td>

                <td><?php echo "Rp".number_format($v1-$v2); ?></td>

              </tr>
      


              <?php
              }
              ?>
                <tr>
                <td colspan="5" class="text-center font-weight-bold">
                  Total
                </td>
                <!-- <td></td>
                <td></td>
                <td></td>
                <td></td> -->

                <td class="font-weight-bold"><?php echo "Rp".number_format($v1x); ?></td>

                <td class="font-weight-bold"><?php echo "Rp".number_format($v2x); ?></td>

                <td class="font-weight-bold"><?php echo "Rp".number_format($v1x-$v2x); ?></td>

              </tr>
            </tbody>
          </table>
        </div>
        </div>

        </div>
        </div>
        </div>
        <!-- </div> -->


<div class="row">
   <!-- Earnings (daily) Card Example -->
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
              FROM ( SELECT total_biaya as pendapatan, tanggal_cek_kesehatan as tanggal FROM cek_kesehatan UNION ALL
    SELECT total_harga as pendapatan, tanggal_penjualan_obat as tanggal  FROM penjualan_obat ) AS combined_data
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
    SELECT total_harga as pendapatan, tanggal_penjualan_obat as tanggal  FROM penjualan_obat ) AS combined_data
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


              <?php 
              include '../connection.php';

                              // Assuming you have a database connection established ($conn)
$query = "SELECT jumlah_stok_obat as stok FROM stok_obat WHERE id_stok_obat = '7'";

// $query = "SELECT jumlah_stok_obat as stok FROM stok_obat";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$stock = $row['stok'];
$maxStock = 1000; // The maximum stock value (adjust according to your requirements)
$percentage = ($stock / $maxStock) * 100;


                              ?> 
              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-info text-uppercase mb-1"
                        >
                          Tasks
                        </div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div
                              class="h5 mb-0 mr-3 font-weight-bold text-gray-800"
                            >
                              <?php echo $percentage; ?>%
                            </div>
                          </div>
                          <div class="col">
                            <div class="progress progress-sm mr-2">
                              <div
                                class="progress-bar bg-info"
                                role="progressbar"
                                style="width: <?php echo $percentage; ?>%"
                                aria-valuenow="50"
                                aria-valuemin="0"
                                aria-valuemax="100"
                              ></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i
                          class="fas fa-clipboard-list fa-2x text-gray-300"
                        ></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Pending Requests Card Example -->
          
            </div>

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

















            <!-- Content Row -->

            <div class="row">
              <!-- Area Chart -->
              <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-info">
                      Grafik Pendapatan
                    </h6>
                    <div class="dropdown no-arrow">
                      <a
                        class="dropdown-toggle"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink"
                      >
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"
                          >Something else here</a
                        >
                      </div>
                    </div>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="chart-area">
                      <canvas id="myAreaCharts"></canvas>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Pie Chart -->
              <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-info">
                      Sumber Pendapatan
                    </h6>
                    <div class="dropdown no-arrow">
                      <a
                        class="dropdown-toggle"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink"
                      >
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"
                          >Something else here</a
                        >
                      </div>
                    </div>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                      <canvas id="myPieCharts"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                      <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Obat-obatan
                      </span>
                      <br/>
                      <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Alat Kesehatan
                      </span>
                      <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Cek Kesehatan
                      </span>
                    </div>
                  </div>
                </div>
              </div>


              
            </div>

            <div class="row">
              <!-- Area Chart -->
              <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-info">
                      Grafik Produk Penjualan Tertinggi (Bulanan)
                    </h6>
                    <div class="dropdown no-arrow">
                      <a
                        class="dropdown-toggle"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink"
                      >
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"
                          >Something else here</a
                        >
                      </div>
                    </div>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="chart-area">
                      <canvas id="myBarCharts"></canvas>
                    </div>
                  </div>
                </div>
              </div>