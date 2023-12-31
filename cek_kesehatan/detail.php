<?php
$id = $_GET['id'];
// $result = mysqli_query($con, "SELECT * FROM detail_cek_kesehatan WHERE id_detail_cek_kesehatan=$id");
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <?php
        // $query = mysqli_query($con,  "SELECT a.*,b.kode_cek_kesehatan kode,b.tanggal_cek_kesehatan tanggal FROM detail_cek_kesehatan a join cek_kesehatan b on a.id_cek_kesehatan=b.id_cek_kesehatan  WHERE a.id_cek_kesehatan=$id ");
           $query = mysqli_query($con,  "SELECT a.*,b.nama_pasien nama FROM cek_kesehatan a join pasien b on a.id_pasien=b.id_pasien WHERE id_cek_kesehatan=$id");
        if (!$query) {
          die('Query Error: ' . mysqli_error($con));}
              while ($data = mysqli_fetch_array($query)) { ?>
        <h6 class="m-0 font-weight-bold text-info">Detail Cek Kesehatan - <span class="text-warning" ><?php echo $data['nama']; ?></span></h6>

        <h6 class="m-0 font-weight-bold text-black"><?php echo $data['kode_cek_kesehatan']?> <span class="text-warning" ><?php echo $data['tanggal_cek_kesehatan']; ?></span></h6>
        <?php
              }
              ?>

      </div>
      <div class="card-body">
        <!-- <a href="?page=detail_cek_kesehatan-add" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a> -->
        <!-- <a href="../detail_cek_kesehatan/print.php" class="btn btn-sm btn-info" target="_blank"><i class="fas fa-print"></i>
          Cetak
          FPDF</a> -->
        <!-- <a href="../detail_cek_kesehatan/print2.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a> -->

          <a href="?page=cek_kesehatan-show" class="btn btn-sm btn-danger"><i class="fas fa-chevron-left"></i>
          Kembali</a>
          <a href="?page=cek_kesehatan-edit&id=<?php echo $id ?>" class="btn btn-sm btn-info"><i class="fas fa-edit"></i>
          Edit Nilai</a>
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
  <table class="table table-bordered table-hover" id="viewdetail_cek_kesehatan" style="width: 100%;">
    <thead style="position: sticky; top: 0;"> -->
    <!-- ori -->
        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewDetailCekKesehatan-" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
              <!-- <th >Nama Obat</th> -->

                <th >Jenis Cek Kesehatan</th>
                <th >Nilai</th>
                <!-- <th >Catatan</th> -->
                <th >Biaya (Rp)</th>
               
         
                <!-- <th >Aksi</th> -->
              </tr>
            </thead>

            <tbody>
              <?php
              include '../connection.php';
              // $query = mysqli_query($con, "SELECT * FROM detail_cek_kesehatan  WHERE id_cek_kesehatan=$id ");
              $query = mysqli_query($con,"SELECT a.*, c.nama_kategori FROM detail_cek_kesehatan a JOIN kategori_cek_kesehatan c ON a.id_kategori = c.id_kategori  where id_cek_kesehatan=$id");
         
              while ($data = mysqli_fetch_array($query)) { ?>

              <tr>
           
                <td class="text-nowrap"><?php echo $data['nama_kategori']; ?></td>
                <td><?php echo $data['nilai']; ?></td>
                <!-- <td>#</td> -->

        
                <td><?php echo number_format($data['biaya'], 0, '.', ','); ?></td>




            
                <!-- <td> -->
                <!-- <a class="btn text-info" href="?page=cek_kesehatan-edit_detail&id=<?php echo $data['id_detail_cek_kesehatan']; ?>"><i
                      class="fas fa-edit"></i>
                  </a>
                  <a class="btn text-danger" href="?page=cek_kesehatan-detail_detail&id=<?php echo $data['id_detail_cek_kesehatan']; ?>"
                    onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fas fa-trash"></i>
                  </a> -->
                  <!-- <a class="btn text-success" href="../cek_kesehatan/print3.php?id=<?php echo $data['id_detail_cek_kesehatan']; ?>"
                    target="_blank"><i class="fas fa-print"></i>
                  </a> -->
                <!-- </td> -->
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