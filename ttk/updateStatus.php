<?php
// Replace these variables with your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mahabbah";

// Establish a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the status value is set in the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["status"]) && isset($_POST["id_ttk"])) {
    $status = $_POST['status'];
    $id_ttk = $_POST['id_ttk'];


    // Update the status in the database based on the current value
    if ($status == 'Aktif') {
        $newStatus = 'Tidak aktif';
    } else {
        $newStatus = 'Aktif';
    }

    $sql = "UPDATE ttk SET status = $newStatus WHERE id_ttk=$id_ttk";
    if ($conn->query($sql) === TRUE) {
        // Return a success response to the AJAX request
        echo "Status updated successfully";
    } else {
        // Return an error response to the AJAX request
        echo "Error updating status: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
