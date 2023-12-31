<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>






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
              FROM ( SELECT total_biaya as pendapatan, tanggal_cek_kesehatan as tanggal FROM cek_kesehatan UNION ALL
    SELECT total_harga as pendapatan, tanggal_penjualan_obat as tanggal  FROM penjualan_obat     UNION ALL
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
    SELECT total_harga as pendapatan, tanggal_penjualan_obat as tanggal  FROM penjualan_obat     UNION ALL
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


              <?php 
//               include '../connection.php';

//                               // Assuming you have a database connection established ($conn)
// $query = "SELECT jumlah_stok_obat as stok FROM stok_obat WHERE id_stok_obat = '7'";

// // $query = "SELECT jumlah_stok_obat as stok FROM stok_obat";
// $result = mysqli_query($con, $query);
// $row = mysqli_fetch_assoc($result);
// $stock = $row['stok'];
// $maxStock = 1000; // The maximum stock value (adjust according to your requirements)
// $percentage = ($stock / $maxStock) * 100;


                              ?> 
           




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
              <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-info" id="h6Cont">
                     <?php $date = date("F Y"); // get current date in desired format
$date = str_replace(
    array('January', 'February', 'March', 'April', 'May', 'June', 
          'July', 'August', 'September', 'October', 'November', 'December'),
    array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
          'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'),
    $date); // replace month name in English with Indonesian
// echo $date; // output the date?>
                      Grafik Penjualan Obat Tertinggi Periode (<?php echo $date ?>)
                    </h6>
                    <div class="dropdown no-arrow" title="Filter">
                      <a 
                        class="dropdown-toggle"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <!-- <i
                          class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                        ></i> -->
                        <i
                          class="fas fa-filter fa-sm fa-fw text-gray-400"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink"
                      >
                        <div class="dropdown-header">Periode:</div>
                        
                        <form id="filterFormGrafik">
                        <select id="month" name="month" class="custom-select custom-select-sm">
        <option value="0" <?php if ($currentMonth == '0') echo 'selected'; ?>>None</option>

        <option value="1" <?php if ($currentMonth == '1') echo 'selected'; ?>>Januari</option>
            <option value="2"  <?php if ($currentMonth == '2') echo 'selected'; ?>>Februari</option>
            <option value="3" <?php if ($currentMonth == '3') echo 'selected'; ?>>Maret</option>
            <option value="4" <?php if ($currentMonth == '4') echo 'selected'; ?>>April</option>
            <option value="5" <?php if ($currentMonth == '5') echo 'selected'; ?>>Mei</option>
            <option value="6" <?php if ($currentMonth == '6') echo 'selected'; ?>>Juni</option>
            <option value="7" <?php if ($currentMonth == '7') echo 'selected'; ?>>Juli</option>
            <option value="8" <?php if ($currentMonth == '8') echo 'selected'; ?>>Agustus</option>
            <option value="9" <?php if ($currentMonth == '9') echo 'selected'; ?>>September</option>
            <option value="10" <?php if ($currentMonth == '10') echo 'selected'; ?>>Oktober</option>
            <option value="11" <?php if ($currentMonth == '11') echo 'selected'; ?>>November</option>
            <option value="12" <?php if ($currentMonth == '12') echo 'selected'; ?>>Desember</option>
        </select>
        <!-- </form> -->

                        <div class="dropdown-divider"></div>

                        <select id="year" name="year" class="custom-select custom-select-sm">
        <?php
       $query = mysqli_query($con, "SELECT *,year(po.tanggal_penjualan_obat) as cy,sum(dpo.jumlah_detail_penjualan_obat) as sj from
       detail_penjualan_obat as dpo join penjualan_obat as po on dpo.id_penjualan_obat=po.id_penjualan_obat 
        join ketersediaan_obat as ko on dpo.id_obat=ko.id_obat join obat as o on dpo.id_obat=o.id_obat
       ");
       while ($row = mysqli_fetch_assoc($query)) {
           $cy = $row['cy'];
          //  $nama_ttk = $row['nama_ttk'];

            if ($cy == $currentYear) {
              echo '<option value="' . $cy . '" selected>' . $cy . '</option>';
          } else {
            echo '<option value="' . $cy . '">' . $cy . '</option>';
        }
      }

        ?>
        </select>
        <div class="dropdown-divider"></div>

<div class="" style="margin-left:12px">
<button class="btn btn-warning active"  id="obatBtn">Obat</button>
<button class="btn btn-secondary"  id="alkesBtn" >Alkes</button>
<input type="hidden" id="switchInput" value="obatBtn">
</div>



        <div class="dropdown-divider"></div>




        <input type="submit" value="Filter" class="btn btn-sm" style="background:skyblue;color:white;margin-left:60px;">



        </form>
       

                        <!-- <div class="dropdown-divider"></div> -->
                        <!-- <button class="dropdown-item" onclick="loadCanvas()">Load Chart</button> -->
                        
                      </div>
                    </div>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
         
                    <div id="barChartsId" class="chart-area">
                      <canvas id="myBarCharts"></canvas>
                    </div>
                  </div>
                </div>
              </div>