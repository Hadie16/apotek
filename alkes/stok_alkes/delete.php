<?php
include "../connection.php";
$id = $_GET['id'];
// $result = mysqli_query($con, "DELETE FROM stok_alkes WHERE id_alkes=$id");

// $query = mysqli_query($con, "SELECT * FROM detail_stok_alkes WHERE id_stok_alkes=$id");

// Store the ids of the records to be deleted
$ids = array();
while ($row = mysqli_fetch_assoc($query)) {
    $ids[] = $row['id_alkes'];
}

// Delete the records with the specified ids
if (!empty($ids)) {
    $idsString = implode(',', $ids);
    $result = mysqli_query($con, "DELETE FROM stok_alkes WHERE id_alkes IN ($idsString)");
    if ($result) {
        echo "Records deleted successfully.";
    } else {
        echo "Error deleting records: " . mysqli_error($con);
    }
} else {
    echo "No records found.";
}


echo "<meta http-equiv='refresh' content='0; url=?page=stok_alkes-show'>";