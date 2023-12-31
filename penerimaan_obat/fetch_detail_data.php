<?php
// Retrieve the medId parameter from the AJAX request
$medId = $_POST['medId'];

// Perform a database query to fetch data from the detail_med_table based on the med_id
// Replace this with your actual database query using your preferred PHP MySQL extension (e.g., mysqli, PDO)
// Execute the query and fetch the data into an array

// Example data retrieval code using mysqli extension
$connection = mysqli_connect('localhost', 'root', '', 'mahabbah');
$query = "SELECT * FROM detail_pengadaan_obat WHERE id_pengadaan_obat = $medId";
$result = mysqli_query($connection, $query);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

// Return the data as JSON response
$response = array('data' => $data);
echo json_encode($response);
?>
