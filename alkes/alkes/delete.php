<?php
include "../connection.php";
$id = $_GET['id'];
$result = mysqli_query($con, "DELETE FROM alkes WHERE id_alkes=$id");

echo "<meta http-equiv='refresh' content='0; url=?page=alkes-show'>";