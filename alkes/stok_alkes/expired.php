<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>


<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <!-- <h6 class="m-0 font-weight-bold text-info">Cek Kesehatan - <span class="text-danger">Proses</span></h6> -->
        <h6 class="m-0 font-weight-bold text-info">Expired - Obat</h6>


      </div>
      <div class="card-body">
      <!-- <a href="?page=pengadaan_obat-add" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a> -->

      <a href="../stok_obat/printExp.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a>
        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewProses" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
              <th >No</th>

              <th >Nama Obat</th>
                <th >Jumlah</th>
          
                <!-- <th >Harga Jual (Rp)</th> -->
                <th >Tanggal Kedaluwarsa</th>
         
                <!-- <th >Aksi</th> -->


              </tr>
            </thead>

            <tbody>
              <?php

              include '../connection.php';

              $query = mysqli_query($con,"SELECT a.*, c.nama_obat
          FROM detail_stok_obat a
          JOIN obat c ON a.id_obat = c.id_obat where tanggal_kadaluarsa < CURDATE() and a.jumlah_stok_obat > 0");
          // $query = mysqli_query($con,"SELECT a.*, c.nama_obat,s.nama_supplier,dpo.batch_number
          // FROM detail_stok_obat a
          // JOIN obat c ON a.id_obat = c.id_obat
          // JOIN ketersediaan_obat ko on a.id_ketersediaan_obat=ko.id_ketersediaan_obat
          // JOIN detail_ketersediaan_obat dko on ko.id_ketersediaan_obat=dko.id_ketersediaan_obat
          // JOIN penerimaan_obat po on dko.id_penerimaan_obat=po.id_penerimaan_obat
          // JOIN detail_penerimaan_obat dpo on po.id_penerimaan_obat=dpo.id_penerimaan_obat
          // JOIN supplier s on dko.id_supplier=s.id_supplier where a.tanggal_kadaluarsa < CURDATE() and a.jumlah_stok_obat > 0 ");
             
              if (!$query) {
                die('Query Error: ' . mysqli_error($con));
            }
    
          $no=1;
              while ($data = mysqli_fetch_array($query)) {  ?>

              <tr>
          <td> <?php echo $no++ ?></td>
              <td class="text-nowrap"><?php echo $data['nama_obat']; ?></td>
                <td><?php echo $data['jumlah_stok_obat']; ?></td>
            
                <!-- <td><?php echo number_format($data['harga_jual_obat'], 0, '.', '.'); ?></td> -->

                <td><?php echo $data['tanggal_kadaluarsa']; ?></td>
                <!-- <td><?php echo $data['nama_supplier']; ?></td>
                <td><?php echo $data['batch_number']; ?></td> -->


             

            
            
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


<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Expired - Alkes</h6>

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
        <a href="../stok_obat/printExpALK.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a>
          <!-- <button onclick="toggleDivPGD('myDiv1', 'myDiv2','myDiv3','myDiv4','myDivBtn')" class="btn btn-sm" style="background:skyblue;color:white"  id="myDivBtn" ><i class="fas fa-filter"></i></button> -->
          <!-- <button onclick="toggleDiv()" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-filter"></i></button> -->
          <!-- <div class="row mb-3"> -->
          <!-- </div> -->
          </div>
          <!-- </div> -->


          <div class="row">   
   
            <!-- <label for="harga_jual_obat" class="col-form-label">From</label> -->
            <div class="col-5" style="display: none;" id="myDiv1">
            <!-- <label for="harga_jual_obat" class="col-form-label">From</label> -->
               <input type="date" id="startDatePGD" name="min" class="form-control" >
  </div>
  <div class="col-1" style="display: none;" id="myDiv4">
  <label for="endDatePGD" class="col-form-label">To</label>
  </div> 
  <!-- <label for="harga_jual_obat" class="form-label">To</label> -->
               <div class="col-5" style="display: none;" id="myDiv2">
      <input type="date" id="endDatePGD" name="max" class="form-control">
  </div>
  <div class="col-1" style="display: none;" id="myDiv3">
  <button id="filterButtonPGD" class="btn btn-warning" ><i class="fas fa-print"></i></button>
  </div>       
  </div>
        <hr>
        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewPengadaanObat" style="width: 100%;">
          <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
              <th >No</th>

              <th >Nama Alkes</th>
                <th >Jumlah</th>
          
                <!-- <th >Harga Jual (Rp)</th> -->
                <th >Tanggal Kedaluwarsa</th>
         
                <!-- <th >Aksi</th> -->


              </tr>
            </thead>

            <tbody>
              <?php

              include '../connection.php';

              $query = mysqli_query($con,"SELECT a.*, c.nama_alkes
          FROM detail_stok_alkes a
          JOIN alkes c ON a.id_alkes = c.id_alkes where tanggal_kadaluarsa < CURDATE() and a.jumlah_stok_alkes > 0");
             
              if (!$query) {
                die('Query Error: ' . mysqli_error($con));
            }
    
          $no=1;
              while ($data = mysqli_fetch_array($query)) {  ?>

              <tr>
          <td> <?php echo $no++ ?></td>
              <td class="text-nowrap"><?php echo $data['nama_alkes']; ?></td>
                <td><?php echo $data['jumlah_stok_alkes']; ?></td>
            
                <!-- <td><?php echo number_format($data['harga_jual_alkes'], 0, '.', '.'); ?></td> -->

                <td><?php echo $data['tanggal_kadaluarsa']; ?></td>
             

            
            
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