<?php
include "../connection.php";
$id = $_GET['id'];
$result = mysqli_query($con, "DELETE FROM stok_obat WHERE id_stok_obat=$id");



echo "<meta http-equiv='refresh' content='0; url=?page=stok_obat-show'>";