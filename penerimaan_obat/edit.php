<?php
include '../connection.php';
include '../template/header.php';

$id = $_GET['id'];
// include '../connection.php';
$result = mysqli_query($con, "SELECT * FROM penerimaan_obat WHERE id_penerimaan_obat=$id");

while ($data = mysqli_fetch_array($result)) {
  $kode = $data['kode_penerimaan_obat'];


  $faktur = $data['no_faktur'];
  $tanggal = $data['tanggal_penerimaan_obat'];
  $id_supplier = $data['id_supplier'];
//   $k = $data['id_obat'];

}
if (isset($_POST['submit'])) {
  $kode = $_POST['kode'];
  $faktur = $_POST['faktur'];
  $tanggal = $_POST['tanggal'];

  $id_supplier = $_POST['id_supplier'];

//   $result = mysqli_query($con, "SELECT * FROM penerimaan_obat WHERE id_penerimaan_obat='$id'");
//   $cek = mysqli_num_rows($result);
//   if ($cek > 0) {
//     echo "<script>
//             alert('Gunakan id_obat dengan nama yang lain!');
//             window.location.href = '?page=penerimaan_obat-add';
//           </script>";
//     exit;
//   }
$update = mysqli_query($con, "UPDATE penerimaan_obat SET kode_penerimaan_obat='$kode',no_faktur='$faktur',tanggal_penerimaan_obat='$tanggal',id_supplier='$id_supplier' WHERE id_penerimaan_obat=$id");


// if ($update) {
//     echo "<p>query berhasil<p/>";
// } else {
//     die('invalid Query : ' . mysqli_error($con));
// }
  if ($update) {
    echo "<script>window.location.href = '?page=penerimaan_obat-show';</script>";
  }
}
?>



<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Penerimaan Obat</h6>
      </div>
      <div class="card-body">
        <form method="POST">
         
        <div class="row mb-3">
            <label for="kode" class="col-sm-2 col-form-label">Kode</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="kode" name="kode" value="<?php echo $kode?>" readonly>
            </div>
          </div>

          <div class="row mb-3">
            <label for="faktur" class="col-sm-2 col-form-label">No Faktur</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="faktur" name="faktur" value="<?php echo $faktur?>" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
            <div class="col-sm-10">
            <input name="tanggal" type="date" class="form-control" id="tanggal" value="<?php echo $tanggal ?>"  required>

            </div>
          </div>
        
          <div class="row mb-3">
            <label for="id_supplier" class="col-sm-2 col-form-label">Supplier</label>
            <div class="col-sm-10">
            <select name="id_supplier" class="form-control" >
        <option value="">- Pilih -</option>
        <?php
       $query = mysqli_query($con, "SELECT id_supplier, nama_supplier FROM supplier");
       while ($row = mysqli_fetch_assoc($query)) {
           $id_suppliers = $row['id_supplier'];
           $nama_supplier = $row['nama_supplier'];

            if ($id_supplier == $id_suppliers) {
              echo '<option value="' . $id_suppliers . '" selected>' . $nama_supplier . '</option>';
          } else {
            echo '<option value="' . $id_suppliers . '">' . $nama_supplier . '</option>';
        }
      }

        ?>
    </select>
            </div>
          </div>

          <hr>
          <div class="row">
            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=penerimaan_obat-show" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>