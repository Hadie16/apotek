<?php
// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mahabbah";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected country from the URL parameter
$country = $_GET['country'];

// Prepare a SQL query to fetch cities based on the selected country
$sql = "SELECT * FROM ketersediaan_alkes WHERE id_alkes = ?";

// Use prepared statements to prevent SQL injection
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $country); // 's' indicates a string parameter
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Fetch the cities into an array
    $cities = array();
    while ($row = $result->fetch_assoc()) {
        $cities[] = $row['batch_number'];
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();

// Send JSON response to the client
header('Content-Type: application/json');
echo json_encode($cities);
?>
