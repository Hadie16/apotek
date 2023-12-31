<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Assuming you have already established a database connection
// $con = mysqli_connect("localhost", "username", "password", "database_name");
include '../connection.php';

if (isset($_POST['id_obat'])) {
$id_obat = $_POST['id_obat'];

// Query to retrieve data from table_1 based on id_obat
// $query = mysqli_query($con, "SELECT   * FROM ketersediaan_obat WHERE id_obat = '$id_obat'");
$query = mysqli_query($con, "SELECT *,box as jumlah_box,jumlah_ketersediaan_obat as jumlah_KO FROM ketersediaan_obat WHERE id_ketersediaan_obat = '$id_obat'");
}


//fetch for batch number
if (isset($_POST['batch_number'])){
  $batch_number = $_POST['batch_number'];

  
  $query = mysqli_query($con, "SELECT *,box as jumlah_box, jumlah_ketersediaan_obat as jumlah_KO FROM ketersediaan_obat WHERE batch_number = '$batch_number'");
  
}

// $query = mysqli_query($con, 'SELECT
// a.*,
// b.nama_obat AS obats, (SELECT sum(jumlah_obat) as j FROM ketersediaan_obat dso WHERE dso.id_obat = a.id_obat AND dso.jumlah_obat > 0) AS jumlah_ketersediaan_obat,
// (SELECT tanggal_kadaluarsa FROM ketersediaan_obat dso WHERE dso.id_obat = a.id_obat AND dso.jumlah_obat > 0 AND dso.tanggal_kadaluarsa >= CURDATE() ORDER BY dso.tanggal_kadaluarsa DESC LIMIT 1) AS tanggal_kadaluarsa_obat
// FROM ketersediaan_obat a
// JOIN obat b ON a.id_obat = b.id_obat');


$response = array();

if ($query) {
  if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $response['status'] = 'success';
    $response['data']['id_ketersediaan_obat'] = $row['id_ketersediaan_obat'];
    $response['data']['box'] = $row['jumlah_box'];
    $response['data']['jumlah_ketersediaan_obat'] = $row['jumlah_KO'];
    $response['data']['satuan'] = $row['satuan'];
    $response['data']['harga_beli_obat'] = $row['harga_beli_obat'];


    $response['data']['id_obatt'] = $row['id_obat'];
    
    $response['data']['batch_number'] = $row['batch_number'];
    // // $response['data']['unit'] = $row['unit'];
    $response['data']['tanggal_kadaluarsa_obat'] = $row['tanggal_kadaluarsa_obat'];


  } else {
    $response['status'] = 'error';
  }
} else {
  $response['status'] = 'error';
  $response['message'] = mysqli_error($con);
}

// Close the database connection
mysqli_close($con);

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);

?>
