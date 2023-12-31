<?php
// include '../template/header.php';
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

// $currentMonth = date('n');
// $currentYear = date('Y');

// Prepare and execute a SQL query to fetch data based on the selected month and year
// $sql = "SELECT * FROM penjualan_alkes WHERE MONTH(tanggal_penjualan_alkes) = ? AND YEAR(tanggal_penjualan_alkes) = ?";

if($month !== "0"){

    $sql = 'SELECT a.satuan,a.id_alkes,c.nama_alkes, SUM(jumlah_detail_penjualan_alkes) AS jumlah,harga_detail_penjualan_alkes, SUM(harga_detail_penjualan_alkes) as total_harga FROM detail_penjualan_alkes as a join penjualan_alkes as b on a.id_penjualan_alkes=b.id_penjualan_alkes join alkes c on a.id_alkes=c.id_alkes WHERE MONTH(tanggal_penjualan_alkes) = ? and YEAR(tanggal_penjualan_alkes) = ? GROUP BY nama_alkes ORDER BY jumlah';


$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $month, $year);
$stmt->execute();
$result = $stmt->get_result();



}else{
  
    $sql ='SELECT a.satuan,a.id_alkes,c.nama_alkes, SUM(jumlah_detail_penjualan_alkes) AS jumlah,harga_detail_penjualan_alkes, SUM(harga_detail_penjualan_alkes) as total_harga FROM detail_penjualan_alkes as a join penjualan_alkes as b on a.id_penjualan_alkes=b.id_penjualan_alkes join alkes c on a.id_alkes=c.id_alkes WHERE YEAR(tanggal_penjualan_alkes) = ?
    GROUP BY nama_alkes
    ORDER BY jumlah';
  
  
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $year);
  $stmt->execute();
  $result = $stmt->get_result();
  

  
}
// Generate the dynamic table HTML
$tableHTML = ' <table class="table table-bordered table-hover" id="viewTopB" style="width: 100%;">';
$tableHTML .= '  

<thead class="bg-secondary text-white" >

<tr align="center"> 
 <th >No</th>
<th >Nama Alkes</th>


<th >Jumlah</th>
<th >Satuan</th>


  <th >Harga</th>
  <th >Total Harga</th>
</tr>
</thead>



';

$no=1;
while ($row = $result->fetch_assoc()) {
    $tableHTML .= '<tr>';
    $tableHTML .= '<td>' .  $no++ . '</td>';
    $tableHTML .= '<td>' . $row['nama_alkes'] . '</td>';
    $tableHTML .= '<td>' . $row['jumlah'] . '</td>';
    $tableHTML .= '<td>' . $row['satuan'] . '</td>';

    $tableHTML .= '<td>' . "Rp".number_format($row['harga_detail_penjualan_alkes'],0,'.'). '</td>';
  
    $tableHTML .= '<td>' . "Rp".number_format($row['jumlah']*$row['harga_detail_penjualan_alkes'],0,'.') . '</td>';

  

    $tableHTML .= '</tr>';
}


$tableHTML .= '</table>';

echo $tableHTML;

// Close the database connection
$stmt->close();
$conn->close();
?>
