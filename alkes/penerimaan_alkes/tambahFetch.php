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
$conds = $_POST['conds'];


if($conds == "pesan"){

    $sql = 'SELECT a.*,b.nama_supplier suppliers FROM pengadaan_alkes a join supplier b on a.id_supplier=b.id_supplier where status = ?';

$pesan="Dipesan";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $pesan);
$stmt->execute();
$result = $stmt->get_result();


// Generate the dynamic table HTML
$tableHTML = ' <table class="table table-bordered table-hover" id="vi" style="width: 100%;">';
$tableHTML .= '  

<thead class="bg-secondary text-white" >

<tr align="center"> 
 <th >No</th>
<th >Kode</th>
<th >Jenis Produk</th>
<th >Tanggal</th>
  <th >Supplier</th>
  <th >Aksi</th>

</tr>
</thead>
';

$no=1;
while ($row = $result->fetch_assoc()) {
    $tableHTML .= '<tr>';
    $tableHTML .= '<td>' .  $no++ . '</td>';
    $tableHTML .= '<td>' . $row['kode'] . '</td>';
    $tableHTML .= '<td>' . $row['jenis_produk'] . '</td>';
    $tableHTML .= '<td>' . $row['tanggal'] . '</td>';
    $tableHTML .= '<td>' . $row['suppliers'] . '</td>';
   

    $tableHTML .= '<td> <a class="btn bg-info text-white" href="?page=penerimaan_alkes-add&id1=' . $row['id_pengadaan_alkes'] . '&id2='. $row['kode'] .'">Pilih</a></td>';

    $tableHTML .= '</tr>';
}

$tableHTML .= '</table>';

echo $tableHTML;

// Close the database connection
$stmt->close();
$conn->close();
}else{
  
    $sql = 'SELECT a.*,b.nama_supplier suppliers FROM retur_alkes a join supplier b on a.id_supplier=b.id_supplier where status = ?';

$proses="Proses";
  
  
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $proses);
  $stmt->execute();
  $result = $stmt->get_result();
  

  // Generate the dynamic table HTML
$tableHTML = ' <table class="table table-bordered table-hover" id="vi" style="width: 100%;">';
$tableHTML .= '  

<thead class="bg-secondary text-white" >

<tr align="center"> 
 <th >No</th>
<th >Kode</th>

<th >Tanggal</th>
  <th >Supplier</th>
  <th >Aksi</th>


</tr>
</thead>
';

$no=1;
while ($row = $result->fetch_assoc()) {
    $tableHTML .= '<tr>';
    $tableHTML .= '<td>' .  $no++ . '</td>';
    $tableHTML .= '<td>' . $row['kode_retur_alkes'] . '</td>';
    // $tableHTML .= '<td>' . $row['jenis_produk'] . '</td>';
    $tableHTML .= '<td>' . $row['tanggal_retur'] . '</td>';
    $tableHTML .= '<td>' . $row['suppliers'] . '</td>';
    $tableHTML .= '<td> <a class="btn bg-info text-white" href="?page=penerimaan_alkes-add_retur&id1= ' . $row['id_retur_alkes'] . '&id2='. $row['kode_retur_alkes'] .'">Pilih</a></td>';

    $tableHTML .= '</tr>';
}

$tableHTML .= '</table>';

echo $tableHTML;

// Close the database connection
$stmt->close();
$conn->close();
}
?>