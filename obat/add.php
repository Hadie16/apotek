<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['submit'])) {
  $kode_obat = $_POST['kode_obat'];
  // $gambar_obat = $_POST['gambar_obat'];
  $nama_obat = $_POST['nama_obat'];
  $sediaan_obat = $_POST['sediaan_obat'];

  $jenis_obat = $_POST['jenis_obat'];
  $kategori_obat = $_POST['kategori_obat'];

 
    // Handle the image upload
    if (isset($_FILES['gambar_obat'])) {
      $file = $_FILES['gambar_obat'];
      
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
              $insert = mysqli_query($con, "INSERT INTO obat (kode_obat, gambar_obat, nama_obat,sediaan_obat, jenis_obat, kategori_obat) VALUES ('$kode_obat', '$filename', '$nama_obat','$sediaan_obat', '$jenis_obat', '$kategori_obat')");
              
              if ($insert) {
                  echo "Data inserted successfully.";
    echo "<script>window.location.href = '?page=obat-show';</script>";

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
  //   echo "<script>window.location.href = '?page=obat-show';</script>";
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
        <h6 class="m-0 font-weight-bold text-info">Obat</h6>
      </div>


  <?php
    // Get the current year
    $year = date('Y');

    $query = mysqli_query($con, "SELECT kode_obat FROM obat ORDER BY kode_obat DESC LIMIT 1");
    
    if (mysqli_num_rows($query) > 0) {
      $row = mysqli_fetch_assoc($query);
      $lastKodeNumber = $row['kode_obat'];
      $lastKodeNumber = intval(substr($lastKodeNumber, 9)); // Extract the numeric part only
      $newKodeNumber = $lastKodeNumber + 1;
    } else {
      $newKodeNumber = 1;
    }
    
    $KodeNumber = 'OBT-' . $year . '-' . str_pad($newKodeNumber, 4, '0', STR_PAD_LEFT);
    



    ?>

      <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
          <div class="row mb-3">
            <label for="kode_obat" class="col-sm-2 col-form-label">Kode</label>
            <div class="col-sm-10">
              <input name="kode_obat" type="text" class="form-control" id="kode_obat" value="<?php echo $KodeNumber ?>" readonly required>
            </div>
          </div>

          <div class="row mb-3">
  <label for="gambar_obat" class="col-sm-2 col-form-label">Gambar</label>
  <div class="col-sm-10">
    <input type="file" class="form-control" id="gambar_obat" name="gambar_obat" accept="image/*" required>
  </div>
</div>


          <div class="row mb-3">
            <label for="nama_obat" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="nama_obat" name="nama_obat">

            </div>
          </div>

          <div class="row mb-3">
            <label for="sediaan_obat" class="col-sm-2 col-form-label">Sediaan</label>
            <div class="col-sm-10">
              <select id="sediaan_obat" class="form-control" name="sediaan_obat" required>
                <option value="" selected disabled>- Pilih -</option>
                
                <option value="Obat Cair">Obat Cair</option>
  <option value="Tablet">Tablet</option>
  <option value="Kapsul">Kapsul</option>
  <option value="Obat Oles">Obat Oles</option>
  <option value="Supositoria">Supositoria</option>
  <option value="Obat Tetes">Obat Tetes</option>
  <option value="Inhaler">Inhaler</option>
  <option value="Obat Suntik">Obat Suntik</option>
  <option value="Implan atau Obat Tempel">Implan atau Obat Tempel</option>
  <option value="Tablet Bukal atau Sublingual">Tablet Bukal atau Sublingual</option>

              </select>
            </div>
          </div>
         
          <div class="row mb-3">
            <label for="jenis_obat" class="col-sm-2 col-form-label">Jenis</label>
            <div class="col-sm-10">
              <select id="jenis_obat" class="form-control" name="jenis_obat" required>
                <option value="" selected disabled>- Pilih -</option>
                <option value="Analgesik">Analgesik</option>
  <option value="Antasida">Antasida</option>
  <option value="Anticemas">Anticemas</option>
  <option value="Anti-aritmia">Anti-aritmia</option>
  <option value="Antibiotik">Antibiotik</option>
  <option value="Antikoagulan dan trombolitik">Antikoagulan dan trombolitik</option>
  <option value="Antikonvulsan">Antikonvulsan</option>
  <option value="Antidepresan">Antidepresan</option>
  <option value="Antidiare">Antidiare</option>
  <option value="Anti-emetik">Anti-emetik</option>
  <option value="Antijamur">Antijamur</option>
  <option value="Antihistamin">Antihistamin</option>
  <option value="Antihipertensi">Antihipertensi</option>
  <option value="Anti-inflamasi">Anti-inflamasi</option>
  <option value="Antineoplastik">Antineoplastik</option>
  <option value="Antipsikotik">Antipsikotik</option>
  <option value="Antipiretik">Antipiretik</option>
  <option value="Antivirus">Antivirus</option>
  <option value="Beta-blocker">Beta-blocker</option>
  <option value="Bronkodilator">Bronkodilator</option>
  <option value="Kortikosteroid">Kortikosteroid</option>
  <option value="Sitotoksik">Sitotoksik</option>
  <option value="Dekongestan">Dekongestan</option>
  <option value="Ekspektoran">Ekspektoran</option>
  <option value="Obat tidur">Obat tidur</option>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="kategori_obat" class="col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-10">
            <select id="kategori_obat" class="form-control" name="kategori_obat" required>
                <option value="" selected disabled>- Pilih -</option>
           
  <option value="Obat Bebas">Obat Bebas</option>
  <option value="Obat Bebas Terbatas">Obat Bebas Terbatas</option>
  <option value="Obat Keras">Obat Keras</option>
  <option value="Obat Golongan Narkotika">Obat Golongan Narkotika</option>
  <option value="Obat Fitofarmaka">Obat Fitofarmaka</option>
  <option value="Obat Herbal Terstandar (OHT)">Obat Herbal Terstandar (OHT)</option>
  <option value="Obat Herbal (Jamu)">Obat Herbal (Jamu)</option>

              </select>
            </div>
          </div>

          
          <hr>

          <div class="row">

            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=obat-show" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>