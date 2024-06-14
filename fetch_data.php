<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Assuming you have already established a database connection
// $con = mysqli_connect("localhost", "username", "password", "database_name");
include 'connection.php';

$id_obat = $_POST['id_obat'];

// Query to retrieve data from table_1 based on id_obat
$query = mysqli_query($con, "SELECT kode_obat, jenis_obat FROM obat WHERE id_obat = '$id_obat'");

$response = array();

if ($query) {
  if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $response['status'] = 'success';
    $response['data']['kode_obat'] = $row['kode_obat'];
    $response['data']['jenis_obat'] = $row['jenis_obat'];
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
