<?php
include '../connection.php';
// include '../template/header.php';

$id = $_GET['id'];
// include '../connection.php';
// $result = mysqli_query($con, "SELECT * FROM cek_kesehatan WHERE id_cek_kesehatan=$id");

// while ($data = mysqli_fetch_array($result)) {
//   $id_obat = $data['id_obat'];
//   $jumlah = $data['jumlah_cek_kesehatan'];
//   $satuan = $data['satuan'];

//   $tanggal = $data['tanggal_kadaluarsa_obat'];

// //   $k = $data['id_obat'];

// }
if (isset($_POST['submit'])) {
    if(!empty($_POST['value'])){
        $value = $_POST['value'];
        $query = "UPDATE detail_cek_kesehatan SET nilai = '$value' WHERE id_cek_kesehatan = '$id' and id_kategori = 1";
        $result = mysqli_query($con, $query);
        if ($result) {
          echo "Update successful";
        } else {
          echo "Update failed";
        }
      }
      if(!empty($_POST['value2'])){
        $value2 = $_POST['value2'];
        $query2 = "UPDATE detail_cek_kesehatan SET nilai = '$value2' WHERE id_cek_kesehatan = '$id' and id_kategori = 2";
        $result2 = mysqli_query($con, $query2);
        if ($result2) {
          echo "Update successful";
        } else {
          echo "Update failed";
        }
      }
      if(!empty($_POST['value3'])){
        $value3 = $_POST['value3'];
        $query3 = "UPDATE detail_cek_kesehatan SET nilai = '$value3' WHERE id_cek_kesehatan = '$id' and id_kategori = 3";
        $result3 = mysqli_query($con, $query3);
        if ($result3) {
          echo "Update successful";
        } else {
          echo "Update failed";
        }
      }


// if ($update) {
//     echo "<p>query berhasil<p/>";
// } else {
//     die('invalid Query : ' . mysqli_error($con));
// }
// if ($update) {
  echo "<script>window.location.href = '?page=cek_kesehatan-detail&id=" . $id . "';</script>";
// }

}
?>




<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Cek Kesehatan - Edit Nilai</h6>
      </div>
      <div class="card-body">
        <form method="POST">

        <?php
        $query = mysqli_query($con, "SELECT * FROM detail_cek_kesehatan dck join cek_kesehatan ck on dck.id_cek_kesehatan=ck.id_cek_kesehatan where dck.id_cek_kesehatan=$id");

// Initialize arrays to store $b and $k values
$biaya_values = array();
$id_kategori_values = array();

$nilai_values = array();


while ($data = mysqli_fetch_assoc($query)) {
    $biaya_values[] = $data['biaya'];
    $id_kategori_values[] = $data['id_kategori'];
    $nilai_values[] = $data['nilai'];


    
}
//         echo "<pre>";
// var_dump($biaya_values);
// echo "</pre>";
// echo "<pre>";
// var_dump($id_kategori_values);
// echo "</pre>";
$b1=$biaya_values[0];
$b2=$biaya_values[1];
$b3=$biaya_values[2];
$k1=$id_kategori_values[0];
$k2=$id_kategori_values[1];
$k3=$id_kategori_values[2];


$n1=$nilai_values[0];
if($n1==3.14){
    $n1="";
}
$n2=$nilai_values[1];
if($n2==3.14){
    $n2="";
}
$n3=$nilai_values[2];
if($n3==3.14){
    $n3="";
}



?>


          <div class="row mb-3">
            <label for="jumlah_ketersediaan_obat" class="col-sm-2 col-form-label">Gula Darah</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="inputValue" value="<?php echo $n1 ?>" name="value" <?php echo ($b1 == 10000 && $k1 == 1) ? '' : 'disabled'; ?>>
            </div>
          </div>
          <div class="row mb-3">
            <label for="satuan" class="col-sm-2 col-form-label">Asam Urat</label>
            <div class="col-sm-10">
          
            <input type="text" class="form-control" id="inputValue2" value="<?php echo $n2 ?>" name="value2" <?php echo ($b2 == 10000 && $k2 == 2) ? '' : 'disabled'; ?>>
            </div>
          </div>
          <div class="row mb-3">
            <label for="tanggal_kadaluarsa" class="col-sm-2 col-form-label">Kolesterol</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="inputValue3" value="<?php echo $n3 ?>" name="value3" <?php echo ($b3 == 20000 && $k3 == 3) ? '' : 'disabled'; ?>>

            </div>
          </div>
          <!-- <div class="row mb-3">
            <label for="jumlah_ketersediaan_obat" class="col-sm-2 col-form-label">Catatan</label>
            <div class="col-sm-10">
           <input type="text" name="catatan">
            </div>
          </div> -->
        
          <hr>
          <div class="row">
            <div class="col offset-sm-2">
              <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i>
                Simpan</button>
              <a href="?page=cek_kesehatan-detail&id=<?php echo $id ?>" class="btn btn-danger"><i class="fas fa-chevron-left"></i>
                Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>