<?php
$id = $_GET['id'];
// $result = mysqli_query($con, "SELECT * FROM detail_penjualan_alkes WHERE id_detail_penjualan_alkes=$id");
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Detail Penjualan alkes</h6>
        <?php
        // $query = mysqli_query($con,  "SELECT a.*,b.kode_penjualan_alkes kode,b.tanggal_penjualan_alkes tanggal FROM detail_penjualan_alkes a join penjualan_alkes b on a.id_penjualan_alkes=b.id_penjualan_alkes  WHERE a.id_penjualan_alkes=$id ");
           $query = mysqli_query($con,  "SELECT * FROM penjualan_alkes WHERE id_penjualan_alkes=$id");
        if (!$query) {
          die('Query Error: ' . mysqli_error($con));}
              while ($data = mysqli_fetch_array($query)) { ?>

        <h6 class="m-0 font-weight-bold text-black"><?php echo $data['kode_penjualan_alkes']?> <span class="text-warning" ><?php echo $data['tanggal_penjualan_alkes']; ?></span></h6>
        <?php
              }
              ?>

      </div>
      <div class="card-body">
        <!-- <a href="?page=detail_penjualan_alkes-add" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a> -->
        <!-- <a href="../detail_penjualan_alkes/print.php" class="btn btn-sm btn-info" target="_blank"><i class="fas fa-print"></i>
          Cetak
          FPDF</a> -->
        <!-- <a href="../detail_penjualan_alkes/print2.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a> -->

          <a href="?page=penjualan_alkes-show" class="btn btn-sm btn-danger"><i class="fas fa-chevron-left"></i>
          Kembali</a>
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
  <table class="table table-bordered table-hover" id="viewdetail_penjualan_alkes" style="width: 100%;">
    <thead style="position: sticky; top: 0;"> -->
    <!-- ori -->
        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewPenjualanalkes" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
              <th >No</th>

                <th >Nama alkes</th>
                <th >Jumlah</th>
                <th >Satuan</th>

          
                <th >Harga (Rp)</th>
                <th >Total (Rp)</th>
         
                <!-- <th >Aksi</th> -->
              </tr>
            </thead>

            <tbody>
              <?php
              include '../connection.php';
              // $query = mysqli_query($con, "SELECT * FROM detail_penjualan_alkes  WHERE id_penjualan_alkes=$id ");
              $query = mysqli_query($con,"SELECT a.*, c.nama_alkes
          FROM detail_penjualan_alkes a
          JOIN stok_alkes b ON a.id_stok_alkes = b.id_stok_alkes
          JOIN alkes c ON b.id_alkes = c.id_alkes where id_penjualan_alkes=$id");

$no=1;
              while ($data = mysqli_fetch_array($query)) { ?>

              <tr>
                <td><?php echo $no++; ?></td>
                <td class="text-nowrap"><?php echo $data['nama_alkes']; ?></td>
                <td><?php echo $data['jumlah_detail_penjualan_alkes']; ?></td>
                <td><?php echo $data['satuan']; ?></td>

                <!-- <td><?php echo $data['harga_detail_penjualan_alkes']; ?></td> -->
                <td><?php echo number_format($data['harga_detail_penjualan_alkes'], 0, '.', '.'); ?></td>


                <!-- <td><?php echo $data['total_harga_detail_penjualan_alkes']; ?></td> -->
                <td><?php echo number_format($data['total_harga_detail_penjualan_alkes'], 0, '.', '.'); ?></td>

            
                <!-- <td>
                <a class="btn text-info" href="?page=kasir-edit&id=<?php echo $data['id_kasir']; ?>"><i
                      class="fas fa-edit"></i>
                  </a>
                  <a class="btn text-danger" href="?page=kasir-delete&id=<?php echo $data['id_kasir']; ?>"
                    onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fas fa-trash"></i>
                  </a> -->
                  <!-- <a class="btn text-success" href="../kasir/print3.php?id=<?php echo $data['id_kasir']; ?>"
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