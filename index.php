<?php
include 'connection.php';
$result = mysqli_query($con, "SELECT * FROM user");
$cek = mysqli_num_rows($result);
if ($cek == 0) {
  $userEmpty = true;
}

?>

<?php

if (isset($_POST['login'])) {
  $username   = $_POST['username'];
  $inputpass  = md5($_POST['password']);

  include 'connection.php';
  $result = mysqli_query($con, "SELECT * FROM user WHERE username='$username'");
  $cek = mysqli_num_rows($result);
  if ($cek > 0) {
    $data = mysqli_fetch_assoc($result);
    session_start();
    $_SESSION['username'] = $data['username'];
    $_SESSION['level'] = $data['level'];
    $_SESSION['status'] = 'login';
    $_SESSION['id_ttk'] = $data['id_ttk'];
    $pass = $data['password'];
    if ($pass == $inputpass) {
      header('Location:admin/index.php');
      exit;
    } else {
      $error = true;
    }
  } else {
    $error = true;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <!-- <title>Mahabbah | Admin</title> -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet" />

  <link href="css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<body class="bg-gradient-info">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-6 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">

              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login User</h1>
                    <img src="assets/img/logo_mahabbah-removebg-preview.png"  alt="Logo" width="120px" class="mb-2">
                    <hr>
                  </div>
                  <form class="user" method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="username" placeholder="Username"
                        required>
                    </div>
                    <div class=" form-group">
                      <input type="password" class="form-control form-control-user" name="password"
                        placeholder="Password" required>
                    </div>

                    <input type="submit" name="login" value="Login" class="btn btn-info btn-user btn-block">

                    <hr>
                    <?php if (isset($userEmpty)) : ?>
                    <p><strong>Data user</strong> masih kosong,
                      <strong><a href="admin/index.php?page=user-add" class="fw-bold text-decoration-underline">Klik
                          Disini</a></strong>
                      untuk menambahkan data user baru.
                      baru
                    </p>
                    <?php endif; ?>

                    <?php if (isset($error)) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Login gagal</strong> Periksa kembali Username dan Password
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <?php endif; ?>
                  </form>
                  <a type="button" name="login" href="register.php" class="btn btn-light border-bottom-dark text-info btn-user btn-block">Register</a>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>

  <script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function() {
      $(this).remove();
    });
  }, 5000);
  </script>

</body>

</html>