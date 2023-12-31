<?php
//error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// $IK= $_SESSION['id_ttk'];

$varP = $_GET['id1'];
// $kodeP = $_GET['id2'];
$queryLog = "SELECT * FROM pengadaan_obat WHERE id_pengadaan_obat = $varP";
$resultLog = mysqli_query($con, $queryLog);
$rowLog = mysqli_fetch_assoc($resultLog);
$id_supplier=$rowLog['id_supplier'];
// $id_ttk =  $IK;

if (isset($_POST['submit'])) {
  // $selectP = $_POST['selectP'];
  //penerimaan_obat
  $kode_penerimaan_obat = $_POST['kode_penerimaan_obat'];
  $tanggal_penerimaan_obat = $_POST['tanggal_penerimaan_obat'];
  $total_harga = $_POST['total_harga'];
  $no_faktur = $_POST['no_faktur'];

  // $id_ttk = $_POST['id_ttk'];
  // $id_ttk = '2';


  $insert = mysqli_query($con, "INSERT INTO penerimaan_obat(kode_penerimaan_obat,no_faktur,tanggal_penerimaan_obat,total_harga,id_supplier) 
  VALUES('$kode_penerimaan_obat','$no_faktur','$tanggal_penerimaan_obat','$total_harga','$id_supplier')");
  if (!$insert) {
    die('Query Error: ' . mysqli_error($con));

}else{
  echo 1;
}

  $firstTableID = mysqli_insert_id($con);

  // ============== ==== ===  update status pengadaan
 $updatePO = mysqli_query($con, "UPDATE pengadaan_obat SET status='Diterima' WHERE id_pengadaan_obat=$varP");


  //kode_penerimaan_obat tambahan
  // Retrieve the posted data
  $id_detailPO_array = $_POST['id_detailPO']; 
   $id_obat_array = $_POST['id_obat'];
  $jumlah_array = $_POST['jumlah'];
  $satuan_array = $_POST['satuan'];
  $tanggal_exp_array = $_POST['tanggal_exp'];
  $batch_number_array = $_POST['batch_number'];

  $harga_array = $_POST['harga'];
  $sub_total_array = $_POST['sub_total'];


  //box
  $boxsatuan_array = []; // Providing a default value
  $tjmh_array = [];
  $hargaKet_array = [];
  $box_array = [];

  if ($_POST['boxjumlah']!==['']) {
      $boxsatuan_array = $_POST['boxsatuan'];
      $tjmh_array = $_POST['tjmh'];
      $hargaKet_array = $_POST['hargaKet'];
      $box_array =  $_POST['jumlah'];

  }else{
    $boxsatuan_array = $_POST['satuan'];
    $tjmh_array = $_POST['jumlah'];
    $hargaKet_array = $_POST['harga'];
    $box_array = 0;

  }
 
  // Perform the insert operation for each row
  for ($i = 0; $i < count($id_detailPO_array); $i++) {
    // Get the values for the current row
    $id_detailPO = $id_detailPO_array[$i];   
     $id_obat = $id_obat_array[$i];
    $jumlah = $jumlah_array[$i];

    $satuan = $satuan_array[$i];
    $tanggal_exp = $tanggal_exp_array[$i];
    $batch_number = $batch_number_array[$i];


    $harga = $harga_array[$i];
    $sub_total = $sub_total_array[$i];

   $boxsatuan= $boxsatuan_array[$i];
     $tjmh= $tjmh_array[$i];
  
     $hargaKet= $hargaKet_array[$i];
     $box = $box_array[$i];


    //stok
    // $jumlah_stok_sisa = $jumlah_stok_sisa_array[$i];


    // Perform the insert query using the current row values
    $insert_query = "INSERT INTO detail_penerimaan_obat (id_penerimaan_obat,id_obat, jumlah_detail_penerimaan_obat,satuan,tanggal_kadaluarsa,batch_number,harga_detail_penerimaan_obat,sub_total) 
                   VALUES (' $firstTableID','$id_obat','$jumlah','$satuan','$tanggal_exp','$batch_number','$harga','$sub_total')";

    // Execute the insert query
    $result = mysqli_query($con, $insert_query);
    if ($result) {
      echo "<p>query berhasil<p/>";
    } else {
      die('invalid Query : ' . mysqli_error($con));
    }
    $firstTableIDPenerimaan = mysqli_insert_id($con);




  $insert = mysqli_query($con, "INSERT INTO ketersediaan_obat(id_obat,box,jumlah_ketersediaan_obat,satuan,harga_beli_obat,tanggal_kadaluarsa_obat,batch_number,id_supplier) 
  VALUES('$id_obat','$box','$tjmh','$boxsatuan','$hargaKet','$tanggal_exp','$batch_number','$id_supplier')");

if ($insert) {
  echo "<p>query berhasil<p/>";
  echo "<script>window.location.href = '?page=penerimaan_obat-show';</script>";

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
        <h6 class="m-0 font-weight-bold text-info">Penerimaan Obat</h6>

      </div>
      <div class="card-body">
 
        <form method="POST">

          <div class="row mb-3">
          <div class="col-sm-2 offset-sm-1 text-center">
    <img src="../assets/img/logo_mahabbah-removebg-preview.png" alt="Apotek Logo" width="80">
    <p style="color: #333;">Apotek Mahabbah</p>
  </div>
            <div class="col-sm-5 offset-sm-2">
              <label for="nim" class="col-sm-2 col-form-label">Kode</label>

              <?php
    // Get the current year
    $year = date('Y');

    $query = mysqli_query($con, "SELECT kode_penerimaan_obat FROM penerimaan_obat ORDER BY kode_penerimaan_obat DESC LIMIT 1");
    
    if (mysqli_num_rows($query) > 0) {
      $row = mysqli_fetch_assoc($query);
      $lastKodeNumber = $row['kode_penerimaan_obat'];
      $lastKodeNumber = intval(substr($lastKodeNumber, 9)); // Extract the numeric part only
      $newKodeNumber = $lastKodeNumber + 1;
    } else {
      $newKodeNumber = 1;
    }
    
    $KodeNumber = 'PNM-' . $year . '-' . str_pad($newKodeNumber, 4, '0', STR_PAD_LEFT);
          ?>
              <input type="text" name="kode_penerimaan_obat" required="required" class="form-control" value="<?php echo $KodeNumber?>" readonly>
        


              <label for="nim" class="col-sm-4 col-form-label">Tanggal Terima</label>
              <!-- <div class="col-sm-5"> -->
              <!-- <input name="nim" type="text" class="form-control" id="nim" value="Cash" readonly required> -->
              <input type="text" class="form-control" name="tanggal_penerimaan_obat" value="<?php echo date('Y-m-d'); ?>" readonly>

              <!-- <form method="POST"> -->

                <label for="nim" class="col-sm-8 col-form-label">No Faktur</label>
                <input type="hidden" class="form-control" name="id_pengadaan_obat" value="<?php echo $varP; ?>" readonly>

                <input type="text" class="form-control" name="no_faktur"  placeholder="Nomer Faktur" required>

                <!-- <button type="submit" class="btn btn-primary" name="submit2"><i class="fas fa-plane"></i>
                  Go</button> -->
              <!-- </form> -->

            </div>
          </div>

          <hr>

          <div class="row mb-3">

            <table id="myTablePNM" class="table table-bordered" style="width:100%">
              <thead>
                <tr align="center">
                  <th>#</th>
                  <th>Produk</th>
                  <th>Qty</th>
                  <th>Satuan</th>
                  <th>Exp. Date</th>
                  <th>Batch Number</th>

                  <th>Harga <span class="required">(Rp)</span></th>
                  <!-- <th>Tipe Diskon</th>
                          <th>Diskon</th> -->
                  <th>Total Harga <span class="required">(Rp)</span></th>


                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td width="15%">
                    <select name="id_detailPO[]" id="" class="form-control select-options select-option2" required>
                      <option value="">- Pilih -</option>
                      <?php

                      $query = mysqli_query($con, "SELECT a.*,b.nama_obat nama FROM detail_pengadaan_obat a join obat b on a.id_obat=b.id_obat where id_pengadaan_obat=$varP");
        
                      while ($row = mysqli_fetch_assoc($query)) {
                        // $id_obat1 = $row['id_obat'];
                        $id_D = $row['id_detail_pengadaan_obat'] . "pesan";
                        $nama = $row['nama'];


                        // $kode_penerimaan_obat = $row['kode_penerimaan_obat'];
                        // $idd = 2;
                        echo '<option value="' . $id_D . '" >' . $nama . '</option>';
                      }

                      ?>
                    </select>

                      <input type="hidden" name="id_obat[]" id="result_id_obat">
                    <p class="text-center mb-0">-</p>

                    <label id="lb" style="display: none;" class="col-form-label lb">Isi Per Box</label>

                    </td>

    <!-- <p align="center" class="stock-left jumlah_stok_obat" >kk</p>                         -->
                    <!-- <input type="text" required="" class="form-control-plaintext qty-inputs jumlah border-0 text-center text-secondary" name="jumlahDisplay[]" placeholder="" readonly> -->
                  <td width="9%"><input type="number" required="required" class="form-control qty-inputs jumlah" name="jumlah[]" placeholder="Qty">
                
                    <p class="text-center mb-0">-</p>
                    <input id="boxjumlah" style="display: none;" type="number" class="form-control boxjumlah" name="boxjumlah[]" placeholder="Isi">

                    <input id="tjmh" type="hidden" class="form-control tjmh" name="tjmh[]">
                    <input id="hargaKet" type="hidden" class="form-control hargaKet" name="hargaKet[]">


                  </td>



                  <td width="15px"><input type="text" class="form-control unit-price-input satuan" id="satuan" name="satuan[]" placeholder="Satuan" readonly required> 
                  <p class="text-center mb-0">-</p>

                  <!-- <input type="text" required="required" class="form-control" name="boxsatuan[]" placeholder="Isi"> -->
                  <select id="boxsatuan" style="display: none;" class="form-control boxsatuan" name="boxsatuan[]">
  <option value="">*</option>

  <option value="Strip">Strip</option>
  <option value="Sachet">Sachet</option>
  <option value="Botol">Botol</option>
  <option value="Pcs">Pcs</option>
                            <option value="Tube" >Tube</option>
</select>


                  <!-- <input type="text" class="form-control-plaintext unit-price-input satuan border-0 text-center text-secondary" id="satuan" name="satuanDisplay[]"  readonly>  -->
              
              
                </td>


<td ><input type="date" class="form-control" name="tanggal_exp[]"  required></td>
<td><input type="text" class="form-control unit-price-input batch_number" id="batch_number" name="batch_number[]" placeholder="BN" required> </td>
                  <td><input type="text" class="form-control unit-price-inputs" id="harga" name="harga[]" placeholder="Harga" required> </td>
                  <!-- <td>
                          <select class="form-control">
                            <option>Discount Type</option>
                            <option>fixed</option>
                          </select></td>
                          <td><input type="text" required="required" class="form-control" placeholder="Discount Price"></td> -->
                  <td><input type="text" required="required" class="form-control total-amount-inputss" name="sub_total[]" placeholder="0.00" readonly></td>
                  <td>
                    <!-- <button class="btn btn-danger delete-row"><i class="fas fa-trash"></i> Hapus</button> -->
                    <button class="btn btn-danger delete-rowPNM"><i class="fas fa-trash"></i></button>

                  </td>
                </tr>
              </tbody>
            </table>

          </div>

          <div class="row">

            <div class="col ">
              <button id="addRowBtnPNM" class="btn btn-success"><i class="fas fa-plus"></i>
                Tambah</button>
              <!-- <button class="add-row-btn" data-row-id="1">Add Row</button> -->

            </div>
          </div>




          <hr>

          <div class="col-sm-10 ">

            <h1 align="center">Total Harga</h1>
            <!-- <div class="row mb-3"> -->
            <!-- <label for="jumlah_ketersediaan_obat" class="col-sm-2 col-form-label">Jumlah</label> -->
            <!-- <div class="col-sm-5"> -->
            <div align="center">
              <input type="text" align="center" id="grandTotals" class="form-control" style="display: inline-block; width: 300px; height: 50px; font-size: 24px;" name="total_harga" readonly>
            </div>

            <br>

            <!-- <input type="number" class="form-control" id="jumlah_ketersediaan_obat" name="jumlah_ketersediaan_obat"> -->
            <!-- </div> -->
            <!-- </div> -->




            <div class="row">

              <div align="center" class="col">
                <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i>Simpan</button>
                <a href="?page=penerimaan_obat-show" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                  Kembali</a>
              </div>

            </div>
        </form>
      </div>

    </div>
  </div>
</div>
</div>