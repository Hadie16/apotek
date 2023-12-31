<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Assuming you have already established a database connection
// $con = mysqli_connect("localhost", "username", "password", "database_name");
include '../connection.php';

$id_stok_obat = $_POST['id_stok_obat'];

// Query to retrieve data from table_1 based on id_stok_obat
$query = mysqli_query($con, "SELECT id_obat,jumlah_stok_obat,satuan,harga_jual_obat FROM stok_obat WHERE id_stok_obat = '$id_stok_obat'");

$response = array();

if ($query) {
  if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $response['status'] = 'success';
    $response['data']['id_obat'] = $row['id_obat'];
  
    $response['data']['jumlah_stok_obat'] = $row['jumlah_stok_obat'];
    $response['data']['satuan'] = $row['satuan'];


    $response['data']['harga_jual_obat'] = $row['harga_jual_obat'];
    




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
