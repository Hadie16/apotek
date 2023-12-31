<?php
include "../connection.php";
$id = $_GET['id'];
$result = mysqli_query($con, "DELETE FROM obat WHERE id_obat=$id");

echo "<meta http-equiv='refresh' content='0; url=?page=obat-show'>";