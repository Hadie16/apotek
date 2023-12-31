<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Assuming you have already established a database connection
// $con = mysqli_connect("localhost", "username", "password", "database_name");
include '../connection.php';

$id_detail_pengadaan_alkes = $_POST['id_detail_pengadaan_alkes'];

// Query to retrieve data from table_1 based on id_detail_pengadaan_alkes
$query = mysqli_query($con, "SELECT * FROM detail_pengadaan_alkes WHERE id_detail_pengadaan_alkes = '$id_detail_pengadaan_alkes'");

$response = array();

if ($query) {
  if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $response['status'] = 'success';
    $response['data']['id_alkes'] = $row['id_alkes'];
  
    $response['data']['jumlah'] = $row['jumlah'];

    $response['data']['satuan'] = $row['satuan'];




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
