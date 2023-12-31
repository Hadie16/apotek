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
// $sql = "SELECT * FROM penjualan_obat WHERE MONTH(tanggal_penjualan_obat) = ? AND YEAR(tanggal_penjualan_obat) = ?";

if($month !== "0"){

    $sql = 'SELECT a.satuan,a.id_obat,c.nama_obat, SUM(jumlah_detail_penjualan_obat) AS jumlah,harga_detail_penjualan_obat, SUM(harga_detail_penjualan_obat) as total_harga FROM detail_penjualan_obat as a join penjualan_obat as b on a.id_penjualan_obat=b.id_penjualan_obat join obat c on a.id_obat=c.id_obat WHERE MONTH(tanggal_penjualan_obat) = ? and YEAR(tanggal_penjualan_obat) = ? GROUP BY nama_obat ORDER BY jumlah';


$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $month, $year);
$stmt->execute();
$result = $stmt->get_result();



}else{
  
    $sql ='SELECT a.satuan,a.id_obat,c.nama_obat, SUM(jumlah_detail_penjualan_obat) AS jumlah,harga_detail_penjualan_obat, SUM(harga_detail_penjualan_obat) as total_harga FROM detail_penjualan_obat as a join penjualan_obat as b on a.id_penjualan_obat=b.id_penjualan_obat join obat c on a.id_obat=c.id_obat WHERE YEAR(tanggal_penjualan_obat) = ?
    GROUP BY nama_obat
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
<th >Nama Obat</th>


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
    $tableHTML .= '<td>' . $row['nama_obat'] . '</td>';
    $tableHTML .= '<td>' . $row['jumlah'] . '</td>';
    $tableHTML .= '<td>' . $row['satuan'] . '</td>';

    $tableHTML .= '<td>' . "Rp".number_format($row['harga_detail_penjualan_obat'],0,'.'). '</td>';
  
    $tableHTML .= '<td>' . "Rp".number_format($row['jumlah']*$row['harga_detail_penjualan_obat'],0,'.') . '</td>';

  

    $tableHTML .= '</tr>';
}


$tableHTML .= '</table>';

echo $tableHTML;

// Close the database connection
$stmt->close();
$conn->close();
?>
