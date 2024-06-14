<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Obat</h6>

      </div>
      <div class="card-body">
        <a href="?page=obat-add" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a>
        <!-- <a href="../obat/print.php" class="btn btn-sm btn-info" target="_blank"><i class="fas fa-print"></i>
          Cetak
          FPDF</a> -->
        <a href="../obat/print2.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a>
        <hr>
<!-- <script>window.addEventListener('scroll', function() {
  var navbar = document.querySelector('.navbar');
  var threshold = 100; // Set your desired scroll threshold here

  if (window.scrollY > threshold) {
    navbar.classList.add('sticky');
  } else {
    navbar.classList.remove('sticky');
  }
});
</script> -->


<!-- chat gpt -->
<!-- <div class="table-responsive mt-3" style="height: 400px; overflow-y: scroll;">
  <table class="table table-bordered table-hover" id="viewobat" style="width: 100%;">
    <thead style="position: sticky; top: 0;"> -->
    <!-- ori -->
        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewObat" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
              <th >No</th>

                <th >Kode</th>
                <th >Gambar</th>
                <th > Nama</th>
                <th > Sediaan</th>

                <th >Jenis</th>
                <th >Kategori</th>
           
                <th >Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php
              include '../connection.php';
              $no = 1;
              $query = mysqli_query($con, 'SELECT * FROM obat');
              while ($data = mysqli_fetch_array($query)) { ?>

              <tr>
              <td><?php echo $no++ ?></td>

                <td><?php echo $data['kode_obat']; ?></td>
                <td ><img src="../uploads/<?php echo $data['gambar_obat']; ?>" width="200px" alt="Obat Image"></td>
                <td><?php echo $data['nama_obat']; ?></td>
                <td><?php echo $data['sediaan_obat']; ?></td>

                <td><?php echo $data['jenis_obat']; ?></td>
                <td><?php echo $data['kategori_obat']; ?></td>
       
                <td>
                  <a class="btn text-info" href="?page=obat-edit&id=<?php echo $data['id_obat']; ?>"><i
                      class="fas fa-edit"></i>
                  </a>
                  <a class="btn text-danger" href="?page=obat-delete&id=<?php echo $data['id_obat']; ?>"
                    onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fas fa-trash"></i>
                  </a>
                  <!-- <a class="btn text-success" href="../obat/print3.php?id=<?php echo $data['id_obat']; ?>"
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