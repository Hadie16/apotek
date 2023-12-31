<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "mahabbah";

// Create a connection to the database
$con = mysqli_connect($servername, $username, $password, $database);

// Check if the connection was successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
// Retrieve the selected value from the AJAX request
$selectedValue = $_POST['selectedValue'];

// Perform a database query based on the selected value
// Adjust this code to your specific database structure and query
$query = "SELECT * FROM detail_pengadaan_obat WHERE id_pengadaan_obat = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $selectedValue);
$stmt->execute();
$result = $stmt->get_result();

// Prepare the options array
$options = array();

// Loop through the query results and add options to the array
while ($row = $result->fetch_assoc()) {
    $option = array(
        'value' => $row['id_detail_pengadaan_obat'],
        'text' => $row['jumlah']
    );
    $options[] = $option;
}

// Return the options as JSON
$response = array(
    'status' => 'success',
    'data' => $options
);
echo json_encode($response);
?>
