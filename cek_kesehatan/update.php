<?php
// Handle the AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the ID and input value from the request
  $id = $_POST['id'];
  // $value = $_POST['value'];
  // $value2 = $_POST['value2'];
  // $value3 = $_POST['value3'];



  // Perform the update query using the retrieved values
  // Modify this code according to your database connection and update logic
//   $con = mysqli_connect('localhost', 'username', 'password', 'database');
include '../connection.php';

// $query = mysqli_query($con, "SELECT * FROM detail_cek_kesehatan where id_cek_kesehatan='$id'");
// while ($data = mysqli_fetch_array($query)) { 
//       $data['id_detail_cek_kesehatan'];
// }

// table detail cek kesehatan
if(!empty($_POST['value'])){
  $value = $_POST['value'];
  $query = "UPDATE detail_cek_kesehatan SET nilai = '$value' WHERE id_cek_kesehatan = '$id' and id_kategori = 1";
  $result = mysqli_query($con, $query);
  if ($result) {
    echo "Update successful";
  } else {
    echo "Update failed";
  }
}
if(!empty($_POST['value2'])){
  $value2 = $_POST['value2'];
  $query2 = "UPDATE detail_cek_kesehatan SET nilai = '$value2' WHERE id_cek_kesehatan = '$id' and id_kategori = 2";
  $result2 = mysqli_query($con, $query2);
  if ($result2) {
    echo "Update successful";
  } else {
    echo "Update failed";
  }
}
if(!empty($_POST['value3'])){
  $value3 = $_POST['value3'];
  $query3 = "UPDATE detail_cek_kesehatan SET nilai = '$value3' WHERE id_cek_kesehatan = '$id' and id_kategori = 3";
  $result3 = mysqli_query($con, $query3);
  if ($result3) {
    echo "Update successful";
  } else {
    echo "Update failed";
  }
}

//table cek kesehatan
  $query4 = "UPDATE cek_kesehatan SET status = 'Selesai' WHERE id_cek_kesehatan = '$id'";
  $result4 = mysqli_query($con, $query4);


  // Check the result and send a response
  if ($result4) {
    echo "Update successful";
  } else {
    echo "Update failed";
  }

  // Close the database connection
  mysqli_close($con);
}
?>
