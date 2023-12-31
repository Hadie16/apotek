<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Penerimaan alkes</h6>

      </div>
      <!-- <div class="row"> -->

      <div class="card-body">
      <div class="row">
      <div class="col-sm-4">
 
        <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModalPenerimaan"><i class="fas fa-plus"></i> Tambah Data</a>

        <a href="../penerimaan_alkes/print.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a>
          
          <button onclick="toggleDiv('myDiv1', 'myDiv2','myDiv3','myDiv4','myDivBtn')" class="btn btn-sm" style="background:skyblue;color:white"  id="myDivBtn" ><i class="fas fa-filter"></i></button>
          </div>
          <div class="row">   
            <div class="col-5" style="display: none;" id="myDiv1">

               <input type="date" id="startDatePNM" name="min" class="form-control" >
  </div>
  <div class="col-1" style="display: none;" id="myDiv4">
  <label for="endDatePNM" class="col-form-label">To</label>
  </div> 

               <div class="col-5" style="display: none;" id="myDiv2">
      <input type="date" id="endDatePNM" name="max" class="form-control">
<input type="hidden" data-page="PNM">

  </div>
  <div class="col-1" style="display: none;" id="myDiv3">
  <button id="filterButtonPNM" class="btn btn-warning" ><i class="fas fa-print"></i></button>
  </div>       
  </div>
        <hr>
     
        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewPenerimaanalkes" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
                <th>No </th>
                <th >Kode Penerimaan</th>
                <th >No Faktur</th>

                <th >Tanggal</th>

          
                <th >Total Harga</th>
                <th >Supplier</th>
         
                <th >Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php

              include '../connection.php';

              $query = mysqli_query($con, 'SELECT a.*,b.nama_supplier nama FROM penerimaan_alkes a join supplier b on a.id_supplier=b.id_supplier ');
              // $query = mysqli_query($con, 'SELECT a.*,b.id_kasir,b.nama_kasir nama_kasir FROM penerimaan_alkes a inner join kasir b on a.id_kasir=b.id_kasir');
            //   if (!$query) {
            //     die('Query Error: ' . mysqli_error($con));
            
            // }else{
            //   echo 1;
            // }
          //   while ($data = mysqli_fetch_array($query)) {
          //     echo "Loop executed.";
          //     var_dump($data);
          // }
          $no=1;
              while ($data = mysqli_fetch_array($query)) {  ?>

              <tr>
              <td><?php echo $no++?></td>

                <td><?php echo $data['kode_penerimaan_alkes']; ?></td>
                <td><?php echo $data['no_faktur']; ?></td>

                <td class="text-nowrap"><?php echo $data['tanggal_penerimaan_alkes']; ?></td>
                <td><?php echo number_format($data['total_harga'],0,'.','.') ?></td>
                <td><?php echo $data['nama']; ?></td>
            
                <td>
               
               


                  <!-- <a class="btn text-success" href="../penerimaan_alkes/print2.php?id=<?php echo $data['id_penerimaan_alkes']; ?>"
                    target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Surat Pemesanan"><i class="fas fa-print"></i>
                  </a> -->
                  <a class="btn text-primary" href="?page=penerimaan_alkes-detail&id=<?php echo $data['id_penerimaan_alkes']; ?>"
                 data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Data"><i class="fas fa-eye"></i>
                  </a>
                  <a class="btn text-info" href="?page=penerimaan_alkes-edit&id=<?php echo $data['id_penerimaan_alkes']; ?>"><i class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data"></i></a>

                  <a class="btn text-danger" href="?page=penerimaan_alkes-delete&id=<?php echo $data['id_penerimaan_alkes']; ?>"
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
</div>




<!-- modal penerimaan-->
<div class="modal fade" id="myModalPenerimaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog modal-lg" role="document">
  <!-- <div class="modal-dialog"> -->
    <div class="modal-content">
      <!-- <form id="inputForm"> -->
        <div class="modal-header">
          <h5 class="modal-title">Pilih Data Barang Diterima</h5>
          <div class="button-container" id="button-container">
          <button class="btn btn-warning active"  id="pesanBtn" onclick="redirectToPage('pesan')">Pesan</button>
          <button class="btn btn-secondary"  id="returBtn" onclick="redirectToPage('retur')">Retur</button>
<!-- <input type="hidden" id="switchInput" value="alkesBtn"> -->

  </div>

          <!-- <button type="button" class="btn-close" data-dismiss="modal"></button> -->
        </div>
      <form id="inputForm">

        <div class="modal-body">
          <input type="hidden" id="idInput" name="id">
          <div class="form-group">
            <!-- <label for="inputValue">Input Nilai:</label>
            <input type="text" class="form-control" id="inputValue" name="inputValue" required> -->
         
            <div class="table-responsive mt-3" >
<div id="tableContainerTambah" style="width: 100%;">

          <table class="table table-bordered table-hover" id="viewPpenerimaanalkes" style="width: 100%;">
            <thead class="bg-secondary text-white" >
            <?php

include '../connection.php';

$query = mysqli_query($con, 'SELECT a.*,b.nama_supplier nama FROM pengadaan_alkes a join supplier b on a.id_supplier=b.id_supplier where status="Dipesan"');
//   if (!$query) {
//     die('Query Error: ' . mysqli_error($con));
// }
$mnr=mysqli_num_rows($query);
if ($mnr>0) {?>
              <!-- <thead> -->
              <tr align="center">
                <th >Kode Pemesanan</th>
                <th >Jenis Produk</th>
          
                <!-- <th >Total Harga</th> -->
                <th >Tanggal Pemesanan</th>

                <th >Supplier</th>
         
                <th >Aksi</th>
              </tr>
            </thead>

            <tbody>
         
             
              <?php
              while ($data = mysqli_fetch_array($query)) {  ?>

              <tr>
                <td><?php echo $data['kode']; ?></td>
                <td><?php echo $data['jenis_produk']; ?></td>
                <!-- <td><?php echo $data['total_harga']; ?></td> -->
                <td class="text-nowrap"><?php echo $data['tanggal']; ?></td>
                <td><?php echo $data['nama']; ?></td>
                
               
            
                <td>
                <a class="btn bg-info text-white" href="?page=penerimaan_alkes-add&id1=<?php echo $data['id_pengadaan_alkes']; ?>&id2=<?php echo $data['kode']; ?>">Pilih</a>

            
                </td>
              </tr>
              
              <?php
              }

            }else{
        
              
              echo "<tr><td style='width:100%'><h1> DATA NOT FOUND </h1></td></tr>";
              
              
       }
              ?>
            </tbody>
          </table>
      </div>
          </div>
          </div>
        </div>
        <div class="modal-footer">
          <!-- <button type="submit" class="btn btn-primary">Save</button> -->
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </form>
    <!-- </div> -->
  </div>
  </div>

</div>



