<?php
// Connect to your database
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the data and sum the price_column values from the three tables
$sql = "SELECT SUM(price_column) AS total_price, MONTH(date_column) AS month FROM (
        SELECT price_column, date_column FROM laptop_table
        UNION ALL
        SELECT price_column, date_column FROM smartphone_table
        UNION ALL
        SELECT price_column, date_column FROM TV_table
    ) AS combined_data
    GROUP BY month
    ORDER BY month";

$result = $conn->query($sql);

// Store the sorted months in an array
$months = array();
while ($row = $result->fetch_assoc()) {
    $month = date('M', mktime(0, 0, 0, $row["month"], 1));
    array_push($months, $month);
}

// Close the database connection
$conn->close();

// Encode the months array as JSON and send it as the response
echo json_encode($months);
?>
