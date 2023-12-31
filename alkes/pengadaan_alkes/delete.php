<?php
include "../connection.php";
$id = $_GET['id'];
$result = mysqli_query($con, "DELETE FROM pengadaan_alkes WHERE id_pengadaan_alkes=$id");
// $result2 = mysqli_query($con, "DELETE FROM detail_pengadaan_alkes WHERE id_pengadaan_alkes=$id");

// $id = 123; // Example id_pengadaan_alkes value

// Retrieve all records with the specified id_pengadaan_alkes
$query = mysqli_query($con, "SELECT * FROM detail_pengadaan_alkes WHERE id_pengadaan_alkes=$id");

// Store the ids of the records to be deleted
$ids = array();
while ($row = mysqli_fetch_assoc($query)) {
    $ids[] = $row['id_detail_pengadaan_alkes'];
}

// Delete the records with the specified ids
if (!empty($ids)) {
    $idsString = implode(',', $ids);
    $result = mysqli_query($con, "DELETE FROM detail_pengadaan_alkes WHERE id_detail_pengadaan_alkes IN ($idsString)");
    if ($result) {
        echo "Records deleted successfully.";
    } else {
        echo "Error deleting records: " . mysqli_error($con);
    }
} else {
    echo "No records found.";
}


echo "<meta http-equiv='refresh' content='0; url=?page=pengadaan_alkes-show'>";