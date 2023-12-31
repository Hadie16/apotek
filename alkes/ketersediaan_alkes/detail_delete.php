<?php
include "../connection.php";
$id = $_GET['id'];
$result = mysqli_query($con, "DELETE FROM ketersediaan_alkes WHERE id_ketersediaan_alkes=$id");

// if ($result) {
//     echo "<p>query berhasil<p/>";
// } else {
//     die('invalid Query : ' . mysqli_error($con));
// }

echo "<meta http-equiv='refresh' content='0; url=?page=ketersediaan_alkes-show'>";