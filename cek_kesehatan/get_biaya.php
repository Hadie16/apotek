<?php
include '../connection.php';

if (isset($_GET['id_kategori'])) {
  $id_kategori = $_GET['id_kategori'];

  $query = mysqli_query($con, "SELECT * FROM kategori_cek_kesehatan WHERE id_kategori = $id_kategori");
  $data = mysqli_fetch_assoc($query);

  echo json_encode($data);
} else {
  echo json_encode(null);
}
?>
