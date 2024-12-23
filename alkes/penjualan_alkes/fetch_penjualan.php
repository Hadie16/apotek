<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Assuming you have already established a database connection
// $con = mysqli_connect("localhost", "username", "password", "database_name");
include '../connection.php';

$id_alkes = $_POST['id_alkes_var'];

// Query to retrieve data from table_1 based on id_alkes
$query = mysqli_query($con, "SELECT tanggal_kadaluarsa_alkes, id_alkes,sum(jumlah_stok_alkes) as sum_jumlah_stok_alkes,satuan,harga_jual_alkes FROM stok_alkes where id_alkes = '$id_alkes' and tanggal_kadaluarsa_alkes > CURDATE() and jumlah_stok_alkes>0");

$response = array();

if ($query) {
  if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $response['status'] = 'success';
    $response['data']['id_alkes'] = $row['id_alkes'];
  
    $response['data']['jumlah_stok_alkes'] = $row['sum_jumlah_stok_alkes'];
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
