<?php
session_start();
if ($_SESSION['status'] != "login") {
  header("location:../index.php");
}


// ====

// Start the session
// session_start();

// // Check if the user is logged in and has the 'status' session variable set
// if (isset($_SESSION['status'])) {
//     if ($_SESSION['status'] === 'admin') {
//         // Redirect to the admin dashboard
//         header('Location: admin/admin_dashboard.php');
//         exit();
//     } elseif ($_SESSION['status'] === 'cashier') {
//         // Redirect to the cashier dashboard
//         header('Location: cashier/cashier_dashboard.php');
//         exit();
//     }
// } else {
//     // User not logged in, redirect to login page
//     header('Location: login.php');
//     exit();
// }
