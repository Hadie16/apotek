<?php
// Include your database connection code or require_once your database configuration file

// Fetch data from your three tables
// Replace the query and table names with your own
$query = "SELECT * FROM table1";
$result = mysqli_query($connection, $query);
$table1Data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query = "SELECT * FROM table2";
$result = mysqli_query($connection, $query);
$table2Data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query = "SELECT * FROM table3";
$result = mysqli_query($connection, $query);
$table3Data = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Assemble the data into the format expected by Chart.js
$labels = []; // Array to hold the labels
$datasets = []; // Array to hold the datasets

// Extract the necessary data from each table
// Modify this section based on your table structure and data requirements
foreach ($table1Data as $row) {
    $labels[] = $row['label']; // Replace 'label' with the appropriate column name
    $datasets[0]['data'][] = $row['value']; // Replace 'value' with the appropriate column name
}

foreach ($table2Data as $row) {
    $datasets[1]['data'][] = $row['value']; // Replace 'value' with the appropriate column name
}

foreach ($table3Data as $row) {
    $datasets[2]['data'][] = $row['value']; // Replace 'value' with the appropriate column name
}

// Assemble the final data array
$data = [
    'labels' => $labels,
    'datasets' => $datasets
];

// Convert the data array to JSON format
$jsonData = json_encode($data);

// Return the JSON response
header('Content-Type: application/json');
echo $jsonData;
