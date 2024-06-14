<?php
$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM alkes WHERE id_alkes=$id");

while ($data = mysqli_fetch_array($result)) {
  $kode_alkes = $data['kode_alkes'];
  $gambar_alkes = $data['gambar_alkes'];

  $nama_alkes = $data['nama_alkes'];

}

if (isset($_POST['submit'])) {
  $kode_alkes = $_POST['kode_alkes'];
  $gambar_alkes = $_POST['gambar_alkes'];
  $gambar_alkess = $_POST['gambar_alkess'];

  $nama_alkes = $_POST['nama_alkes'];


  if (!empty($_FILES['gambar_alkes']['name'])) {
    $file = $_FILES['gambar_alkes'];

    // Check if the file is an image
    $allowedTypes = array('jpg', 'jpeg', 'png');
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    if (in_array($fileExtension, $allowedTypes)) {
        $targetFolder = '../uploads/'; // Specify the target folder where the image will be saved
        
        // Generate a unique filename for the image
        $filename = uniqid() . '.' . $fileExtension;
        $targetPath = $targetFolder . $filename;
        
        // Move the uploaded file to the target folder
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            // Insert the image and other information into the database
            $update = mysqli_query($con, "UPDATE alkes SET kode_alkes='$kode_alkes',gambar_alkes='$filename',nama_alkes='$nama_alkes' WHERE id_alkes=$id");

            // echo "<script>window.location.href = '?page=alkes-show';</script>";
            
            if ($update) {
                echo "Data updated successfully.";
  echo "<script>window.location.href = '?page=alkes-show';</script>";

            } else {
                echo "Error inserting data: " . mysqli_error($con);
            }
        } else {
            echo "Error moving uploaded file.";
        }
    } else {
        echo "Invalid file type. Only JPG, JPEG, and PNG files are allowed.";
    }
}else{
  $update = mysqli_query($con, "UPDATE alkes SET kode_alkes='$kode_alkes',gambar_alkes='$gambar_alkess',nama_alkes='$nama_alkes' WHERE id_alkes=$id");

  echo "<script>window.location.href = '?page=alkes-show';</script>";
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
        <h6 class="m-0 font-weight-bold text-info">Alkes</h6>
      </div>
      <div class="card-body">
        <form method="POST"  enctype="multipart/form-data">
          <div class="row mb-3">
            <label for="kode_alkes" class="col-sm-2 col-form-label">Kode</label>
            <div class="col-sm-10">
              <input name="kode_alkes" type="text" class="form-control" id="kode_alkes" value="<?php echo $kode_alkes; ?>" readonly required
                placeholder="kode">
            </div>
          </div>

  <div class="row mb-3">
            <label for="gambar_alkes" class="col-sm-2 col-form-label">Gambar</label>
            <div class="col-sm-10">
            <input type="file" class="form-control" id="gambar_alkes" name="gambar_alkes">
              <input type="hidden" class="form-control" id="gambar_alkes" name="gambar_alkess" value="<?php echo $gambar_alkes; ?>" required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="nama_alkes" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="nama_alkes" name="nama_alkes" value="<?php echo $nama_alkes; ?>" required>
            </div>
          </div>

        
          

          <hr>
          <div class="row">
            <div class="offset-sm-2">

              <button type="submit" class="btn btn-sm btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=alkes-show" class="btn btn-sm btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>