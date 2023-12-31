<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>


<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <!-- <h6 class="m-0 font-weight-bold text-info">Cek Kesehatan - <span class="text-danger">Proses</span></h6> -->
        <h6 class="m-0 font-weight-bold text-info">Pengadaan Alkes - Pemesanan</h6>


      </div>
      <div class="card-body">
      <a href="?page=pengadaan_alkes-add" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a>


        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewProses" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
                <th >Kode Pengadaan</th>
                <!-- <th >Jumlah Jenis Barang</th> -->
                <!-- <th >Total Harga</th> -->
                <th >Tanggal Pengadaan</th>
                <th >Supplier</th>

                <th >Status</th>
                <th >Aksi</th>


              </tr>
            </thead>

            <tbody>
              <?php

              include '../connection.php';

              $query = mysqli_query($con, 'SELECT a.*,b.nama_supplier suppliers FROM pengadaan_alkes a join supplier b on a.id_supplier=b.id_supplier where status="Dipesan" OR status="Draft"');
             
              if (!$query) {
                die('Query Error: ' . mysqli_error($con));
            }
    
          
              while ($data = mysqli_fetch_array($query)) {  ?>

              <tr>
              <td><?php echo $data['kode']; ?></td>
                <!-- <td class="text-nowrap"><?php echo $data['jenis_produk']; ?></td> -->
                <!-- <td><?php echo $data['total_harga']; ?></td> -->
                <td><?php echo $data['tanggal']; ?></td>
                <td><?php echo $data['suppliers']; ?></td>



                <td><p class="bg-warning text-white text-center "><?php echo $data['status']; ?></p></td>

            
                <td align="center">
       
                <!-- <a class="btn text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Konfirmasi Pesanan"><i class="fas fa-check"></i></a> -->
             
                  <a class="btn text-warning" href="../alkes/pengadaan_alkes/print2.php?id=<?php echo $data['id_pengadaan_alkes']; ?>"
                    target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Surat Pemesanan"><i class="fas fa-print"></i>
                  </a>
                  <a class="btn text-primary" href="?page=pengadaan_alkes-detail&id=<?php echo $data['id_pengadaan_alkes']; ?>"
                 data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Data"><i class="fas fa-eye"></i>
                  </a>
                  <a class="btn text-info" href="?page=pengadaan_alkes-edit&id=<?php echo $data['id_pengadaan_alkes']; ?>"><i
                      class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data"></i>
                  </a>
                  <a class="btn text-danger" href="?page=pengadaan_alkes-delete&id=<?php echo $data['id_pengadaan_alkes']; ?>"
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


<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Pengadaan Alkes - Diterima</h6>

      </div>
      <!-- <div class="row"> -->

      <div class="card-body">
      <div class="row">
      <div class="col-sm-4">

        <!-- <div>   -->
        <!-- <a href="?page=ketersediaan_alkes-add" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a> -->
        <!-- <a href="../ketersediaan_alkes/print.php" class="btn btn-sm btn-info" target="_blank"><i class="fas fa-print"></i>
          Cetak
          FPDF</a> -->
        <a href="../alkes/pengadaan_alkes/print.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a>
          <button onclick="toggleDiv('myDiv1', 'myDiv2','myDiv3','myDiv4','myDivBtn')" class="btn btn-sm" style="background:skyblue;color:white"  id="myDivBtn" ><i class="fas fa-filter"></i></button>
          <!-- <button onclick="toggleDiv()" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-filter"></i></button> -->
          <!-- <div class="row mb-3"> -->
          <!-- </div> -->
          </div>
          <!-- </div> -->


          <div class="row">   
   
            <!-- <label for="harga_jual_alkes" class="col-form-label">From</label> -->
            <div class="col-5" style="display: none;" id="myDiv1">
            <!-- <label for="harga_jual_alkes" class="col-form-label">From</label> -->
               <input type="date" id="startDatePGD" name="min" class="form-control" >
               <input type="hidden" data-page="PGDALK" >


  </div>
  <div class="col-1" style="display: none;" id="myDiv4">
  <label for="endDatePGD" class="col-form-label">To</label>
  </div> 
  <!-- <label for="harga_jual_alkes" class="form-label">To</label> -->
               <div class="col-5" style="display: none;" id="myDiv2">
      <input type="date" id="endDatePGD" name="max" class="form-control">
  </div>
  <div class="col-1" style="display: none;" id="myDiv3">
  <button id="filterButtonPGDALK" class="btn btn-warning" ><i class="fas fa-print"></i></button>
  </div>       
  </div>
        <hr>

        
        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewPengadaanObatSelesai" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
              <th >No</th>
          
        <th>Kode Pengadaan</th>
        <th>Nama alkes</th>
        <th>Jumlah</th>
        <th>Satuan</th>

        <th>Tanggal Pengadaan</th>

        <th>Supplier</th>
        <th>Status</th>
        
                <th >Aksi</th>

              </tr>
            </thead>

            <tbody>
              <?php

              include '../connection.php';
              $query = mysqli_query($con, 'SELECT *,b.nama_supplier suppliers FROM pengadaan_alkes a join supplier b on a.id_supplier=b.id_supplier join detail_pengadaan_alkes dpo on a.id_pengadaan_alkes=dpo.id_pengadaan_alkes join alkes o on dpo.id_alkes=o.id_alkes where status="Diterima"');
  //   if ($query) {
  //     echo "<p>query berhasil<p/>";
  // } else {
  //     die('invalid Query : ' . mysqli_error($con));
  // }                   
$no = 1;
    
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
      <td><?php echo $no++ ?></td>
                        
                            <td align="center"><?php echo $data['kode'] ?></td>
                        <td><?php echo $data['nama_alkes'] ?></td>
                         <td align="center"><?php echo $data['jumlah'] ?></td>
                          <td align="center"><?php echo $data['satuan'] ?></td>

                            <td align="center"><?php echo $data['tanggal'] ?></td>
                            <td><?php echo $data['suppliers']; ?></td>

                <td><p class="bg-success text-white text-center "><?php echo $data['status']; ?></p></td>
            
                <td align="center">
                  <!-- <a class="btn bg-info text-white" href="?page=pengadaan_alkes-detail&id=<?php echo $data['id_pengadaan_alkes']; ?>">Detail
                  </a> -->
                  <a class="btn text-warning" href="../alkes/pengadaan_alkes/print2.php?id=<?php echo $data['id_pengadaan_alkes']; ?>"
                    target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Surat Pemesanan"><i class="fas fa-print"></i>
                  </a>
                  <!-- <a class="btn text-primary" href="?page=pengadaan_alkes-detail&id=<?php echo $data['id_pengadaan_alkes']; ?>"
                 data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Data"><i class="fas fa-eye"></i>
                  </a> -->
                  <a class="btn text-danger" href="?page=pengadaan_alkes-delete&id=<?php echo $data['id_pengadaan_alkes']; ?>"
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