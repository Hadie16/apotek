<?php
include "../connection.php";
$id = $_GET['id'];
$result = mysqli_query($con, "DELETE FROM detail_cek_kesehatan WHERE id=$id");

echo "<meta http-equiv='refresh' content='0; url=?page=cek_kesehatan-detail'>";