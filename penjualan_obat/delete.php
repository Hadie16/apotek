<?php
include "../connection.php";
$id = $_GET['id'];
$result = mysqli_query($con, "DELETE FROM penjualan_obat WHERE id_penjualan_obat=$id");

$query = mysqli_query($con, "SELECT * FROM detail_penjualan_obat WHERE id_penjualan_obat=$id");

// Store the ids of the records to be deleted
$ids = array();
while ($row = mysqli_fetch_assoc($query)) {
    $ids[] = $row['id_detail_penjualan_obat'];
}

// Delete the records with the specified ids
if (!empty($ids)) {
    $idsString = implode(',', $ids);
    $result = mysqli_query($con, "DELETE FROM detail_penjualan_obat WHERE id_detail_penjualan_obat IN ($idsString)");
    if ($result) {
        echo "Records deleted successfully.";
    } else {
        echo "Error deleting records: " . mysqli_error($con);
    }
} else {
    echo "No records found.";
}


echo "<meta http-equiv='refresh' content='0; url=?page=penjualan_obat-show'>";