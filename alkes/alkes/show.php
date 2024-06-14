<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Alkes</h6>

      </div>
      <div class="card-body">
        <a href="?page=alkes-add" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a>
        <!-- <a href="../alkes/print.php" class="btn btn-sm btn-info" target="_blank"><i class="fas fa-print"></i>
          Cetak
          FPDF</a> -->
        <a href="../alkes/alkes/print2.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a>
        <hr>



<!-- chat gpt -->
<!-- <div class="table-responsive mt-3" style="height: 400px; overflow-y: scroll;">
  <table class="table table-bordered table-hover" id="viewalkes" style="width: 100%;">
    <thead style="position: sticky; top: 0;"> -->
    <!-- ori -->
        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewAlkes" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
              <th >No</th>
                <th >Kode</th>
                <th >Gambar</th>
                <th > Nama</th>

           
                <th >Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php
              include '../connection.php';
              $no = 1;
              $query = mysqli_query($con, 'SELECT * FROM alkes');
              while ($data = mysqli_fetch_array($query)) { ?>

              <tr>
              <td><?php echo $no++ ?></td>

                <td><?php echo $data['kode_alkes']; ?></td>
                <td ><img src="../uploads/<?php echo $data['gambar_alkes']; ?>" width="200px" alt="alkes Image"></td>
                <td><?php echo $data['nama_alkes']; ?></td>

       
                <td>
                  <a class="btn text-info" href="?page=alkes-edit&id=<?php echo $data['id_alkes']; ?>"><i
                      class="fas fa-edit"></i>
                  </a>
                  <a class="btn text-danger" href="?page=alkes-delete&id=<?php echo $data['id_alkes']; ?>"
                    onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fas fa-trash"></i>
                  </a>
                  <!-- <a class="btn text-success" href="../alkes/print3.php?id=<?php echo $data['id_alkes']; ?>"
                    target="_blank"><i class="fas fa-print"></i>
                  </a> -->
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