<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>

<div class="row">
  <div class="col-xl-4 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
              Stok Obat
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php
              include '../connection.php';
              $count = "SELECT * from stok_obat";

              if ($result = mysqli_query($con, $count)) {
                $rowcount = mysqli_num_rows($result);
                echo $rowcount;
              }
              ?>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-4 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
          Supplier
            </div>
         <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php
              include '../connection.php';
              $count = "SELECT * from supplier";

              if ($result = mysqli_query($con, $count)) {
                $rowcount = mysqli_num_rows($result);
                echo $rowcount;
              }
              ?>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-4 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
              USER
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php
              include '../connection.php';
              $count = "SELECT * from user";

              if ($result = mysqli_query($con, $count)) {
                $rowcount = mysqli_num_rows($result);
                echo $rowcount;
              }
              ?>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- <div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Materi Praktikum</h6>

      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <h2>Materi praktikum </h2>
            <ul>
              <li>Menggunakan admin template (sbadmin2)</li>
              <li>Membuat aplikasi create, read, update, delete, print dengan bahasa pemrograman (PHP)</li>
              <li>Menggunakan Datatables untuk menampilkan data</li>
              <li>Menggunakan select2 untuk menampilkan daftar select/list</li>
              <li>Membuat fungsi print menggunakan library FPDF dan windows.print</li>
            </ul>
          </div>
          <div class="col-md-6">
            <h2>Ruang Lingkup Aplikasi</h2>
            <ul>
              <li>Login
                <ul>
                  <li>level : admin</li>
                  <li>level : operator</li>
                </ul>
              </li>
              <li>Menampilkan data dengan datatables</li>
              <li>Fungsi simpan Data</li>
              <li>Fungsi edit Data</li>
              <li>Fungsi hapus berdasarkan baris data</li>
              <li>Fungsi cetak (semua data)</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->

<div class="row">
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
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
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
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-warning text-uppercase mb-1"
                        >
                          Pending Requests
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          18
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                      </div>
                    </div>
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