<?php
//error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_POST['submit'])) {
  // $id_pengadaan_alkes = $_POST['id_pengadaan_alkes'];
  //pengadaan_alkes
  $kode_pengadaan_alkes = $_POST['kode_pengadaan_alkes'];
  $tanggal_pengadaan_alkes = $_POST['tanggal_pengadaan_alkes'];
  // $total_harga = $_POST['harga'];
  $id_supplier = $_POST['id_supplier'];
  // $id_kasir = '2';

$jenis_produk_array = $_POST['id_alkes'];
 $jenis_produk = count($jenis_produk_array); 

  $insert = mysqli_query($con, "INSERT INTO pengadaan_alkes(kode,jenis_produk,tanggal,id_supplier,status) 
  VALUES('$kode_pengadaan_alkes','$jenis_produk','$tanggal_pengadaan_alkes','$id_supplier','Dipesan')");

if ($insert) {
  // echo "<p>query berhasil<p/>";
} else {
  die('invalid Query : ' . mysqli_error($con));
}
 $firstTableID = mysqli_insert_id($con);


//kode tambahan
// Retrieve the posted data
$id_alkes_array = $_POST['id_alkes'];
$jumlah_array = $_POST['jumlah'];
$satuan_array = $_POST['satuan'];
// $total_satuan_array = $_POST['total_satuan'];

//stok
// $jumlah_stok_sisa_array = $_POST['jumlah_stok_sisa'];


// Perform the insert operation for each row
for ($i = 0; $i < count($id_alkes_array); $i++) {
  // Get the values for the current row
  $id_alkes = $id_alkes_array[$i];
  $jumlah = $jumlah_array[$i];
  $satuan = $satuan_array[$i];
  // $total_satuan = $total_satuan_array[$i];

  //stok
  // $jumlah_stok_sisa= $jumlah_stok_sisa_array[$i];


  // Perform the insert query using the current row values
  $insert_query = "INSERT INTO detail_pengadaan_alkes (id_pengadaan_alkes,id_alkes,jumlah,satuan) VALUES ('$firstTableID','$id_alkes','$jumlah','$satuan')";

  // Execute the insert query
  $result = mysqli_query($con, $insert_query);

  if ($result) {
    // echo "<p>query berhasil<p/>";
    echo "<script>window.location.href = '?page=pengadaan_alkes-show';</script>";

} else {
    die('invalid Query : ' . mysqli_error($con));
}

}



}
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>
<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Pengadaan Alkes</h6>

      </div>
      <div class="card-body">
        <form method="POST">

          <div class="row mb-3">
          <div class="col-sm-2 offset-sm-1 text-center">
    <img src="../assets/img/logo_mahabbah-removebg-preview.png" alt="Apotek Logo" width="80">
    <p style="color: #333;">Apotek Mahabbah</p>
  </div>
                  
