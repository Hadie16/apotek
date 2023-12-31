<?php
include "../connection.php";
$id = $_GET['id'];
$result = mysqli_query($con, "DELETE FROM stok_alkes WHERE id_stok_alkes=$id");



echo "<meta http-equiv='refresh' content='0; url=?page=stok_alkes-show'>";