<?php
include '../connection.php';
include '../template/header.php';

$id = $_GET['id'];
// include '../connection.php';
$result = mysqli_query($con, "SELECT * FROM pengadaan_alkes WHERE id_pengadaan_alkes=$id");

while ($data = mysqli_fetch_array($result)) {
  // $tanggal = $data['tanggal'];
  $id_supplier = $data['id_supplier'];
//   $k = $data['id_alkes'];

}
if (isset($_POST['submit'])) {
  // $tanggal = $_POST['tanggal'];


  $id_supplier = $_POST['id_supplier'];

//   $result = mysqli_query($con, "SELECT * FROM pengadaan_alkes WHERE id_pengadaan_alkes='$id'");
//   $cek = mysqli_num_rows($result);
//   if ($cek > 0) {
//     echo "<script>
//             alert('Gunakan id_alkes dengan nama yang lain!');
//             window.location.href = '?page=pengadaan_alkes-add';
//           </script>";
//     exit;
//   }
$update = mysqli_query($con, "UPDATE pengadaan_alkes SET id_supplier='$id_supplier' WHERE id_pengadaan_alkes=$id");


// if ($update) {
//     echo "<p>query berhasil<p/>";
// } else {
//     die('invalid Query : ' . mysqli_error($con));
// }
  if ($update) {
    echo "<script>window.location.href = '?page=pengadaan_alkes-show';</script>";
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
        <h6 class="m-0 font-weight-bold text-info">Pengadaan Alkes</h6>
      </div>
      <div class="card-body">
        <form method="POST">
         

              <input type="hidden" class="form-control" id="kode" name="kode" value="<?php echo date('Y-m-d'); ?>">
    
        
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
              <a href="?page=pengadaan_alkes-show" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>