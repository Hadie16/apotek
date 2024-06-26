<?php
// Start or resume the session
// session_start();s

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>


<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <!-- <h6 class="m-0 font-weight-bold text-info">Cek Kesehatan - <span class="text-danger">Proses</span></h6> -->
        <h6 class="m-0 font-weight-bold text-info">Cek Kesehatan - Proses</h6>


      </div>
      <div class="card-body">

        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewProses" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
                <th >Kode Cek Kesehatan</th>
                <th >Nama Pasien</th>
          
              
                <th >Tanggal Periksa</th>
         
                <th >Status</th>
                <th >Input Hasil</th>

              </tr>
            </thead>

            <tbody>
              <?php

              include '../connection.php';

              $query = mysqli_query($con, 'SELECT a.*,b.nama_pasien nama FROM cek_kesehatan a join pasien b on a.id_pasien=b.id_pasien where status="Proses"');
              // $query = mysqli_query($con, 'SELECT a.*,b.id_kasir,b.nama_kasir nama_kasir FROM penjualan_obat a inner join kasir b on a.id_kasir=b.id_kasir');
              if (!$query) {
                die('Query Error: ' . mysqli_error($con));
            }
          //   while ($data = mysqli_fetch_array($query)) {
          //     echo "Loop executed.";
          //     var_dump($data);
          // }
          $no=1;
              while ($data = mysqli_fetch_array($query)) {  ?>

              <tr>
              <td><?php echo $data['kode_cek_kesehatan']; ?></td>
                <td class="text-nowrap"><?php echo $data['nama']; ?></td>
                <td><?php echo $data['tanggal_cek_kesehatan']; ?></td>
                <td><p class="bg-danger text-white text-center "><?php echo $data['status']; ?></p></td>

            
                <td align="center">
              <!-- <form id="filterFormModal<?php echo $no++; ?>"> -->
              <!-- <input type="text" class="form-control" id="id<?php echo $no++; ?>" name="" value="<?php echo $data['id_cek_kesehatan']; ?>"> -->

                <button id="myButton" data-id="<?php echo $data['id_cek_kesehatan']; ?>" data-target="#myModal" class="btn btn-primary input-data-btn myButton" data-toggle="modal" >Input</button>

              <!-- </form> -->
         
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
        <h6 class="m-0 font-weight-bold text-info">Cek Kesehatan - Selesai</h6>

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
        <a href="../cek_kesehatan/print.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a>
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
               <input type="date" id="startDateCek" name="min" class="form-control" >
  </div>
  <div class="col-1" style="display: none;" id="myDiv4">
  <label for="endDateCek" class="col-form-label">To</label>
  </div> 
  <!-- <label for="harga_jual_obat" class="form-label">To</label> -->
               <div class="col-5" style="display: none;" id="myDiv2">
      <input type="date" id="endDateCek" name="max" class="form-control">
  </div>
  <div class="col-1" style="display: none;" id="myDiv3">
  <button id="filterButtonCek" class="btn btn-warning" ><i class="fas fa-print"></i></button>
  </div>       
  </div>
        <hr>

        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewSelesai" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
              <th >No</th>

                <th >Kode Cek Kesehatan</th>
                <th >Nama Pasien</th>
          
                <th >Tanggal Periksa</th>
                <th >Total Biaya (Rp)</th>
                <th >TTK</th>

                <th >Status</th>
         
                <th >Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php

              include '../connection.php';

              $query = mysqli_query($con, 'SELECT a.*,b.nama_pasien nama,c.nama_ttk FROM cek_kesehatan a join pasien b on a.id_pasien=b.id_pasien join ttk c on a.id_ttk=c.id_ttk where status="Selesai"');
              // $query = mysqli_query($con, 'SELECT a.*,b.id_kasir,b.nama_kasir nama_kasir FROM penjualan_obat a inner join kasir b on a.id_kasir=b.id_kasir');
              if (!$query) {
                die('Query Error: ' . mysqli_error($con));
            }
          //   while ($data = mysqli_fetch_array($query)) {
          //     echo "Loop executed.";
          //     var_dump($data);
          // }
          $no=1;
              while ($data = mysqli_fetch_array($query)) {  ?>

              <tr>
              <td><?php echo $no++; ?></td>

                <td><?php echo $data['kode_cek_kesehatan']; ?></td>
                <td class="text-nowrap"><?php echo $data['nama']; ?></td>
                <td align="center"><?php echo $data['tanggal_cek_kesehatan']; ?></td>
                <td align="right"><?php echo number_format($data['total_biaya'], 0, '.', '.'); ?></td>
                <td class="text-nowrap"><?php echo $data['nama_ttk']; ?></td>

                <td><p class="bg-success text-white text-center "><?php echo $data['status']; ?></p></td>
                
            
                <td align="center">

             

                  <a class="btn text-warning" href="../cek_kesehatan/hasil_cek.php?id=<?php echo $data['id_cek_kesehatan']; ?>"
                    target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Data"><i class="fas fa-print"></i>
                  </a>


<a class="btn text-primary" href="?page=cek_kesehatan-detail&id=<?php echo $data['id_cek_kesehatan']; ?>"
                     data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Data"><i class="fas fa-eye"></i>
                  </a>
                  <!-- <a class="btn text-info" href="?page=cek_kesehatan-edit&id=<?php echo $data['id_cek_kesehatan']; ?>"><i class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data"></i></a> -->

                  <a class="btn text-danger" href="?page=cek_kesehatan-delete&id=<?php echo $data['id_cek_kesehatan']; ?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data"><i class="fas fa-trash"></i></a>
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





<!-- modal cek kesehatan-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">

  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form id="inputForm">
        <div class="modal-header">
          <h5 class="modal-title">Input Data</h5>
          <button type="button" class="btn-close" data-dismiss="modal"></button>
        </div>
      
        <div class="modal-body">

        <div class="col-sm-12" id="printContainerCek">

      </div>  

     
        </div>
     
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>