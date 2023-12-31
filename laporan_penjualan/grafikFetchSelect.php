<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $month = $_POST['month'];
    $year = $_POST['year'];
    $switchInput = $_POST['switchInput'];
    

    include '../connection.php';

    // Your database query
    if($switchInput == "obatBtn"){
        
    if($month == "0"){
    $query = mysqli_query($con, "SELECT a.id_obat, c.nama_obat, SUM(jumlah_detail_penjualan_obat) AS jumlah
                                  FROM detail_penjualan_obat as a
                                  JOIN penjualan_obat as b ON a.id_penjualan_obat = b.id_penjualan_obat
                                  JOIN obat c ON a.id_obat = c.id_obat
                                  WHERE YEAR(tanggal_penjualan_obat) = $year
                                  GROUP BY nama_obat
                                  ORDER BY jumlah DESC
                                  LIMIT 5");
    }else{
        $query = mysqli_query($con, "SELECT a.id_obat, c.nama_obat, SUM(jumlah_detail_penjualan_obat) AS jumlah
        FROM detail_penjualan_obat as a
        JOIN penjualan_obat as b ON a.id_penjualan_obat = b.id_penjualan_obat
        JOIN obat c ON a.id_obat = c.id_obat
        WHERE MONTH(tanggal_penjualan_obat) = $month and YEAR(tanggal_penjualan_obat) = $year
        GROUP BY nama_obat
        ORDER BY jumlah DESC
        LIMIT 5");
    }
}else{
    if($month == "0"){
    $query = mysqli_query($con, "SELECT a.id_alkes, c.nama_alkes, SUM(jumlah_detail_penjualan_alkes) AS jumlah
    FROM detail_penjualan_alkes as a
    JOIN penjualan_alkes as b ON a.id_penjualan_alkes = b.id_penjualan_alkes
    JOIN alkes c ON a.id_alkes = c.id_alkes
    WHERE YEAR(tanggal_penjualan_alkes) = $year
    GROUP BY nama_alkes
    ORDER BY jumlah DESC
    LIMIT 5");
}else{
$query = mysqli_query($con, "SELECT a.id_alkes, c.nama_alkes, SUM(jumlah_detail_penjualan_alkes) AS jumlah
FROM detail_penjualan_alkes as a
JOIN penjualan_alkes as b ON a.id_penjualan_alkes = b.id_penjualan_alkes
JOIN alkes c ON a.id_alkes = c.id_alkes
WHERE MONTH(tanggal_penjualan_alkes) = $month and YEAR(tanggal_penjualan_alkes) = $year
GROUP BY nama_alkes
ORDER BY jumlah DESC
LIMIT 5");
}
    
}

    if (!$query) {
        // Handle database query error
        $error = mysqli_error($con);
        echo json_encode(['error' => $error]);
    } else {
        // Initialize arrays to store labels and data
        $labelss = [];
        $datass = [];

        if($switchInput == "obatBtn"){
        // Loop through the query results and populate the arrays
        while ($row = mysqli_fetch_assoc($query)) {
            $labelss[] = $row['nama_obat'];
            $datass[] = $row['jumlah'];
        }
    }else{
        while ($row = mysqli_fetch_assoc($query)) {
            $labelss[] = $row['nama_alkes'];
            $datass[] = $row['jumlah'];
        }
    }

        // Create an associative array with your data
        $data = [
            'labelsssa' => $labelss,
            'datasssa' => $datass,
        ];

        // Convert the data to JSON format
        $jsonData = json_encode($data);

        // Send the JSON response back to the client
        header('Content-Type: application/json');
        echo $jsonData;
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo "Invalid request method.";
}
?>
