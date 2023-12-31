<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Assuming you have already established a database connection
// $con = mysqli_connect("localhost", "username", "password", "database_name");
include '../connection.php';

if (isset($_POST['id_alkes'])) {
$id_alkes = $_POST['id_alkes'];

// Query to retrieve data from table_1 based on id_alkes
// $query = mysqli_query($con, "SELECT   * FROM ketersediaan_alkes WHERE id_alkes = '$id_alkes'");
$query = mysqli_query($con, "SELECT *,box as jumlah_box,jumlah_ketersediaan_alkes as jumlah_KO FROM ketersediaan_alkes WHERE id_ketersediaan_alkes = '$id_alkes'");
}


//fetch for batch number
if (isset($_POST['batch_number'])){
  $batch_number = $_POST['batch_number'];

  
  $query = mysqli_query($con, "SELECT *,box as jumlah_box, jumlah_ketersediaan_alkes as jumlah_KO FROM ketersediaan_alkes WHERE batch_number = '$batch_number'");
  
}

// $query = mysqli_query($con, 'SELECT
// a.*,
// b.nama_alkes AS alkess, (SELECT sum(jumlah_alkes) as j FROM ketersediaan_alkes dso WHERE dso.id_alkes = a.id_alkes AND dso.jumlah_alkes > 0) AS jumlah_ketersediaan_alkes,
// (SELECT tanggal_kadaluarsa FROM ketersediaan_alkes dso WHERE dso.id_alkes = a.id_alkes AND dso.jumlah_alkes > 0 AND dso.tanggal_kadaluarsa >= CURDATE() ORDER BY dso.tanggal_kadaluarsa DESC LIMIT 1) AS tanggal_kadaluarsa_alkes
// FROM ketersediaan_alkes a
// JOIN alkes b ON a.id_alkes = b.id_alkes');


$response = array();

if ($query) {
  if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $response['status'] = 'success';
    $response['data']['id_ketersediaan_alkes'] = $row['id_ketersediaan_alkes'];
    $response['data']['box'] = $row['jumlah_box'];
    $response['data']['jumlah_ketersediaan_alkes'] = $row['jumlah_KO'];
    $response['data']['satuan'] = $row['satuan'];
    $response['data']['harga_beli_alkes'] = $row['harga_beli_alkes'];


    $response['data']['id_alkes'] = $row['id_alkes'];
    
    $response['data']['batch_number'] = $row['batch_number'];
    // // $response['data']['unit'] = $row['unit'];
    $response['data']['tanggal_kadaluarsa_alkes'] = $row['tanggal_kadaluarsa_alkes'];


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
