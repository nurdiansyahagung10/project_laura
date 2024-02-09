<?php
include "koneksi.php";
session_start();
if ( isset($_POST["submit"]) ) {
    $tanggal = date('Y-m-d');
    $divisi = $_POST["divisi"];
    $uraian = $_POST["uraian"];
    $waktu = date('H:i:s');
    $keterangan = $_POST["keterangan"];
    $sesinama = $_SESSION['nama'];

    if($divisi == "" || $uraian == ""){
        echo "<script>alert('tidak boleh ada data yang kosong')</script>";
    }
    else{
    $siswaquery = "SELECT * FROM siswapkl where nama = '$sesinama'";
    $data = mysqli_query ($conn, $siswaquery);
    $datasiswa = mysqli_fetch_assoc($data);
    $idsiswa = $datasiswa['id'];
    $query = "INSERT INTO laporanpkl (tanggal, divisi, uraian_pekerjaan, waktu_melapor, keterangan, siswa_pelapor) VALUES ('$tanggal', '$divisi', '$uraian', '$waktu','$keterangan', '$idsiswa')";
    $result = mysqli_query ($conn, $query);
    if($result){
        echo "<script>alert('Data laporan berhasil ditambahkan');window.location='indexadmin.php';</script>";
    } else {
        echo "<script>alert('Data siswa tidak berhasil ditambahkan')</script>";
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

    <title>Data Laporan</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-white">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Data Laporan Siswa Pkl</h1>
                                    </div>
                                    <form class="user" method="post">
                                        
                                        <div class="form-group">
                                            <input type="text" name="divisi" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Divisi">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="uraian" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Uraian Pekerjaan">
                                        </div>
                                      
                                        <div class="form-group">
                                            <select name="keterangan" class="form-control rounded-pill">
                                                <option value="Selesai">Selesai</option>
                                                <option value="Tidak Selesai">Tidak Selesai</option>
                                            </select>
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-primary btn-user btn-block rounded-pill" value="submit">
                                    </form>
                                    <hr>
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