<?php
include "../connection.php";
$id = $_GET['id'];
$result = mysqli_query($con, "DELETE FROM detail_pengadaan_obat WHERE id_detail_pengadaan_obat=$id");

// echo "<meta http-equiv='refresh' content='0; url=?page=detail_pengadaan_obat-show'>";

echo "<script>window.location.href = '?page=detail_pengadaan_obat-show&id=" . $id . "';</script>";
