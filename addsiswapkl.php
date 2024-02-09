<?php
include "koneksi.php";
if (isset($_POST["submit"])) {
    $nama = $_POST["nama"];
    $password = md5($_POST["password"]);
    $asal_sekolah = $_POST["asal_sekolah"];
    $awal_pkl = $_POST["awal_pkl"];
    $akhir_pkl = $_POST["akhir_pkl"];
    $created_at = date('Y-m-d H:i:s');

    if ($nama  == "" || $password == "" || $asal_sekolah == "" || $awal_pkl == "" || $akhir_pkl == "") {
        echo "<script>alert('tidak boleh ada field yang kosong')</script>";
    } else {
        $query = "INSERT INTO siswapkl (nama, password, asal_sekolah, awal_pkl, akhir_pkl,created_at) VALUES ('$nama', '$password', '$asal_sekolah', '$awal_pkl', '$akhir_pkl', '$created_at')";
        try {
            $result = mysqli_query($conn, $query);
            if ($result) {
                echo "<script>alert('Data siswa berhasil ditambahkan.');window.location='indexadmin.php';</script>";
            } else {
                echo "<script>alert('Data siswa tidak berhasil ditambahkan.')</script>";
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                echo "<script>alert('nama yang anda masukan sudah terdaftar!')</script>";
            }
        }

       
    }
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

    <title>Tambah Data Siswa Pkl</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-white">

    <div class="container">

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
                                        <h1 class="h4 text-gray-900 mb-4">Tambah Data Siswa Pkl</h1>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" name="nama" class="form-control form-control-user" id="exampleFirstName" placeholder="Username">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="password" class="form-control form-control-user" id="exampleLastName" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="asal_sekolah" class="form-control form-control-user" id="exampleInputEmail" placeholder="Asal Sekolah">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="date" name="awal_pkl" class="form-control form-control-user" id="exampleInputPassword" placeholder="Awal Pkl">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="date" name="akhir_pkl" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Akhir Pkl">
                                            </div>

                                            <input type="submit" name="submit" class="btn btn-primary btn-user btn-block rounded-pill mt-3" value="submit">

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