<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Assuming you have already established a database connection
// $con = mysqli_connect("localhost", "username", "password", "database_name");
include '../connection.php';

$id_ketersediaan_obat = $_POST['id_ketersediaan_obat'];

// Query to retrieve data from table_1 based on id_ketersediaan_obat
// $query = mysqli_query($con, "SELECT   * FROM ketersediaan_obat WHERE id_ketersediaan_obat = '$id_ketersediaan_obat'");
$query = mysqli_query($con, "SELECT   * FROM ketersediaan_obat WHERE id_ketersediaan_obat = '$id_ketersediaan_obat'");


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
    $response['data']['id_obat'] = $row['id_obat'];

    $response['data']['jumlah_ketersediaan_obat'] = $row['jumlah_ketersediaan_obat'];
    $response['data']['satuan'] = $row['satuan'];

    
    $response['data']['harga_beli_obat'] = $row['harga_beli_obat'];
    // $response['data']['unit'] = $row['unit'];
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
