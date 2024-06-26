<?php
//error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// $IK= $_SESSION['id_ttk'];



if (isset($_POST['submit'])) {
  // $selectP = $_POST['selectP'];
  //retur_alkes
  $kode_retur_alkes = $_POST['kode_retur_alkes'];
  $tanggal_retur_alkes = $_POST['tanggal_retur_alkes'];
  $id_supplier = $_POST['id_supplier'];
  

  // $total_harga = $_POST['total_harga'];
  $no_faktur = $_POST['no_faktur'];

  // $id_ttk = $_POST['id_ttk'];
  // $id_ttk = '2';


  $insert = mysqli_query($con, "INSERT INTO retur_alkes(kode_retur_alkes,id_supplier,tanggal_retur,no_faktur,status) 
  VALUES('$kode_retur_alkes','$id_supplier','$tanggal_retur_alkes','$no_faktur','Proses')");
  if (!$insert) {
    die('Query Error: ' . mysqli_error($con));

}else{
  // echo 1;
}

  $firstTableID = mysqli_insert_id($con);

  $id_detailPO_array = $_POST['id_alkes']; 

  // $id_detailPO_array = $_POST['id_detailPO']; 
  // $id_alkes_array = $_POST['id_alkes'];
  $jumlah_array = $_POST['jumlah'];
  $satuan_array = $_POST['satuan'];
  $harga_beli_alkes_array = $_POST['harga_beli_alkes'];

  $batch_number_array = $_POST['batch_number'];
  $tanggal_exp_array = $_POST['tanggal_exp'];


  $id_ketersediaan_alkes_array = $_POST['id_ketersediaan_alkes'];
  $jumlah_stok_sisa_array = $_POST['jumlah_stok_sisa'];


  // Perform the insert operation for each row
  for ($i = 0; $i < count($id_detailPO_array); $i++) {
    // Get the values for the current row
    $id_detailPO = $id_detailPO_array[$i];   
    //  $id_alkes = $id_alkes_array[$i];
    $jumlah = $jumlah_array[$i];

    $satuan = $satuan_array[$i];
    $harga_beli_alkes = $harga_beli_alkes_array[$i];

    $batch_number = $batch_number_array[$i];
    $tanggal_exp = $tanggal_exp_array[$i];
 


    // $harga = $harga_array[$i];
    // $sub_total = $sub_total_array[$i];

  //  $boxsatuan= $boxsatuan_array[$i];
  //    $tjmh= $tjmh_array[$i];
  
  //    $hargaKet= $hargaKet_array[$i];



    // Perform the insert query using the current row values
    $insert_query = "INSERT INTO detail_retur_alkes (id_retur_alkes,id_alkes, jumlah,satuan,batch_number,tanggal_kadaluarsa,value) 
                   VALUES (' $firstTableID','$id_detailPO','$jumlah','$satuan','$batch_number','$tanggal_exp','$harga_beli_alkes')";

    // Execute the insert query
    $result = mysqli_query($con, $insert_query);
    if ($result) {
      // echo "<p>query berhasil<p/>";
    } else {
      die('invalid Query : ' . mysqli_error($con));
    }
    // $firstTableIDretur = mysqli_insert_id($con);

//========update ketersediaan alkes==========

 $id_ketersediaan_alkes = $id_ketersediaan_alkes_array[$i];
 $jumlah_stok_sisa = $jumlah_stok_sisa_array[$i];


$select = mysqli_query($con, "SELECT box,jumlah_ketersediaan_alkes FROM ketersediaan_alkes WHERE id_alkes='$id_detailPO' and batch_number='$batch_number'");
while ($row = mysqli_fetch_assoc($select)) {
  $box = $row['box'];
  $jumlah_ko = $row['jumlah_ketersediaan_alkes'];
};
if ($select) {
  // echo "<p>query select berhasil<p/>";
} else {
  die('invalid Query : ' . mysqli_error($con));
}

$jumlah_stok_box_result="";
$jumlah_stok_sisa_result="";
if($box == 0){
  $jumlah_stok_box_result = 0;
  $jumlah_hasil = $jumlah_ko - $jumlah;
  $jumlah_stok_sisa_result = $jumlah_hasil;

}else{
  $jumlah_hasil_box = $box - $jumlah;
  $jumlah_stok_box_result = $jumlah_hasil_box;
  $jumlah_isi_perbox = $jumlah_ko / $box;
  $jumlah_pengurangan_ketersediaan = $jumlah_isi_perbox * $jumlah;
  $jumlah_hasil = $jumlah_ko - $jumlah_pengurangan_ketersediaan;
  $jumlah_stok_sisa_result = $jumlah_hasil;
  // echo "jumlah_stok_box_result: $jumlah_stok_box_result<br>";
  // echo "jumlah_isi_perbox: $jumlah_isi_perbox<br>";
  // echo "jumlah_pengurangan_ketersediaan: $jumlah_pengurangan_ketersediaan<br>";
  // echo "jumlah_stok_sisa_result: $jumlah_stok_sisa_result<br>";
  
}


    $update = mysqli_query($con, "UPDATE ketersediaan_alkes SET box='$jumlah_stok_box_result', jumlah_ketersediaan_alkes='$jumlah_stok_sisa_result' WHERE id_alkes=$id_detailPO and batch_number='$batch_number'");

if ($update) {
  // echo "<p>query berhasil<p/>";
  echo "<script>window.location.href = '?page=retur_alkes-show';</script>";

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
        <h6 class="m-0 font-weight-bold text-info">Retur Alkes</h6>

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

    $query = mysqli_query($con, "SELECT kode_retur_alkes FROM retur_alkes ORDER BY kode_retur_alkes DESC LIMIT 1");
    
    if (mysqli_num_rows($query) > 0) {
      $row = mysqli_fetch_assoc($query);
      $lastKodeNumber = $row['kode_retur_alkes'];
      $lastKodeNumber = intval(substr($lastKodeNumber, 10)); // Extract the numeric part only
      $newKodeNumber = $lastKodeNumber + 1;
    } else {
      $newKodeNumber = 1;
    }
    
    $KodeNumber = 'RETS-' . $year . '-' . str_pad($newKodeNumber, 4, '0', STR_PAD_LEFT);
          ?>
              <input type="text" name="kode_retur_alkes" required="required" class="form-control" value="<?php echo $KodeNumber?>" readonly>
        


              <label for="nim" class="col-sm-4 col-form-label">Tanggal Retur</label>
              <!-- <div class="col-sm-5"> -->
              <!-- <input name="nim" type="text" class="form-control" id="nim" value="Cash" readonly required> -->
              <input type="text" class="form-control" name="tanggal_retur_alkes" value="<?php echo date('Y-m-d'); ?>" readonly>

              <!-- <form method="POST"> -->

                <!-- <label for="nim" class="col-sm-8 col-form-label">No Faktur</label>
                <input type="hidden" class="form-control" name="id_pengadaan_alkes" value="<?php echo $varP; ?>" readonly>

                <input type="text" class="form-control" name="no_faktur"  placeholder="Nomer Faktur" required> -->
                   <label for="nim" class="col-sm-8 col-form-label">Supplier</label>
                <select  name="id_supplier" id="" class="form-control" required>
                      <option value="">- Pilih -</option>
                      <?php

                      $query = mysqli_query($con, "SELECT * FROM supplier");
        
                      while ($row = mysqli_fetch_assoc($query)) {
                        $id_alkes1 = $row['id_supplier'];
                        // $id_D = $row['id_ketersediaan_alkes'];
                        $nama = $row['nama_supplier'];


                        // $kode_retur_alkes = $row['kode_retur_alkes'];
                        // $idd = 2;
                        echo '<option value="' . $id_alkes1 . '" >' . $nama . '</option>';
                      }

                      ?>
                    </select>
                    <label for="nim" class="col-sm-8 col-form-label">No Faktur</label>
                <select  name="no_faktur" id="" class="form-control" required>
                      <option value="">- Pilih -</option>
                      <?php

                      $query = mysqli_query($con, "SELECT no_faktur FROM penerimaan_alkes");
        
                      while ($row = mysqli_fetch_assoc($query)) {
                        // $id_alkes1 = $row['no_faktur'];
                        // $id_D = $row['id_ketersediaan_alkes'];
                        $nama = $row['no_faktur'];


                        // $kode_retur_alkes = $row['kode_retur_alkes'];
                        // $idd = 2;
                        echo '<option value="' . $nama . '" >' . $nama . '</option>';
                      }

                      ?>
                    </select>
                <!-- <button type="submit" class="btn btn-primary" name="submit2"><i class="fas fa-plane"></i>
                  Go</button> -->
              <!-- </form> -->

            </div>
          </div>

          <hr>

          <div class="row mb-3">

            <table id="myTableRETS" class="table table-bordered" style="width:100%">
              <thead>
                <tr align="center">
                  <th>#</th>
                  <th>Produk</th>
                  <th>Qty</th>
                  <th>Satuan</th>
                 
                  <th>Batch Number</th>
                  <th>Exp. Date</th>
                  <!-- <th>Harga <span class="required">(Rp)</span></th> -->
                  <!-- <th>Tipe Diskon</th>
                          <th>Diskon</th> -->
                  <!-- <th>Total Harga <span class="required">(Rp)</span></th> -->


                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td width="15%">
                    <select id="select-option-retur" name="id_detailPO[]" id="" class="form-control select-option-retur" required>
                      <option value="">- Pilih -</option>
                      <?php

                      $query = mysqli_query($con, "SELECT a.*,b.nama_alkes nama FROM ketersediaan_alkes a join alkes b on a.id_alkes=b.id_alkes order by nama");
        
                      while ($row = mysqli_fetch_assoc($query)) {
                        // $id_alkes1 = $row['id_alkes'];
                        $id_D = $row['id_ketersediaan_alkes'];
                        $nama = $row['nama'];
                        $bn = $row['batch_number'];



                        // $kode_retur_alkes = $row['kode_retur_alkes'];
                        // $idd = 2;
                        echo '<option value="' . $id_D . '" >' . $nama. ' - ' . $bn . '</option>';
                      }

                      ?>
                    </select>
                    <input type="hidden" class="id_alkes" name="id_alkes[]"  id="id_alkes">
                      <input type="hidden" class="id_ketersediaan_alkes" name="id_ketersediaan_alkes[]" id="id_ketetersediaan_alkes">
                    <p class="text-center mb-0">-</p>

                    <label  class="col-form-label">Stok Gudang</label>

                    </td>

    <!-- <p align="center" class="stock-left jumlah_stok_alkes" >kk</p>                         -->
                    <!-- <input type="text" required="" class="form-control-plaintext qty-inputs jumlah border-0 text-center text-secondary" name="jumlahDisplay[]" placeholder="" readonly> -->
                  <td width="9%"><input type="number" required="required" class="form-control qty-inputs jumlahALK" name="jumlah[]" placeholder="Qty">
                
                    <p class="text-center mb-0">-</p>
                    <!-- <input id="boxjumlah" type="number" class="form-control boxjumlah border-0" name="boxjumlah[]" placeholder="Isi"> -->
                    <input type="hidden" class="form-control jumlah_stok_sisa_hitung" name="tjmh[]">
                    <input type="hidden" class="form-control harga_beli_alkes" name="harga_beli_alkes[]">

                   <input type="text" class="form-control jumlah_stok_sisa border-0 text-secondary" name="jumlah_stok_sisa[]" readonly>

                  
                    <!-- <input id="hargaKet" type="hidden" class="form-control hargaKet" name="hargaKet[]"> -->


                  </td>



                  <td width="10%"><input type="text" class="form-control unit-price-input satuanALK" id="satuan" name="satuan[]" placeholder="Satuan" readonly required> 
                  <p class="text-center mb-0">-</p>
                  <input type="text" class="form-control satuanALK border-0 text-secondary" name="jumlah_stok_sisa[]" readonly>

                  <!-- <input type="text" required="required" class="form-control" name="boxsatuan[]" placeholder="Isi"> -->
    

                  <!-- <input type="text" class="form-control-plaintext unit-price-input satuan border-0 text-center text-secondary" id="satuan" name="satuanDisplay[]"  readonly>  -->
              
              
                </td>



<td>  <input name="batch_number[]" id="BNRetur" class="form-control BNRetur_retur" readonly required>
 </td>
                    <td ><input type="date" class="form-control tanggal_exps" name="tanggal_exp[]" id="tanggal_exps"  required readonly></td>
                  <td>
                    
                    <!-- <button class="btn btn-danger delete-row"><i class="fas fa-trash"></i> Hapus</button> -->
                    <button class="btn btn-danger delete-rowRET"><i class="fas fa-trash"></i></button>

                  </td>
                </tr>
              </tbody>
            </table>

          </div>

          <div class="row">

            <div class="col ">
              <button id="addRowBtnRET" class="btn btn-success"><i class="fas fa-plus"></i>
                Tambah</button>
              <!-- <button class="add-row-btn" data-row-id="1">Add Row</button> -->

            </div>
          </div>




          <hr>




            <div class="row">

              <div align="center" class="col">
                <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i>Simpan</button>
                <a href="?page=retur_alkes-show" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                  Kembali</a>
              </div>

            </div>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- </div>
</div> -->
