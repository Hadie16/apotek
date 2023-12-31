<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Assuming you have already established a database connection
// $con = mysqli_connect("localhost", "username", "password", "database_name");
include '../connection.php';

$id_stok_alkes = $_POST['id_stok_alkes'];

// Query to retrieve data from table_1 based on id_stok_alkes
$query = mysqli_query($con, "SELECT id_alkes,jumlah_stok_alkes,satuan,harga_jual_alkes FROM stok_alkes WHERE id_stok_alkes = '$id_stok_alkes'");

$response = array();

if ($query) {
  if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $response['status'] = 'success';
    $response['data']['id_alkes'] = $row['id_alkes'];
  
    $response['data']['jumlah_stok_alkes'] = $row['jumlah_stok_alkes'];
    $response['data']['satuan'] = $row['satuan'];


    $response['data']['harga_jual_alkes'] = $row['harga_jual_alkes'];
    




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
