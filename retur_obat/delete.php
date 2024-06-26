<?php
include "../connection.php";

$id = $_GET['id'];

// Retrieve all records with the specified id_retur_obat
$query = mysqli_query($con, "SELECT * FROM detail_retur_obat WHERE id_retur_obat=$id");

// Store the ids of the records to be deleted
$ids = array();
while ($row = mysqli_fetch_assoc($query)) {
    $ids[] = $row['id_detail_retur_obat'];
}

// Delete the records with the specified ids
if (!empty($ids)) {
    $idsString = implode(',', $ids);
    $result = mysqli_query($con, "DELETE FROM detail_retur_obat WHERE id_detail_retur_obat IN ($idsString)");
    if ($result) {
        echo "Records deleted successfully.";
    } else {
        echo "Error deleting records: " . mysqli_error($con);
    }
} else {
    echo "No records found.";
}

$result = mysqli_query($con, "DELETE FROM retur_obat WHERE id_retur_obat='$id'");

echo "<meta http-equiv='refresh' content='0; url=?page=retur_obat-show'>";