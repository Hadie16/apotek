<?php
include "../connection.php";
$id = $_GET['id'];
$result = mysqli_query($con, "DELETE FROM supplier WHERE id_supplier=$id");

echo "<meta http-equiv='refresh' content='0; url=?page=supplier-show'>";