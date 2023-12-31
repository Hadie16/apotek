<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Retur Alkes</h6>

      </div>
      <div class="card-body">
      <div class="row">
      <div class="col-sm-4">
        <a href="?page=retur_alkes-add" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a>
        <!-- <a href="../retur_alkes/print.php" class="btn btn-sm btn-info" target="_blank"><i class="fas fa-print"></i>
          Cetak
          FPDF</a> -->
        <a href="../alkes/retur_alkes/print2.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
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
               <input type="date" id="startDateRET" name="min" class="form-control" >
               <input type="hidden" data-page="RET" >
  </div>
  <div class="col-1" style="display: none;" id="myDiv4">
  <label for="endDateRET" class="col-form-label">To</label>
  </div> 
  <!-- <label for="harga_jual_alkes" class="form-label">To</label> -->
               <div class="col-5" style="display: none;" id="myDiv2">
      <input type="date" id="endDateRET" name="max" class="form-control">
  </div>
  <div class="col-1" style="display: none;" id="myDiv3">
  <button id="filterButtonRET" class="btn btn-warning" ><i class="fas fa-print"></i></button>
  </div>       
  </div>
        <hr>

        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover display" id="salesTable" style="width: 100%;">
            <thead class="bg-secondary text-white">
              <!-- <thead> -->
              <tr align="center">
                <!-- <th >BTN</th> -->

                <th >No</th>
                <th >Kode</th>
                <!-- <th >Nama alkes</th> -->
                <th >Supplier</th>
                <th > Tanggal Retur</th>
                <th >Nama alkes</th>
                <th >Jumlah</th>
                <th >Satuan</th>
                <th >Batch Number</th>
                <th >Tanggal Kedaluwarsa</th>

                <th >Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php
              include '../connection.php';
              $query = mysqli_query($con, 'SELECT a.*,c.nama_supplier suppliers,b.*,d.nama_alkes FROM retur_alkes a join supplier c on a.id_supplier=c.id_supplier join detail_retur_alkes b on a.id_retur_alkes=b.id_retur_alkes join alkes d on b.id_alkes=d.id_alkes');
              $no=1;
              while ($data = mysqli_fetch_array($query)) { ?>

              <tr>
              <!-- <td><button class="toggle-child">Toggle</button></td> -->
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['kode_retur_alkes']; ?></td>

          
              
                <td><?php echo $data['suppliers']; ?></td>

                <td><?php echo $data['tanggal_retur']; ?></td>
                <td class="text-nowrap"><?php echo $data['nama_alkes']; ?></td>
                <td><?php echo $data['jumlah']; ?></td>
                <td><?php echo $data['satuan']; ?></td>
               
 <td><?php echo $data['batch_number']; ?></td>
                <td><?php echo $data['tanggal_kadaluarsa']; ?></td>

                <td>
                <a class="btn text-success" href="../alkes/retur_alkes/ttrb.php?id=<?php echo $data['id_retur_alkes']; ?>"
                    target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Data"><i class="fas fa-print"></i>
                  </a>
                  <!-- link detail -->
                <!-- href="?page=retur_alkes-detail&id=<?php echo $data['id_retur_alkes']; ?>" -->
                <!-- <a class="btn text-primary" 
                href="?page=retur_alkes-detail&id=<?php echo $data['id_retur_alkes']; ?>"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Data"><i class="fas fa-eye"></i>
                  </a> -->
                <a class="btn text-primary toggle-child" 
                   data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Data" id="toggleColumns"><i class="fas fa-eye"></i>

                   <!-- <button aria-label="toggle" type="button" class="rounded-circle border-0" id="sidebarToggle"></button> -->

                  </a>
                  <a class="btn text-info" href="?page=retur_alkes-edit&id=<?php echo $data['id_retur_alkes']; ?>"><i
                      class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data"></i>
                  </a>
                  <a class="btn text-danger" href="?page=retur_alkes-delete&id=<?php echo $data['id_retur_alkes']; ?>"
                    onclick="return confirm('Anda yakin mau menghapus item ini ?')" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data"><i class="fas fa-trash"></i></a>
                
                </td>
              </tr>
<!-- childrow -->
<!-- <tr class="child">
      <td colspan="5">
        <table id="salesTable" class="display">
          <thead> -->
            <!-- Items table header -->
          <!-- </thead>
          <tbody> -->
            <!-- Items data for the first sale -->
          <!-- </tbody>
        </table>
      </td>
    </tr>  -->

              <?php
              }
              ?>
            </tbody>
          </table>
          <!-- <button id="toggleColumns">Toggle Columns 2-3</button> -->
        </div>
      </div>
    </div>
  </div>
</div>