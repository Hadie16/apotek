<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Cek Kesehatan</h6>

      </div>
      <!-- <div class="row"> -->

      <div class="card-body">
      <div class="row">
      <div class="col-sm-4">

        <!-- <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModalPenerimaan"><i class="fas fa-plus"></i> Tambah Data</a> -->

        <a href="../history/print.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a>
          
          <!-- <button onclick="toggleDivH('myDiv1', 'myDiv2','myDiv3','myDiv4','myDivBtn')" class="btn btn-sm" style="background:skyblue;color:white"  id="myDivBtn" ><i class="fas fa-filter"></i></button> -->
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
  </div>
  <div class="col-1" style="display: none;" id="myDiv3">
  <button id="filterButtonPNM" class="btn btn-warning" ><i class="fas fa-print"></i></button>
  </div>       
  </div>
        <hr>

        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewHistoryPasien" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
              <th >No</th>

                <th >Nama Pasien</th>
                <th >Jenis Kelamin</th>
                <th >Alamat</th>
                <th >Tanggal Lahir</th>
                <th >Telepon</th>
                <th >Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php

              include '../connection.php';

              $query = mysqli_query($con, "SELECT * FROM pasien a join cek_kesehatan b on a.id_pasien=b.id_pasien join detail_cek_kesehatan c on b.id_cek_kesehatan=c.id_cek_kesehatan join kategori_cek_kesehatan d on c.id_kategori=d.id_kategori where status='Selesai' group by a.kode_pasien");

          $no=1;
              while ($data = mysqli_fetch_array($query)) {  ?>

              <tr>
              <td><?php echo $no++; ?></td>

                <td><?php echo $data['nama_pasien']; ?></td>
                <td><?php echo $data['jenis_kelamin']; ?></td>

                <td class="text-nowrap"><?php echo $data['alamat_pasien']; ?></td>
                <td><?php echo $data['tanggal_lahir']?></td>
                <td><?php echo $data['no_telepon']; ?></td>
            
                <td>
                  <!-- <a class="btn bg-info text-white" href="?page=history-detail&id=<?php echo $data['id_pasien']; ?>">Detail
                  </a> -->
            

                  <!-- <a class="btn text-warning" href="../history/print2.php?id=<?php echo $data['id_pasien']; ?>"
                    target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Data"><i class="fas fa-print"></i>
                  </a> -->


<a class="btn text-primary" href="?page=history-detail&id=<?php echo $data['id_pasien']; ?>"
                     data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Data"><i class="fas fa-eye"></i>
                  </a>
                  <a class="btn text-info" href="?page=history-edit&id=<?php echo $data['id_pasien']; ?>"><i class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data"></i></a>

                  <a class="btn text-danger" href="?page=history-delete&id=<?php echo $data['id_pasien']; ?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data"><i class="fas fa-trash"></i></a>
                  <!-- <a class="btn text-danger" href="?page=cek_kesehatan-delete&id=<?php echo $data['id_cek_kesehatan']; ?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data"><i class="fas fa-trash"></i></a> -->
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

