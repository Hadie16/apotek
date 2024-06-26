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
$id = $_POST['cek_id']; // Ensure $id is properly sanitized to prevent SQL injection
// $id = 5;


$query = mysqli_query($conn, "SELECT * FROM detail_cek_kesehatan dck JOIN cek_kesehatan ck ON dck.id_cek_kesehatan = ck.id_cek_kesehatan WHERE dck.id_cek_kesehatan = $id order by id_detail_cek_kesehatan");

// Initialize arrays to store $b and $k values
$biaya_values = array();
$id_kategori_values = array();

while ($data = mysqli_fetch_assoc($query)) {
    $biaya_values[] = $data['biaya'];
    $id_kategori_values[] = $data['id_kategori'];
}

// Close the database connection
mysqli_close($conn);

// Initialize the $tableHTML variable
$tableHTML = '';

$b1=$biaya_values[0];
$b2=$biaya_values[1];
$b3=$biaya_values[2];
$k1=$id_kategori_values[0];
$k2=$id_kategori_values[1];
$k3=$id_kategori_values[2];

// Build HTML for input fields
$tableHTML .= '<input type="hidden" id="idInput" name="id" value="'.$id.'">';


$tableHTML .= '<div class="form-group">';
$tableHTML .= '<label for="inputValue">Input Nilai Gula Darah:</label>';
$tableHTML .= '<input type="text" class="form-control" id="inputValue" name="inputValue" ' . (($b1 == 10000 && $k1 == 1) ? '' : 'disabled') . '>';
$tableHTML .= '</div>';

$tableHTML .= '<div class="form-group">';
$tableHTML .= '<label for="inputValue2">Input Nilai Asam Urat:</label>';
$tableHTML .= '<input type="text" class="form-control" id="inputValue2" name="inputValue2" ' . (($b2 == 10000 && $k2 == 2) ? '' : 'disabled') . '>';
$tableHTML .= '</div>';

$tableHTML .= '<div class="form-group">';
$tableHTML .= '<label for="inputValue3">Input Nilai Kolesterol:</label>';
$tableHTML .= '<input type="text" class="form-control" id="inputValue3" name="inputValue3" ' . (($b3 == 20000 && $k3 == 3) ? '' : 'disabled') . '>';
$tableHTML .= '</div>';



// Output the HTML
echo $tableHTML;
// $conn->close();

?>
