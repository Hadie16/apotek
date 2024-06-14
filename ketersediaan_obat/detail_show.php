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
        <h6 class="m-0 font-weight-bold text-info">Detail Ketersediaan Obat</h6>
        <?php
        // $query = mysqli_query($con,  "SELECT a.*,b.kode_penjualan_obat kode,b.tanggal_penjualan_obat tanggal FROM detail_penjualan_obat a join penjualan_obat b on a.id_penjualan_obat=b.id_penjualan_obat  WHERE a.id_penjualan_obat=$id ");
           $query = mysqli_query($con,  "SELECT * FROM ketersediaan_obat WHERE id_obat='$id' limit 1");
        if (!$query) {
          die('Query Error: ' . mysqli_error($con));}
              while ($data = mysqli_fetch_array($query)) { ?>

        <h6 class="m-0 font-weight-bold text-black"><?php echo $data['id_obat']?> <span class="text-warning" ><?php echo $data['tanggal_kadaluarsa_obat']; ?></span></h6>
        <?php
              }
              ?>

      </div>
      <div class="card-body">


          <a href="?page=ketersediaan_obat-show" class="btn btn-sm btn-danger"><i class="fas fa-chevron-left"></i>
          Kembali</a>
        <hr>

    <!-- ori -->
        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewDKO" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
              <th >No</th>

                <th >Nama Obat</th>
                <th >Jumlah</th>
                <th >Satuan</th>

          
                <th >Harga Beli (Rp)</th>
                <th >Tanggal Kedaluwarsa</th>
         
                <th >Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php
              include '../connection.php';
              // $query = mysqli_query($con, "SELECT * FROM detail_penjualan_obat  WHERE id_penjualan_obat=$id ");
              $query = mysqli_query($con,"SELECT a.*, c.nama_obat
          FROM ketersediaan_obat a
          -- JOIN ketersediaan_obat b ON a.id_ketersediaan_obat = b.id_ketersediaan_obat
          JOIN obat c ON a.id_obat = c.id_obat where a.id_obat=$id and a.jumlah_ketersediaan_obat > 0");
           if ($query) {
            // echo "<p>query berhasil<p/>";
        } else {
            die('invalid Query : ' . mysqli_error($con));
        }
            $no=1;
              while ($data = mysqli_fetch_array($query)) { ?>

              <tr>
                <td><?php echo $no++?></td>
                <td class="text-nowrap"><?php echo $data['nama_obat']; ?></td>
                <td><?php echo $data['jumlah_ketersediaan_obat']; ?></td>
                <td><?php echo $data['satuan']; ?></td>
                <td><?php echo number_format($data['harga_beli_obat'], 0, '.', '.'); ?></td>

                <td><?php echo $data['tanggal_kadaluarsa_obat']; ?></td>
                <!-- <td><?php echo $data['tanggal_masuk_obat']; ?></td> -->


            

            
                <td>
                <a class="btn text-info" href="?page=ketersediaan_obat-edit&id=<?php echo $data['id_ketersediaan_obat']; ?>"><i
                      class="fas fa-edit"></i>
                  </a>
                  <a class="btn text-danger" href="?page=ketersediaan_obat-detail_delete&id=<?php echo $data['id_ketersediaan_obat']; ?>"
                    onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fas fa-trash"></i>
                  </a>
                  <!-- <a class="btn text-success" href="../kasir/print3.php?id=<?php echo $data['id_ketersediaan_obat']; ?>"
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