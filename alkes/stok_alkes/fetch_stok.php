<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Assuming you have already established a database connection
// $con = mysqli_connect("localhost", "username", "password", "database_name");
include '../connection.php';

$id_ketersediaan_alkes = $_POST['id_ketersediaan_alkes'];

// Query to retrieve data from table_1 based on id_ketersediaan_alkes
// $query = mysqli_query($con, "SELECT   * FROM ketersediaan_alkes WHERE id_ketersediaan_alkes = '$id_ketersediaan_alkes'");
$query = mysqli_query($con, "SELECT   * FROM ketersediaan_alkes WHERE id_ketersediaan_alkes = '$id_ketersediaan_alkes'");


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
    $response['data']['id_alkes'] = $row['id_alkes'];

    $response['data']['jumlah_ketersediaan_alkes'] = $row['jumlah_ketersediaan_alkes'];
    $response['data']['satuan'] = $row['satuan'];

    
    $response['data']['harga_beli_alkes'] = $row['harga_beli_alkes'];
    // $response['data']['unit'] = $row['unit'];
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
