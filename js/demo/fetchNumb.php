<?php
// Retrieve data from the three tables and store price_column and date_column values in arrays
$laptop_table = [
    ['price_column' => 1000, 'date_column' => '2023-01-05'],
    ['price_column' => 1500, 'date_column' => '2023-03-10'],
    ['price_column' => 1200, 'date_column' => '2023-05-15']
];

$smartphone_table = [
    ['price_column' => 800, 'date_column' => '2023-02-12'],
    ['price_column' => 900, 'date_column' => '2023-04-20'],
    ['price_column' => 1000, 'date_column' => '2023-06-25']
];

$TV_table = [
    ['price_column' => 2000, 'date_column' => '2023-01-18'],
    ['price_column' => 1800, 'date_column' => '2023-04-08'],
    ['price_column' => 2100, 'date_column' => '2023-07-02']
];

// Merge the price_column arrays into a single array
$priceData = array_merge(array_column($laptop_table, 'price_column'), array_column($smartphone_table, 'price_column'), array_column($TV_table, 'price_column'));

// Merge the date_column arrays into a single array
$dateData = array_merge(array_column($laptop_table, 'date_column'), array_column($smartphone_table, 'date_column'), array_column($TV_table, 'date_column'));

// Combine priceData and dateData into an associative array
$dataDict = array_combine($dateData, $priceData);

// Sort the associative array based on the dates
ksort($dataDict);

// Extract the sorted prices and convert them to numbers
$data = array_values($dataDict);
$data = array_map('intval', $data);

// Encode the data as JSON and send it as a response
echo json_encode($data);
?>
