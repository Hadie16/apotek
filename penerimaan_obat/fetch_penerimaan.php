<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Assuming you have already established a database connection
// $con = mysqli_connect("localhost", "username", "password", "database_name");
include '../connection.php';

$id_detail_fetch_obat = $_POST['id_detail_fetch_obat'];

// Use regular expression to split the string into two parts
if (preg_match('/(\d+)([A-Za-z\s]+)?/', $id_detail_fetch_obat, $matches)) {
  $firstPart = $matches[1];  // Contains "123"
  $secondPart = $matches[2] ?: ''; // Contains "ID"
  // echo "First Part: " . $firstPart . "<br>";
  // echo "Second Part: " . $secondPart;
} else {
  echo "Invalid format - couldn't split the string into two parts.";
}

if($secondPart == "pesan"){
  //pesan
// Query to retrieve data from table_1 based on id_detail_pengadaan_obat
$query = mysqli_query($con, "SELECT * FROM detail_pengadaan_obat WHERE id_detail_pengadaan_obat = '$firstPart'");
}else{
//retur
$query = mysqli_query($con, "SELECT * FROM detail_retur_obat WHERE id_detail_retur_obat = '$firstPart'");

}

$response = array();

if ($query) {
  if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $response['status'] = 'success';
    $response['data']['id_obat'] = $row['id_obat'];
  
    $response['data']['jumlah'] = $row['jumlah'];

    $response['data']['satuan'] = $row['satuan'];

    if($secondPart == "pesan"){

    $response['data']['valuese'] = 0;
    }
else{
    $response['data']['valuese'] = $row['value'];

}




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
