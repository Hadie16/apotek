<?php
$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM obat WHERE id_obat=$id");

while ($data = mysqli_fetch_array($result)) {
  $kode_obat = $data['kode_obat'];
  $gambar_obat = $data['gambar_obat'];
  $nama_obat = $data['nama_obat'];
  $sediaan_obat = $data['sediaan_obat'];

  $jenis_obat = $data['jenis_obat'];
  $kategori_obat = $data['kategori_obat'];
}

if (isset($_POST['submit'])) {
  $kode_obat = $_POST['kode_obat'];
  $gambar_obat = $_POST['gambar_obat'];
  $gambar_obats = $_POST['gambar_obats'];

  $nama_obat = $_POST['nama_obat'];
  $sediaan_obat = $_POST['sediaan_obat'];

  $jenis_obat = $_POST['jenis_obat'];
  $kategori_obat = $_POST['kategori_obat'];


  // $update = mysqli_query($con, "UPDATE obat SET kode_obat='$kode_obat',gambar_obat='$gambar_obat',nama_obat='$nama_obat',sediaan_obat='$sediaan_obat',jenis_obat='$jenis_obat',kategori_obat='$kategori_obat'WHERE id_obat=$id");

  // echo "<script>window.location.href = '?page=obat-show';</script>";

  if (isset($_FILES['gambar_obat'])) {
      $file = $_FILES['gambar_obat'];

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
          $update = mysqli_query($con, "UPDATE obat SET kode_obat='$kode_obat',gambar_obat='$filename',nama_obat='$nama_obat',sediaan_obat='$sediaan_obat',jenis_obat='$jenis_obat',kategori_obat='$kategori_obat'WHERE id_obat=$id");
          
          if ($update) {
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
}else{
  $update = mysqli_query($con, "UPDATE obat SET kode_obat='$kode_obat',gambar_obat='$gambar_obats',nama_obat='$nama_obat',sediaan_obat='$sediaan_obat',jenis_obat='$jenis_obat',kategori_obat='$kategori_obat'WHERE id_obat=$id");

  echo "<script>window.location.href = '?page=obat-show';</script>";
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
        <h6 class="m-0 font-weight-bold text-info">Obat</h6>
      </div>
      <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
          <div class="row mb-3">
            <label for="kode_obat" class="col-sm-2 col-form-label">Kode</label>
            <div class="col-sm-10">
              <input name="kode_obat" type="text" class="form-control" id="kode_obat" value="<?php echo $kode_obat; ?>" readonly required
                placeholder="kode">
            </div>
          </div>

          <div class="row mb-3">
            <label for="gambar_obat" class="col-sm-2 col-form-label">Gambar</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="gambar_obat" name="gambar_obat">
              <input type="hidden" class="form-control" id="gambar_obat" name="gambar_obats" value="<?php echo $gambar_obat; ?>" required>

            </div>
          </div>

          <div class="row mb-3">
            <label for="nama_obat" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="<?php echo $nama_obat; ?>" required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="sediaan_obat" class="col-sm-2 col-form-label">Sediaan</label>
            <div class="col-sm-10">
              <select id="sediaan_obat" class="form-control" name="sediaan_obat" required>
                <option value="-" selected disabled>- Pilih -</option>
                
                <!-- <option value="Analgesik" <?php if ($jenis_obat == 'Analgesik') echo 'selected'; ?>>Analgesik</option> -->


                <option value="Obat Cair" <?php if ($sediaan_obat == 'Obat Cair') echo 'selected'; ?>>Obat Cair</option>
  <option value="Tablet" <?php if ($sediaan_obat == 'Tablet') echo 'selected'; ?>>Tablet</option>
  <option value="Kapsul" <?php if ($sediaan_obat == 'Kapsul') echo 'selected'; ?>>Kapsul</option>
  <option value="Obat Oles" <?php if ($sediaan_obat == 'Obat Oles') echo 'selected'; ?>>Obat Oles</option>
  <option value="Supositoria" <?php if ($sediaan_obat == 'Supositoria') echo 'selected'; ?>>Supositoria</option>
  <option value="Obat Tetes" <?php if ($sediaan_obat == 'Obat Tetes') echo 'selected'; ?>>Obat Tetes</option>
  <option value="Inhaler" <?php if ($sediaan_obat == 'Inhaler') echo 'selected'; ?>>Inhaler</option>
  <option value="Obat Suntik" <?php if ($sediaan_obat == 'Obat Suntik') echo 'selected'; ?>>Obat Suntik</option>
  <option value="Implan atau Obat Tempel" <?php if ($sediaan_obat == 'Implan atau Obat Tempel') echo 'selected'; ?>>Implan atau Obat Tempel</option>
  <option value="Tablet Bukal atau Sublingual" <?php if ($sediaan_obat == 'Tablet Bukal atau Sublingual') echo 'selected'; ?>>Tablet Bukal atau Sublingual</option>

              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="jenis_obat" class="col-sm-2 col-form-label">Jenis</label>
            <div class="col-sm-10">
              <select name="jenis_obat" id="jenis_obat" class="form-control" name="jenis_obat" required>
                <option value="-" disabled>- Pilih -</option>
               

                <option value="Analgesik" <?php if ($jenis_obat == 'Analgesik') echo 'selected'; ?>>Analgesik</option>
  <option value="Antasida" <?php if ($jenis_obat == 'Antasida') echo 'selected'; ?>>Antasida</option>
  <option value="Anticemas" <?php if ($jenis_obat == 'Anticemas') echo 'selected'; ?>>Anticemas</option>
  <option value="Anti-aritmia" <?php if ($jenis_obat == 'Anti-aritmia') echo 'selected'; ?>>Anti-aritmia</option>
  <option value="Antibiotik" <?php if ($jenis_obat == 'Antibiotik') echo 'selected'; ?>>Antibiotik</option>
  <option value="Antikoagulan dan trombolitik" <?php if ($jenis_obat == 'Antikoagulan dan trombolitik') echo 'selected'; ?>>Antikoagulan dan trombolitik</option>
  <option value="Antikonvulsan" <?php if ($jenis_obat == 'Antikonvulsan') echo 'selected'; ?>>Antikonvulsan</option>
  <option value="Antidepresan" <?php if ($jenis_obat == 'Antidepresan') echo 'selected'; ?>>Antidepresan</option>
  <option value="Antidiare" <?php if ($jenis_obat == 'Antidiare') echo 'selected'; ?>>Antidiare</option>
  <option value="Anti-emetik" <?php if ($jenis_obat == 'Anti-emetik') echo 'selected'; ?>>Anti-emetik</option>
  <option value="Antijamur" <?php if ($jenis_obat == 'Antijamur') echo 'selected'; ?>>Antijamur</option>
  <option value="Antihistamin" <?php if ($jenis_obat == 'Antihistamin') echo 'selected'; ?>>Antihistamin</option>
  <option value="Antihipertensi" <?php if ($jenis_obat == 'Antihipertensi') echo 'selected'; ?>>Antihipertensi</option>
  <option value="Anti-inflamasi" <?php if ($jenis_obat == 'Anti-inflamasi') echo 'selected'; ?>>Anti-inflamasi</option>
  <option value="Antineoplastik" <?php if ($jenis_obat == 'Antineoplastik') echo 'selected'; ?>>Antineoplastik</option>
  <option value="Antipsikotik" <?php if ($jenis_obat == 'Antipsikotik') echo 'selected'; ?>>Antipsikotik</option>
  <option value="Antipiretik" <?php if ($jenis_obat == 'Antipiretik') echo 'selected'; ?>>Antipiretik</option>
  <option value="Antivirus" <?php if ($jenis_obat == 'Antivirus') echo 'selected'; ?>>Antivirus</option>
  <option value="Beta-blocker" <?php if ($jenis_obat == 'Beta-blocker') echo 'selected'; ?>>Beta-blocker</option>
  <option value="Bronkodilator" <?php if ($jenis_obat == 'Bronkodilator') echo 'selected'; ?>>Bronkodilator</option>
  <option value="Kortikosteroid" <?php if ($jenis_obat == 'Kortikosteroid') echo 'selected'; ?>>Kortikosteroid</option>
  <option value="Sitotoksik" <?php if ($jenis_obat == 'Sitotoksik') echo 'selected'; ?>>Sitotoksik</option>
  <option value="Dekongestan" <?php if ($jenis_obat == 'Dekongestan') echo 'selected'; ?>>Dekongestan</option>
  <option value="Ekspektoran" <?php if ($jenis_obat == 'Ekspektoran') echo 'selected'; ?>>Ekspektoran</option>
  <option value="Obat tidur" <?php if ($jenis_obat == 'Obat tidur') echo 'selected'; ?>>Obat tidur</option>

              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label for="kategori_obat" class="col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-10">
            <select name="kategori_obat" id="kategori_obat" class="form-control" name="kategori_obat" required>
                <option value="-" disabled>- Pilih -</option>
                <option value="Obat Bebas" <?php if ($kategori_obat == 'Obat Bebas') echo 'selected'; ?>>Obat Bebas</option>
                <option value="Obat Bebas Terbatas" <?php if ($kategori_obat == 'Obat Bebas Terbatas') echo 'selected'; ?>>Obat Bebas Terbatas</option>
                <option value="Obat Keras" <?php if ($kategori_obat == 'Obat Keras') echo 'selected'; ?>>Obat Keras</option>
                <option value="Obat Golongan Narkotika<" <?php if ($kategori_obat == 'Obat Golongan Narkotika<') echo 'selected'; ?>>Obat Golongan Narkotika<</option>  
                 <option value="Obat FitofarmakaObat Fitofarmaka" <?php if ($kategori_obat == 'Obat FitofarmakaObat Fitofarmaka') echo 'selected'; ?>>Obat Fitofarmaka</option>
                <option value="Obat Herbal Terstandar (OHT)" <?php if ($kategori_obat == 'Obat Herbal Terstandar (OHT)') echo 'selected'; ?>>Obat Herbal Terstandar (OHT)</option>   
                <option value="Obat Herbal (Jamu)" <?php if ($kategori_obat == 'Obat Herbal (Jamu)') echo 'selected'; ?>>Obat Herbal (Jamu)</option>
   
              </select>
            </div>
          </div>

          <hr>
          <div class="row">
            <div class="offset-sm-2">

              <button type="submit" class="btn btn-sm btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=obat-show" class="btn btn-sm btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>