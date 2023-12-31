<?php
include "../connection.php";
$id = $_GET['id'];
$result = mysqli_query($con, "DELETE FROM ketersediaan_obat WHERE id_ketersediaan_obat=$id");



echo "<meta http-equiv='refresh' content='0; url=?page=ketersediaan_obat-show'>";