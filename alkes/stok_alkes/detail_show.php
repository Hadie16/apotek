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
        <h6 class="m-0 font-weight-bold text-info">Detail Stok Alkes</h6>
        <?php
        // $query = mysqli_query($con,  "SELECT a.*,b.kode_penjualan_alkes kode,b.tanggal_penjualan_alkes tanggal FROM detail_penjualan_alkes a join penjualan_alkes b on a.id_penjualan_alkes=b.id_penjualan_alkes  WHERE a.id_penjualan_alkes=$id ");
           $query = mysqli_query($con,  "SELECT * FROM stok_alkes WHERE id_alkes=$id limit 1");
        if (!$query) {
          die('Query Error: ' . mysqli_error($con));}
              while ($data = mysqli_fetch_array($query)) { ?>

        <h6 class="m-0 font-weight-bold text-black"> <span class="text-warning" ><?php echo $data['tanggal_kadaluarsa_alkes']; ?></span></h6>
        <?php
              }
              ?>

      </div>
      <div class="card-body">
        <!-- <a href="?page=detail_stok_alkes-add" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a> -->
        <!-- <a href="../detail_stok_alkes/print.php" class="btn btn-sm btn-info" target="_blank"><i class="fas fa-print"></i>
          Cetak
          FPDF</a> -->
        <!-- <a href="../detail_stok_alkes/print2.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a> -->

          <a href="?page=stok_alkes-show" class="btn btn-sm btn-danger"><i class="fas fa-chevron-left"></i>
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
          <table class="table table-bordered table-hover" id="viewDSO" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
              <th >No</th>

                <th >Nama Alkes</th>
                <th >Jumlah</th>
                <th >Satuan</th>

          
                <th >Harga Jual (Rp)</th>
                <th >Tanggal Kedaluwarsa</th>
         
                <th >Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php
              include '../connection.php';
              // $query = mysqli_query($con, "SELECT * FROM detail_penjualan_alkes  WHERE id_penjualan_alkes=$id ");
              $query = mysqli_query($con,"SELECT a.*, c.nama_alkes
          FROM stok_alkes a
          JOIN alkes c ON a.id_alkes = c.id_alkes where a.id_alkes=$id and a.jumlah_stok_alkes > 0");
          //   if ($query) {
          //     echo "<p>query berhasil<p/>";
          // } else {
          //     die('invalid Query : ' . mysqli_error($con));
          // }
$no=1;
$idsALK=1;
$idssALK=1;
              while ($data = mysqli_fetch_array($query)) { ?>

              <tr>
                <td><?php echo $no++ ?></td>
                <td class="text-nowrap"><?php echo $data['nama_alkes']; ?></td>
                <td><?php echo $data['jumlah_stok_alkes']; ?></td>
                <td><?php echo $data['satuan']; ?></td>
                <td><?php echo number_format($data['harga_jual_alkes'], 0, '.', '.'); ?></td>

                <td><?php echo $data['tanggal_kadaluarsa_alkes']; ?></td>
                <!-- <td><?php echo $data['tanggal_masuk_alkes']; ?></td> -->


            

            
                <td>
                <a id="alk<?php echo $idsALK++ ?>" class="btn text-info" href="?page=stok_alkes-edit&id=<?php echo $data['id_stok_alkes']; ?>"><i
                      class="fas fa-edit"></i>
                  </a>
                  <script>

  <?php $cd = date("Y-m-d");?>



    // Your condition check, for example:
    var condition = Date.parse('<?php echo $data['tanggal_kadaluarsa_obat'];?>'); // Change this to your condition

    // Get the link element
    var editLinks = document.getElementById('alk<?php echo $idssALK++ ?>');

    // Check the condition
    if (condition < Date.parse('<?php echo $cd ?>')) {

      // editLinksArray.forEach(function(link) {
        // Disable the link
        editLinks.removeAttribute('href'); // Remove the href attribute
        editLinks.style.pointerEvents = 'none'; // Disable pointer events
        // editLinks.style.color = '#999'; // Optionally change editLinks color to indicate it's disabled
        editLinks.classList.remove('text-info'); // Add a class to change color
        editLinks.classList.add('text-secondary'); // Add a class to change color
      // });
    }

</script>
                  <a class="btn text-danger" href="?page=stok_alkes-detail_delete&id=<?php echo $data['id_stok_alkes']; ?>"
                    onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fas fa-trash"></i>
                  </a>
                  <!-- <a class="btn text-success" href="../detail_stok_alkes/print3.php?id=<?php echo $data['id_detail_stok_alkes']; ?>"
                    target="_blank"><i class="fas fa-print"></i> -->
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