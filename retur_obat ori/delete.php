<?php
include "../connection.php";
$id = $_GET['id'];
$result = mysqli_query($con, "DELETE FROM retur_obat WHERE id_retur_obat=$id");

echo "<meta http-equiv='refresh' content='0; url=?page=retur_obat-show'>";