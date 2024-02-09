<?php
include "koneksi.php";
session_start();
if(!isset($_SESSION['nama'])){
    if (isset($_POST["submit"])) {
        $nama = $_POST["nama"];
        $password = md5($_POST["password"]);
        $query = "SELECT * FROM siswapkl where nama = '$nama'";
        $sql = mysqli_query($conn, $query);
        if ($sql && mysqli_num_rows($sql) == 1) {
            $user = mysqli_fetch_assoc($sql);
            if ($password == $user['password']) {
                if ($user["is_admin"] == true) {
                    $_SESSION['nama'] = $nama;
                    header("Location: indexadmin.php");
                } else {
                    $_SESSION['nama'] = $nama;
                    header("Location: index.php");
                }
            }else{
                echo "<script>alert('password salah ')</script>";
            }
        }else{
            echo "<script>alert('username tidak di temukan ')</script>";
        }
    }
}else if($_SESSION['nama'] == 'adminlaura'){
    header("Location: indexadmin.php");
}
else{
    header("Location: index.php");
}

?>




<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-white">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center align-content-center" style="height:100vh;">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="text" name="nama" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username">
                                        </div>
                                        <div class="form-group mb-5">
                                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                        </div>

                                        <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Login">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>