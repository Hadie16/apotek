<?php
include "../connection.php";
$id = $_GET['id'];
$result = mysqli_query($con, "DELETE FROM retur_alkes WHERE id_retur_alkes=$id");
// $result2 = mysqli_query($con, "DELETE FROM detail_retur_alkes WHERE id_retur_alkes=$id");

// $id = 123; // Example id_retur_alkes value

// Retrieve all records with the specified id_retur_alkes
$query = mysqli_query($con, "SELECT * FROM detail_retur_alkes WHERE id_retur_alkes=$id");

// Store the ids of the records to be deleted
$ids = array();
while ($row = mysqli_fetch_assoc($query)) {
    $ids[] = $row['id_detail_retur_alkes'];
}

// Delete the records with the specified ids
if (!empty($ids)) {
    $idsString = implode(',', $ids);
    $result = mysqli_query($con, "DELETE FROM detail_retur_alkes WHERE id_detail_retur_alkes IN ($idsString)");
    if ($result) {
        echo "Records deleted successfully.";
    } else {
        echo "Error deleting records: " . mysqli_error($con);
    }
} else {
    echo "No records found.";
}


echo "<meta http-equiv='refresh' content='0; url=?page=retur_alkes-show'>";