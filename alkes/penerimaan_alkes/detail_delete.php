<?php
include "../connection.php";
$id = $_GET['id'];
$result = mysqli_query($con, "DELETE FROM detail_penerimaan_alkes WHERE id_detail_penerimaan_alkes=$id");

// echo "<meta http-equiv='refresh' content='0; url=?page=detail_penerimaan_alkes-show'>";

echo "<script>window.location.href = '?page=detail_penerimaan_alkes-show&id=" . $id . "';</script>";
