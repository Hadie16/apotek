<?php

// <td><?php echo number_format($data['sub_total'], 0, '.', '.');
$id = $_GET['id'];
$query = mysqli_query($con,  "SELECT a.*,b.kode_penerimaan_alkes FROM detail_penerimaan_alkes a join penerimaan_alkes b on a.id_penerimaan_alkes=b.id_penerimaan_alkes  WHERE id_detail_penerimaan_alkes=$id");
if (!$query) {
  die('Query Error: ' . mysqli_error($con));}
      while ($data = mysqli_fetch_array($query)) { 
      $kode_penerimaan_alkes =  $data['kode_penerimaan_alkes'];
      $id_penerimaan_alkes =  $data['id_penerimaan_alkes'];


      $id_alkes = $data['id_alkes'];
      $jumlah = $data['jumlah_detail_penerimaan_alkes'];
      $satuan = $data['satuan'];
      $tanggal_kadaluarsa = $data['tanggal_kadaluarsa'];
      $batch_number = $data['batch_number'];
      $harga_detail_penerimaan_alkes = $data['harga_detail_penerimaan_alkes'];
      $sub_total = $data['sub_total'];


      }


if (isset($_POST['submit'])) {
  $kode_penerimaan_alkes = $_POST['kode_penerimaan_alkes'];
  $id_alkes = $_POST['id_alkes'];
  $jumlah = $_POST['jumlah'];
  $satuan = $_POST['satuan'];
  $tanggal_kadaluarsa = $_POST['tanggal_kadaluarsa'];
  $batch_number = $_POST['batch_number'];
  $harga_detail_penerimaan_alkes = $_POST['harga_detail_penerimaan_alkes'];
  $sub_total = $_POST['sub_total'];

  $update = mysqli_query($con, "UPDATE detail_penerimaan_alkes 
    SET jumlah_detail_penerimaan_alkes = '$jumlah', 
        satuan = '$satuan', 
        tanggal_kadaluarsa = '$tanggal_kadaluarsa', 
        batch_number = '$batch_number', 
        harga_detail_penerimaan_alkes = '$harga_detail_penerimaan_alkes', 
        sub_total = '$sub_total' 
    WHERE id_detail_penerimaan_alkes = '$id'");

//   if ($insert) {
//     echo "<p>query berhasil<p/>";
// } else {
//     die('invalid Query : ' . mysqli_error($con));
// }
// $update = mysqli_query($con, 'select * from detail_penerimaan_alkes WHERE id_detail_penerimaan_alkes = "$id"');
// $query = mysqli_query($con, 'SELECT * FROM detail_penerimaan_alkes  where id_penerimaan_alkes="$id_penerimaan_alkes"');
$query1 = mysqli_query($con, "SELECT sum(sub_total) as total_harga FROM detail_penerimaan_alkes WHERE id_penerimaan_alkes='$id_penerimaan_alkes'");
while ($data1 = mysqli_fetch_assoc($query1)) { 
    $total_harga =  $data1['total_harga'];
}
$update1 = mysqli_query($con, "UPDATE penerimaan_alkes 
SET total_harga ='$total_harga'
WHERE id_penerimaan_alkes = '$id_penerimaan_alkes'");

if ($update1) {
    echo "<script>window.location.href = '?page=penerimaan_alkes-detail&id=" . $id_penerimaan_alkes . "';</script>";
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
        <h6 class="m-0 font-weight-bold text-info">Detail Penerimaan Alkes</h6>
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="row mb-3">
            <!-- <label for="id_penerimaan_alkes" >Kode Penerimaan</label> -->
            <div class="col-sm-6">
            <label for="id_penerimaan_alkes" >Kode Penerimaan</label>

              <input type="text" class="form-control" id="id_penerimaan_alkes" name="id_penerimaan_alkes" value="<?php echo $kode_penerimaan_alkes?>" readonly>
            </div>
    
            <!-- <label for="id_alkes" >Nama alkes</label> -->
            <div class="col-sm-6">
            <label for="id_alkes" >Nama alkes</label>

            <select name="id_alkes" id="id_alkes" class="form-control" required>
  <option value="">- Pilih -</option>
  <?php
  $query = mysqli_query($con, "SELECT id_alkes, nama_alkes FROM alkes");
  while ($row = mysqli_fetch_assoc($query)) {
    $alkes_id = $row['id_alkes'];
    $nama_alkes = $row['nama_alkes'];
    if ($alkes_id == $id_alkes) {
      echo '<option value="' . $alkes_id . '" selected>' . $nama_alkes . '</option>';
    } else {
      echo '<option value="' . $alkes_id . '">' . $nama_alkes . '</option>';
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
            <!-- <label for="harga_detail_penerimaan_alkes" class="col-sm-2 col-form-label">harga_detail_penerimaan_alkes</label> -->
            <div class="col-sm-6">
            <label for="harga_detail_penerimaan_alkes">Harga</label>

              <input type="text" class="form-control" id="harga_detail_penerimaan_alkes" name="harga_detail_penerimaan_alkes" value="<?php echo $harga_detail_penerimaan_alkes?>" oninput="calculateTotal()" required>
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
    var price = parseFloat(document.getElementById("harga_detail_penerimaan_alkes").value) || 0;
    var total = quantity * price;

    // document.getElementById("sub_totalDisplay").value = number_format(total,0,'.','.');
    document.getElementById("sub_total").value = total;

    // document.getElementById("jumlah").value = number_format(quantity),0,',','.';
    // document.getElementById("harga_detail_penerimaan_alkes").value = price;

  }
</script>
       
          <div class="row">
            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i> Simpan</button>
              <a href="?page=penerimaan_alkes-detail&id=<?php echo $id_penerimaan_alkes; ?>" class="btn btn-danger"><i class="fas fa-chevron-left"></i> Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
