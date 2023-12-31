<?php
include "../connection.php";
$id = $_GET['id'];
$result = mysqli_query($con, "DELETE FROM ttk WHERE id_ttk=$id");

echo "<meta http-equiv='refresh' content='0; url=?page=ttk-show'>";