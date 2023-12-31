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

$sql = "SELECT *,sum(dpo.jumlah_detail_penjualan_obat) as sj from
detail_penjualan_obat as dpo join penjualan_obat as po on dpo.id_penjualan_obat=po.id_penjualan_obat 
 join ketersediaan_obat as ko on dpo.id_obat=ko.id_obat join obat as o on dpo.id_obat=o.id_obat where month(po.tanggal_penjualan_obat)= ? AND YEAR(tanggal_penjualan_obat) = ? group by dpo.id_obat
";


$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $month, $year);
$stmt->execute();
$result = $stmt->get_result();


$sqls = "SELECT *,sum(dpo.jumlah_detail_penjualan_alkes) as sj from
detail_penjualan_alkes as dpo join penjualan_alkes as po on dpo.id_penjualan_alkes=po.id_penjualan_alkes 
 join ketersediaan_alkes as ko on dpo.id_alkes=ko.id_alkes join alkes as o on dpo.id_alkes=o.id_alkes where month(po.tanggal_penjualan_alkes)= ? AND YEAR(tanggal_penjualan_alkes) = ? group by dpo.id_alkes
";


$stmts = $conn->prepare($sqls);
$stmts->bind_param("ss", $month, $year);
$stmts->execute();
$results = $stmts->get_result();

}else{
  
  $sql = "SELECT *,sum(dpo.jumlah_detail_penjualan_obat) as sj from
  detail_penjualan_obat as dpo join penjualan_obat as po on dpo.id_penjualan_obat=po.id_penjualan_obat 
   join ketersediaan_obat as ko on dpo.id_obat=ko.id_obat join obat as o on dpo.id_obat=o.id_obat where YEAR(tanggal_penjualan_obat) = ? group by dpo.id_obat
  ";
  
  
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $year);
  $stmt->execute();
  $result = $stmt->get_result();
  
  
  $sqls = "SELECT *,sum(dpo.jumlah_detail_penjualan_alkes) as sj from
  detail_penjualan_alkes as dpo join penjualan_alkes as po on dpo.id_penjualan_alkes=po.id_penjualan_alkes 
   join ketersediaan_alkes as ko on dpo.id_alkes=ko.id_alkes join alkes as o on dpo.id_alkes=o.id_alkes where YEAR(tanggal_penjualan_alkes) = ? group by dpo.id_alkes
  ";
  
  
  $stmts = $conn->prepare($sqls);
  $stmts->bind_param("s", $year);
  $stmts->execute();
  $results = $stmts->get_result();
  
}
// Generate the dynamic table HTML
$tableHTML = ' <table class="table table-bordered table-hover" id="vieObat" style="width: 100%;">';
$tableHTML .= '  

<thead class="bg-secondary text-white" >

<tr align="center"> 
 <th >No</th>
<th >Nama</th>


<th >Jumlah</th>
<th >Satuan</th>


  <th >Pendapatan</th>
  <th >Pengeluaran</th>
<th >Profit</th></tr>
</thead>



';

$no=1;
while ($row = $result->fetch_assoc()) {
    $tableHTML .= '<tr>';
    $tableHTML .= '<td>' .  $no++ . '</td>';
    $tableHTML .= '<td>' . $row['nama_obat'] . '</td>';
    $tableHTML .= '<td>' . $row['sj'] . '</td>';
    $tableHTML .= '<td>' . $row['satuan'] . '</td>';

    $tableHTML .= '<td>' . "Rp".number_format($v1t = $row['harga_detail_penjualan_obat']*$row['sj'],'0','.','.') . '</td>';
    $tableHTML .= '<td style="display:none">' . $v1tx+=$v1t . '</td>';
    $tableHTML .= '<td>' . "Rp".number_format($v2t = $row['harga_beli_obat']*$row['sj'],'0','.','.') . '</td>';
    $tableHTML .= '<td style="display:none">' . $v2tx+=$v2t. '</td>';

    $tableHTML .= '<td>' . "Rp".number_format($v1t-$v2t,'0','.','.') . '</td>';
  

    $tableHTML .= '</tr>';
}
$tableHTML .= '
<tr>
             
<td colspan="4" class="text-center font-weight-bold" style="border-bottom:1px solid">
  Total
</td>  ';

$tableHTML .= '<td class="font-weight-bold" style="border-bottom:1px solid">'."Rp".number_format($v1tx,'0','.','.'). '</td>';

$tableHTML .='<td class="font-weight-bold" style="border-bottom:1px solid">'. "Rp".number_format($v2tx,'0','.','.') . '</td>';

$tableHTML .='<td class="font-weight-bold" style="border-bottom:1px solid">'. "Rp".number_format($v1tx-$v2tx,'0','.','.'). '</td>';

$tableHTML .= '</tr>';

$no=1;
while ($row = $results->fetch_assoc()) {
    $tableHTML .= '<tr>';
    $tableHTML .= '<td>' .  $no++ . '</td>';
    $tableHTML .= '<td>' . $row['nama_alkes'] . '</td>';
    $tableHTML .= '<td>' . $row['sj'] . '</td>';
    $tableHTML .= '<td>' . $row['satuan'] . '</td>';

    $tableHTML .= '<td>' . "Rp".number_format($v1ts = $row['harga_detail_penjualan_alkes']*$row['sj'],'0','.','.') . '</td>';
    $tableHTML .= '<td style="display:none">' . $v1tsx+=$v1ts . '</td>';
    $tableHTML .= '<td>' . "Rp".number_format($v2ts = $row['harga_beli_alkes']*$row['sj'],'0','.','.') . '</td>';
    $tableHTML .= '<td style="display:none">' . $v2tsx+=$v2ts. '</td>';

    $tableHTML .= '<td>' . "Rp".number_format($v1ts-$v2ts,'0','.','.') . '</td>';
  

    $tableHTML .= '</tr>';
}
$tableHTML .= '
<tr>
             
<td colspan="4" class="text-center font-weight-bold" style="border-bottom:1px solid">
  Total
</td>  ';

$tableHTML .= '<td class="font-weight-bold" style="border-bottom:1px solid">'."Rp".number_format($v1tsx,'0','.','.'). '</td>';

$tableHTML .='<td class="font-weight-bold" style="border-bottom:1px solid">'. "Rp".number_format($v2tsx,'0','.','.') . '</td>';

$tableHTML .='<td class="font-weight-bold" style="border-bottom:1px solid">'. "Rp".number_format($v1tsx-$v2tsx,'0','.','.'). '</td>';

$tableHTML .= '</tr>';

$tableHTML .= '
<tr>
             
<td colspan="4" class="text-center font-weight-bold" style="border-bottom:1px solid">
Grand Total
</td> ';

$tableHTML .= '<td class="font-weight-bold" style="border-bottom:1px solid">'."Rp".number_format($grandtotal1=$v1tx+$v1tsx,'0','.','.'). '</td>';

$tableHTML .='<td class="font-weight-bold" style="border-bottom:1px solid">'. "Rp".number_format($grandtotal2=$v2tx+$v2tsx,'0','.','.') . '</td>';

$tableHTML .='<td class="font-weight-bold" style="border-bottom:1px solid">'. "Rp".number_format($grandtotal1-$grandtotal2,'0','.','.'). '</td>';

$tableHTML .= '</tr>';

$tableHTML .= '</table>';

echo $tableHTML;

// Close the database connection
$stmt->close();
$conn->close();
?>
