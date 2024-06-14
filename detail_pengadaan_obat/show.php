<?php
$id = $_GET['id'];
// $result = mysqli_query($con, "SELECT * FROM detail_penjualan_obat WHERE id_detail_penjualan_obat=$id");
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Detail Pengadaan Obat</h6>
        <?php
        // $query = mysqli_query($con,  "SELECT a.*,b.kode_penjualan_obat kode,b.tanggal_penjualan_obat tanggal FROM detail_penjualan_obat a join penjualan_obat b on a.id_penjualan_obat=b.id_penjualan_obat  WHERE a.id_penjualan_obat=$id ");
           $query = mysqli_query($con,  "SELECT * FROM pengadaan_obat WHERE id_pengadaan_obat=$id");
        if (!$query) {
          die('Query Error: ' . mysqli_error($con));}
              while ($data = mysqli_fetch_array($query)) { ?>

        <h6 class="m-0 font-weight-bold text-black"><?php echo $data['kode']?> <span class="text-warning" ><?php echo $data['tanggal']; ?></span></h6>
     

      </div>
      <div class="card-body">
        <!-- <a  href="?page=detail_pengadaan_obat-add&id=<?php echo $id; ?>" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a> -->
        <?php
              }
              ?>
        <!-- <a href="../detail_pengadaan_obat/print2.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a> -->

          <a href="?page=pengadaan_obat-show" class="btn btn-sm btn-danger"><i class="fas fa-chevron-left"></i>
          Kembali</a>
          <a href="?page=detail_pengadaan_obat-add&id=<?php echo $id ?>" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a>
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
  <table class="table table-bordered table-hover" id="viewdetail_penjualan_obat" style="width: 100%;">
    <thead style="position: sticky; top: 0;"> -->
    <!-- ori -->
        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewPenjualanObat" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
              <th >No</th>

                <th >Nama Obat</th>
                <th >Jumlah</th>
                <th >Satuan</th>
          
                <!-- <th >Harga Jual (Rp)</th> -->
                <!-- <th >Tanggal</th> -->

         
                <th >Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php
              include '../connection.php';
              // $query = mysqli_query($con, "SELECT * FROM detail_penjualan_obat  WHERE id_penjualan_obat=$id ");
              $query = mysqli_query($con,"SELECT a.*, c.nama_obat
          FROM detail_pengadaan_obat a
          -- JOIN pengadaan_obat b ON a.id_pengadaan_obat = b.id_pengadaan_obat
          JOIN obat c ON a.id_obat = c.id_obat where id_pengadaan_obat=$id ");
$no=1;
              while ($data = mysqli_fetch_array($query)) { ?>

              <tr>
                <td><?php echo $no++ ?></td>
                <td class="text-nowrap"><?php echo $data['nama_obat']; ?></td>
                <td><?php echo $data['jumlah']; ?></td>
                <td><?php echo $data['satuan']; ?></td>
                <!-- <td><?php echo $data['tanggal']; ?></td> -->

                <!-- <td><?php echo $data['harga_detail_pengadaan_obat']; ?></td> -->
                <!-- <td><?php echo number_format($data['harga_jual_obat'], 0, '.', '.'); ?></td> -->

                <!-- <td><?php echo $data['tanggal_kadaluarsa']; ?></td> -->
                <!-- <td><?php echo $data['tanggal_masuk_obat']; ?></td> -->


            

            
                <td>
                <a class="btn text-info" href="?page=detail_pengadaan_obat-edit&id=<?php echo $data['id_detail_pengadaan_obat']; ?>"><i
                      class="fas fa-edit"></i>
                  </a>
                  <a class="btn text-danger" href="?page=detail_pengadaan_obat-delete&id=<?php echo $data['id_detail_pengadaan_obat']; ?>"
                    onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fas fa-trash"></i>
                  </a>
                  <!-- <a class="btn text-success" href="../detail_pengadaan_obat/print3.php?id=<?php echo $data['id_detail_pengadaan_obat']; ?>"
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