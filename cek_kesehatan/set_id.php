<?php
// set_id.php

// Start or resume the session
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
    // $id= 46;
    // Set the session variable 'id' to the received value
    $_SESSION['id'] = $id;
  }
}
?>
