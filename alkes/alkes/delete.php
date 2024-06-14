<?php
include "../connection.php";
$id = $_GET['id'];

// Retrieve the filename of the image associated with the record
$result = mysqli_query($con, "SELECT gambar_alkes FROM alkes WHERE id_alkes=$id");
$row = mysqli_fetch_assoc($result);
$filename = $row['gambar_alkes'];

// Delete the record from the database
$deleteQuery = "DELETE FROM alkes WHERE id_alkes=$id";
if (mysqli_query($con, $deleteQuery)) {
    // Delete the associated image file
    $imagePath = '../uploads/' . $filename;
    if (file_exists($imagePath)) {
        unlink($imagePath); // Delete the image file
    }
    echo "Record deleted successfully.";
    // echo "<script>window.location.href = '?page=alkes-show';</script>";
} else {
    echo "Error deleting record: " . mysqli_error($con);
}

echo "<meta http-equiv='refresh' content='0; url=?page=alkes-show'>";
?>