<?php
    // Get the current year
    $year = date('Y');

    $query = mysqli_query($con, "SELECT kode FROM pengadaan_alkes ORDER BY kode DESC LIMIT 1");
    
    if (mysqli_num_rows($query) > 0) {
      $row = mysqli_fetch_assoc($query);
      $lastKodeNumber = $row['kode'];
      $lastKodeNumber = intval(substr($lastKodeNumber, 10)); // Extract the numeric part only
      $newKodeNumber = $lastKodeNumber + 1;
    } else {
      $newKodeNumber = 1;
    }
    
    $KodeNumber = 'PGDS-' . $year . '-' . str_pad($newKodeNumber, 4, '0', STR_PAD_LEFT);

    ?>
    <div class="col-sm-5 offset-sm-2">
            <label for="nim" class="col-sm-2 col-form-label">Kode</label>
            <input type="text" name="kode_pengadaan_alkes" required="required" class="form-control" value="<?php echo $KodeNumber ?>" readonly>
            <!-- <div class="col-sm-5"> -->
              <!-- <input name="nim" type="text" class="form-control" id="nim" readonly required> -->
          
            <label for="nim" class="col-sm-8 col-form-label">Tanggal Pengadaan</label>
            <!-- <div class="col-sm-5"> -->
              <!-- <input name="nim" type="text" class="form-control" id="nim" value="Cash" readonly required> -->
              <input type="text" class="form-control" name="tanggal_pengadaan_alkes" value="<?php echo date('Y-m-d'); ?>" >

              <label for="supplier" class="col-sm-4 col-form-label">Supplier</label>
  
              <select name="id_supplier" id="id_supplier" class="form-control" required>
        <option value="">- Pilih -</option>
        <?php
        $query = mysqli_query($con, "SELECT id_supplier, nama_supplier FROM supplier");
        while ($row = mysqli_fetch_assoc($query)) {
            $id_supplier = $row['id_supplier'];
            $nama_supplier = $row['nama_supplier'];
            echo '<option value="' . $id_supplier . '">' . $nama_supplier . '</option>';
        }
        ?>
    </select>
            </div>
          </div>

          <hr>

          <div class="row mb-3">

          <table id="myTablePGD" class="table table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Produk</th>
                          <th>Qty</th>
                          <!-- <th>Harga <span class="required">(Rp)</span></th> -->
                          <!-- <th>Tipe Diskon</th>
                          <th>Diskon</th> -->
                          <th>Satuan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>
                          <select name="id_alkes[]" id="id_alkes" class="form-control" required>
        <option value="">- Pilih -</option>
        <?php
        $query = mysqli_query($con, "SELECT id_alkes, nama_alkes FROM alkes");
        while ($row = mysqli_fetch_assoc($query)) {
            $id_alkes = $row['id_alkes'];
            $nama_alkes = $row['nama_alkes'];
            echo '<option value="' . $id_alkes . '">' . $nama_alkes . '</option>';
        }
        ?>
    </select>
                        </td>
                          <td><input type="number" required="required" class="form-control" name="jumlah[]" placeholder="Enter Qty">
      </td>

                          <!-- <td><input type="text" class="form-control unit-price-input harga_jual_alkes" id="harga_jual_alkes" name="harga[]" placeholder="Unit Price" required> </td> -->
                          <!-- <td>
                          <select class="form-control">
                            <option>Discount Type</option>
                            <option>fixed</option>
                          </select></td>
                          <td><input type="text" required="required" class="form-control" placeholder="Discount Price"></td> -->
                          <td>
                            <!-- <input type="text" required="required" class="form-control" name="satuan[]" placeholder="Satuan"> -->
                          <select  required="required" class="form-control" name="satuan[]"  >
                            <option value="" >- Pilih -</option>
                            <option value="Box" >Box</option>
                            <option value="Pcs" >Pcs</option>
                            <option value="Unit" >Unit</option>
                            <option value="Pack" >Pack</option>
                            <option value="Botol" >Botol</option>



                            
                            


                          </select>
                          </td>
                          <td>
    <button class="btn btn-danger delete-rowPGD"><i class="fas fa-trash"></i> Hapus</button>
  </td>
                        </tr>
                      </tbody>
                    </table>

                    </div>

                    <div class="row">

<div class="col ">
  <button id="addRowBtnPGD" class="btn btn-success"><i class="fas fa-plus"></i>
    Tambah</button>
    <!-- <button class="add-row-btn" data-row-id="1">Add Row</button> -->

</div>
</div>




<hr>

<div class="col-sm-10 ">

  <!-- <h1 align="center">Total Harga</h1> -->
          <!-- <div class="row mb-3"> -->
            <!-- <label for="jumlah_ketersediaan_alkes" class="col-sm-2 col-form-label">Jumlah</label> -->
            <!-- <div class="col-sm-5"> -->
              <!-- <div align="center">
               <input type="text" align="center" id="grandTotal" class="form-control" style="display: inline-block; width: 300px; height: 50px; font-size: 24px;" name="total_harga" readonly>   
              </div> -->

<br>

              <!-- <input type="number" class="form-control" id="jumlah_ketersediaan_alkes" name="jumlah_ketersediaan_alkes"> -->
            <!-- </div> -->
          <!-- </div> -->


       

          <div class="row">

            <div align="center" class="col">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=pengadaan_alkes-show" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>

          </div>
        </form>
        </div>

      </div>
    </div>
  </div>
</div>