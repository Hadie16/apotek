<?php
// Replace with your actual database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "mahabbah";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected month and year from the AJAX request
$month = $_POST['month'];
$year = $_POST['year'];

// Prepare and execute a SQL query to fetch data based on the selected month and year
$sql = "SELECT * FROM penjualan_obat WHERE MONTH(tanggal_penjualan_obat) = ? AND YEAR(tanggal_penjualan_obat) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $month, $year);
$stmt->execute();
$result = $stmt->get_result();

// Generate the dynamic table HTML
$tableHTML = '<table>';
$tableHTML .= '<tr><th>Header 1</th><th>Header 2</th></tr>';

while ($row = $result->fetch_assoc()) {
    $tableHTML .= '<tr>';
    $tableHTML .= '<td>' . $row['id_penjualan_obat'] . '</td>';
    $tableHTML .= '<td>' . $row['id_penjualan_obat'] . '</td>';
    $tableHTML .= '</tr>';
}

$tableHTML .= '</table>';

echo $tableHTML;

// Close the database connection
$stmt->close();
$conn->close();
?>
