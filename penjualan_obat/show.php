<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Penjualan Obat</h6>

      </div>
      <!-- <div class="row"> -->

      <div class="card-body">
      <div class="row">
      <div class="col-sm-4">

        <!-- <div>   -->
        <!-- <a href="?page=ketersediaan_obat-add" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a> -->
        <!-- <a href="../ketersediaan_obat/print.php" class="btn btn-sm btn-info" target="_blank"><i class="fas fa-print"></i>
          Cetak
          FPDF</a> -->
        <!-- <a href="../penjualan_obat/print.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i> -->
        <button  class="btn btn-sm btn-warning"id="print_keyPobat"><i class="fas fa-print"></i>Cetak</button>
          <button onclick="toggleDiv('myDiv1', 'myDiv2','myDiv3','myDiv4','myDivBtn')" class="btn btn-sm" style="background:skyblue;color:white"  id="myDivBtn" ><i class="fas fa-filter"></i></button>
          <!-- <button onclick="toggleDiv()" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-filter"></i></button> -->
          <!-- <div class="row mb-3"> -->
          <!-- </div> -->
          </div>
          <!-- </div> -->


          <div class="row">   
   
            <!-- <label for="harga_jual_obat" class="col-form-label">From</label> -->
            <div class="col-5" style="display: none;" id="myDiv1">
            <!-- <label for="harga_jual_obat" class="col-form-label">From</label> -->
               <input type="date" id="startDatePNJ" name="min" class="form-control" >
<input type="hidden" data-page="PNJ">

  </div>
  <div class="col-1" style="display: none;" id="myDiv4">
  <label for="endDatePNJ" class="col-form-label">To</label>
  </div> 
  <!-- <label for="harga_jual_obat" class="form-label">To</label> -->
               <div class="col-5" style="display: none;" id="myDiv2">
      <input type="date" id="endDatePNJ" name="max" class="form-control">
  </div>
  <div class="col-1" style="display: none;" id="myDiv3">
  <button id="filterButtonPNJ" class="btn btn-warning" ><i class="fas fa-print"></i></button>
  </div>       
  </div>
        <hr>

        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewPenjualanObat" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
              <th >No</th>

                <th >Kode Penjualan</th>
                <th >Tanggal</th>
          
                <th >Pendapatan (Rp)</th>
                <th >TTK</th>
         
                <th >Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php

              include '../connection.php';
          
              // session_start();
              // if ($_SESSION['level'] == 'administrator') {
              
              $query = mysqli_query($con, 'SELECT a.*,b.nama_ttk nama FROM penjualan_obat a join ttk b on a.id_ttk=b.id_ttk');
              // $query = mysqli_query($con, 'SELECT a.*,b.id_ttk,b.nama_ttk nama_ttk FROM penjualan_obat a inner join ttk b on a.id_ttk=b.id_ttk');
              if (!$query) {
                die('Query Error: ' . mysqli_error($con));
            }
     
            //   }else{
            //     $IK = $_SESSION['id_ttk'];
            //     $query = mysqli_query($con, "SELECT a.*,b.nama_ttk nama FROM penjualan_obat a join ttk b on a.id_ttk=b.id_ttk where a.id_ttk = '$IK'");                
            //   }
            //   if (!$query) {
            //     die('Query Error: ' . mysqli_error($con));
            // }

         
            $no=1;
              while ($data = mysqli_fetch_array($query)) {  ?>

              <tr>
              <td><?php echo $no++ ?></td>

                <td><?php echo $data['kode_penjualan_obat']; ?></td>
                <td class="text-nowrap"><?php echo $data['tanggal_penjualan_obat']; ?></td>
                <td><?php echo number_format($data['total_harga'], 0, '.', '.'); ?></td>
                <td><?php echo $data['nama']; ?></td>
            
                <td>
                <a class="btn  text-warning" target="_blank" href="../penjualan_obat/nota.php?id=<?php echo $data['id_penjualan_obat']; ?>"><i class="fas fa-file-invoice-dollar"></i>
                  </a>

                  <a class="btn text-primary" href="?page=penjualan_obat-detail_show&id=<?php echo $data['id_penjualan_obat']; ?>"><i class="fas fa-eye"></i>
                  </a>
                
                  <a class="btn  text-danger" href="?page=penjualan_obat-delete&id=<?php echo $data['id_penjualan_obat']; ?>"
                    onclick="return confirm('Anda yakin mau menghapus item ini ?')" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data"><i class="fas fa-trash"></i>
                  </a>
            
                </td>
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
</div>
<!-- <canvas id="myChartPNM"></canvas> -->