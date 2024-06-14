<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['submit'])) {
  $kode_alkes = $_POST['kode_alkes'];
  $nama_alkes = $_POST['nama_alkes'];
  // $gambar_alkes = $_POST['gambar_alkes'];
  // $kategori_alkes = $_POST['kategori_alkes'];

 
    // Handle the image upload
    if (isset($_FILES['gambar_alkes'])) {
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
              $insert = mysqli_query($con, "INSERT INTO alkes (kode_alkes,gambar_alkes, nama_alkes) VALUES ('$kode_alkes','$filename',  '$nama_alkes')");
              
              if ($insert) {
                  echo "Data inserted successfully.";
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
  }
// }

  // if ($insert) {
    // echo "<script>window.location.href = '?page=alkes-show';</script>";
  // }
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


  <?php
    // Get the current year
    $year = date('Y');

    $query = mysqli_query($con, "SELECT kode_alkes FROM alkes ORDER BY kode_alkes DESC LIMIT 1");
    
    if (mysqli_num_rows($query) > 0) {
      $row = mysqli_fetch_assoc($query);
      $lastKodeNumber = $row['kode_alkes'];
      $lastKodeNumber = intval(substr($lastKodeNumber, 9)); // Extract the numeric part only
      $newKodeNumber = $lastKodeNumber + 1;
    } else {
      $newKodeNumber = 1;
    }
    
    $KodeNumber = 'ALK-' . $year . '-' . str_pad($newKodeNumber, 4, '0', STR_PAD_LEFT);
    



    ?>

      <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
          <div class="row mb-3">
            <label for="kode_alkes" class="col-sm-2 col-form-label">Kode</label>
            <div class="col-sm-10">
              <input name="kode_alkes" type="text" class="form-control" id="kode_alkes" value="<?php echo $KodeNumber ?>" readonly required>
            </div>
          </div>

        <div class="row mb-3">
  <label for="gambar_alkes" class="col-sm-2 col-form-label">Gambar</label>
  <div class="col-sm-10">
    <input type="file" class="form-control" id="gambar_alkes" name="gambar_alkes" accept="image/*" required>
  </div>
</div>


          <div class="row mb-3">
            <label for="nama_alkes" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="nama_alkes" name="nama_alkes">

            </div>
          </div>

  

          
          <hr>

          <div class="row">

            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=alkes-show" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>