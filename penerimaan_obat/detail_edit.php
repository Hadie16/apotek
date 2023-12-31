<?php

// <td><?php echo number_format($data['sub_total'], 0, '.', '.');
$id = $_GET['id'];
$query = mysqli_query($con,  "SELECT a.*,b.kode_penerimaan_obat FROM detail_penerimaan_obat a join penerimaan_obat b on a.id_penerimaan_obat=b.id_penerimaan_obat  WHERE id_detail_penerimaan_obat=$id");
if (!$query) {
  die('Query Error: ' . mysqli_error($con));}
      while ($data = mysqli_fetch_array($query)) { 
      $kode_penerimaan_obat =  $data['kode_penerimaan_obat'];
      $id_penerimaan_obat =  $data['id_penerimaan_obat'];


      $id_obat = $data['id_obat'];
      $jumlah = $data['jumlah_detail_penerimaan_obat'];
      $satuan = $data['satuan'];
      $tanggal_kadaluarsa = $data['tanggal_kadaluarsa'];
      $batch_number = $data['batch_number'];
      $harga_detail_penerimaan_obat = $data['harga_detail_penerimaan_obat'];
      $sub_total = $data['sub_total'];


      }


if (isset($_POST['submit'])) {
  $kode_penerimaan_obat = $_POST['kode_penerimaan_obat'];
  $id_obat = $_POST['id_obat'];
  $jumlah = $_POST['jumlah'];
  $satuan = $_POST['satuan'];
  $tanggal_kadaluarsa = $_POST['tanggal_kadaluarsa'];
  $batch_number = $_POST['batch_number'];
  $harga_detail_penerimaan_obat = $_POST['harga_detail_penerimaan_obat'];
  $sub_total = $_POST['sub_total'];

  $update = mysqli_query($con, "UPDATE detail_penerimaan_obat 
    SET jumlah_detail_penerimaan_obat = '$jumlah', 
        satuan = '$satuan', 
        tanggal_kadaluarsa = '$tanggal_kadaluarsa', 
        batch_number = '$batch_number', 
        harga_detail_penerimaan_obat = '$harga_detail_penerimaan_obat', 
        sub_total = '$sub_total' 
    WHERE id_detail_penerimaan_obat = '$id'");

//   if ($insert) {
//     echo "<p>query berhasil<p/>";
// } else {
//     die('invalid Query : ' . mysqli_error($con));
// }
// $update = mysqli_query($con, 'select * from detail_penerimaan_obat WHERE id_detail_penerimaan_obat = "$id"');
// $query = mysqli_query($con, 'SELECT * FROM detail_penerimaan_obat  where id_penerimaan_obat="$id_penerimaan_obat"');
$query1 = mysqli_query($con, "SELECT sum(sub_total) as total_harga FROM detail_penerimaan_obat WHERE id_penerimaan_obat='$id_penerimaan_obat'");
while ($data1 = mysqli_fetch_assoc($query1)) { 
    $total_harga =  $data1['total_harga'];
}
$update1 = mysqli_query($con, "UPDATE penerimaan_obat 
SET total_harga ='$total_harga'
WHERE id_penerimaan_obat = '$id_penerimaan_obat'");

if ($update1) {
    echo "<script>window.location.href = '?page=penerimaan_obat-detail&id=" . $id_penerimaan_obat . "';</script>";
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
        <h6 class="m-0 font-weight-bold text-info">Detail Penerimaan Obat</h6>
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="row mb-3">
            <!-- <label for="id_penerimaan_obat" >Kode Penerimaan</label> -->
            <div class="col-sm-6">
            <label for="id_penerimaan_obat" >Kode Penerimaan</label>

              <input type="text" class="form-control" id="id_penerimaan_obat" name="id_penerimaan_obat" value="<?php echo $kode_penerimaan_obat?>" readonly>
            </div>
    
            <!-- <label for="id_obat" >Nama Obat</label> -->
            <div class="col-sm-6">
            <label for="id_obat" >Nama Obat</label>

            <select name="id_obat" id="id_obat" class="form-control" required>
  <option value="">- Pilih -</option>
  <?php
  $query = mysqli_query($con, "SELECT id_obat, nama_obat FROM obat");
  while ($row = mysqli_fetch_assoc($query)) {
    $obat_id = $row['id_obat'];
    $nama_obat = $row['nama_obat'];
    if ($obat_id == $id_obat) {
      echo '<option value="' . $obat_id . '" selected>' . $nama_obat . '</option>';
    } else {
      echo '<option value="' . $obat_id . '">' . $nama_obat . '</option>';
    }
  }
  ?>
</select>

            </div>
          </div>

          <div class="row mb-3">
           
            <div class="col-sm-6">
            <label for="jumlah" >Jumlah</label>
              <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $jumlah?>"  oninput="calculateTotal()" required>
            </div>

            <!-- <label for="satuan" class="col-sm-2 col-form-label">Satuan</label> -->
            <div class="col-sm-6">
            <label for="satuan" >Satuan</label>

              <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $satuan?>"  readonly required>
            </div>
          </div>

      <div class="row mb-3">
            <!-- <label for="tanggal_kadaluarsa" class="col-sm-2 col-form-label">tanggal_kadaluarsa</label> -->
            <div class="col-sm-6">
            <label for="tanggal_kadaluarsa" >Tanggal Kadaluarsa</label>

              <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" value="<?php echo $tanggal_kadaluarsa?>"  required>
            </div>

            <!-- <label for="batch_number" class="col-sm-2 col-form-label">batch_number</label> -->
            <div class="col-sm-6">
            <label for="batch_number" >Batch Number</label>

              <input type="text" class="form-control" id="batch_number" name="batch_number" value="<?php echo $batch_number?>"  required>
            </div>
          </div>
          <div class="row mb-3">
            <!-- <label for="harga_detail_penerimaan_obat" class="col-sm-2 col-form-label">harga_detail_penerimaan_obat</label> -->
            <div class="col-sm-6">
            <label for="harga_detail_penerimaan_obat">Harga</label>

              <input type="text" class="form-control" id="harga_detail_penerimaan_obat" name="harga_detail_penerimaan_obat" value="<?php echo $harga_detail_penerimaan_obat?>" oninput="calculateTotal()" required>
            </div>
      
            <!-- <label for="sub_total">sub_total</label> -->
            <div class="col-sm-6">
            <label for="sub_total">Sub Total</label>

              <input type="text" class="form-control" id="sub_total" name="sub_total" value="<?php echo $sub_total?>"  readonly required>
            </div>
          </div>

          <script>
  function calculateTotal() {
    var quantity = parseFloat(document.getElementById("jumlah").value) || 0;
    var price = parseFloat(document.getElementById("harga_detail_penerimaan_obat").value) || 0;
    var total = quantity * price;

    // document.getElementById("sub_totalDisplay").value = number_format(total,0,'.','.');
    document.getElementById("sub_total").value = total;

    // document.getElementById("jumlah").value = number_format(quantity),0,',','.';
    // document.getElementById("harga_detail_penerimaan_obat").value = price;

  }
</script>
       
          <div class="row">
            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i> Simpan</button>
              <a href="?page=penerimaan_obat-detail&id=<?php echo $id_penerimaan_obat; ?>" class="btn btn-danger"><i class="fas fa-chevron-left"></i> Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
