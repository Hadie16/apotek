<?php
include 'connection.php';


if (isset($_POST['submit'])) {
  $username   = $_POST['username'];
  $inputpass  = md5($_POST['password']);

  $nama_ttk = $_POST['nama_ttk'];
  $telepon_ttk = $_POST['telepon_ttk'];
  $email_ttk = $_POST['email_ttk'];
  $alamat_ttk = $_POST['alamat_ttk'];


  // include 'connection.php';
  $result = mysqli_query($con, "SELECT * FROM user WHERE username='$username'");
  $cek = mysqli_num_rows($result);
  if ($cek > 0) {
    echo "<script>
            alert('Gunakan username dengan nama yang lain!');
            window.location.href = 'register.php';
          </script>";
    exit;
  }
  $insert = mysqli_query($con, "INSERT INTO ttk(nama_ttk,telepon_ttk,email_ttk,alamat_ttk,status_ttk) VALUES('$nama_ttk','$telepon_ttk','$email_ttk','$alamat_ttk','Aktif')");

  $firstTableID = mysqli_insert_id($con);

  $insert2 = mysqli_query($con, "INSERT INTO user(username,password,level,id_ttk) VALUES('$username','$inputpass','ttk','$firstTableID')");

  if ($insert2) {
    echo "<script>window.location.href = 'index.php';</script>";
    
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
                    <h1 class="h4 text-gray-900 mb-4">Register User</h1>
                    <img src="assets/img/logo_mahabbah-removebg-preview.png"  alt="Logo" width="120px" class="mb-2">
                    <hr>
                  </div>
                  <form class="user" method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="nama_ttk" placeholder="Nama Lengkap"
                        required>
                    </div>
                    <div class=" form-group">
                      <input type="text" class="form-control form-control-user" name="telepon_ttk"
                        placeholder="Telepon" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="email_ttk" placeholder="Email"
                        required>
                    </div>
                    <div class=" form-group">
                      <input type="text" class="form-control form-control-user" name="alamat_ttk"
                        placeholder="Alamat" required>
                    </div>
          <hr>

                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="username" placeholder="Username"
                        required>
                    </div>
                    <div class=" form-group">
                      <input type="password" class="form-control form-control-user" name="password"
                        placeholder="Password" required>
                    </div>
                 

                    <input type="submit" name="submit" value="Submit" class="btn btn-info btn-user btn-block">

                    <hr>
              
                  </form>
                  <a type="button" name="back" href="index.php" class="btn btn-light border-bottom-dark text-info btn-user btn-block">Back</a>

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