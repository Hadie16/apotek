<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Assuming you have already established a database connection
// $con = mysqli_connect("localhost", "username", "password", "database_name");
include '../connection.php';

$id_obat = $_POST['id_obat_var'];

// Query to retrieve data from table_1 based on id_obat
$query = mysqli_query($con, "SELECT tanggal_kadaluarsa_obat, id_obat,sum(jumlah_stok_obat) as sum_jumlah_stok_obat,satuan,harga_jual_obat FROM stok_obat where id_obat = '$id_obat' and tanggal_kadaluarsa_obat > CURDATE() and jumlah_stok_obat>0");

$response = array();

if ($query) {
  if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $response['status'] = 'success';
    $response['data']['id_obat'] = $row['id_obat'];
  
    $response['data']['jumlah_stok_obat'] = $row['sum_jumlah_stok_obat'];
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
