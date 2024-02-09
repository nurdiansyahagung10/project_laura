<?php
include 'koneksi.php';
session_start();
if ($_SESSION["nama"] == 'adminlaura') {
    $tanggal_sekarang = date('Y-m-d');
    $siswapkl = mysqli_query($conn, "SELECT * FROM siswapkl where not nama = 'adminlaura'");
    $laporanpklterbaru = mysqli_query($conn, "SELECT laporanpkl.* ,siswapkl.nama FROM laporanpkl left join siswapkl  on siswapkl.id = laporanpkl.siswa_pelapor limit 3");
    $laporanpkl = mysqli_query($conn, "SELECT laporanpkl.* ,siswapkl.nama FROM laporanpkl left join siswapkl  on siswapkl.id = laporanpkl.siswa_pelapor where laporanpkl.tanggal = '$tanggal_sekarang'");
    if (isset($_POST['edit'])) {
        $_SESSION['editnama'] = $_POST['editname'];
        header("Location: editsiswapkl.php");
    } else if (isset($_POST['inspect'])) {
        $_SESSION['inspectnama'] = $_POST['inspectnama'];
        header("Location: inspectdata.php");
    } else if (isset($_POST['hapus'])) {
        $_SESSION['hapussiswa'] = $_POST['hapussiswa'];
        header("Location: hapus.php");
    }
} else {
    header("Location: login.php");
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

    <title>Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Laporan Pkl</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="indexadmin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="addsiswapkl.php">Tambah Data Siswa</a>
                        <div class="collapse-divider"></div>
                        <a class="collapse-item" href="logout.php">Logout</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top ">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <span class="fw-bold">dashboard admin</span>
                    <!-- Topbar Search -->
                    <form class="d-none ml-auto d-sm-inline-block form-inline  my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-sm-0 ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Data laporan terbaru</h1>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card bg-light border-0  mb-4">
                        <div class="row">
                            <?php foreach ($laporanpklterbaru as $row) { ?>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">                                            
                                            <h5 class="card-title"><?= $row['nama']; ?></h5>
                                            <h6 class="card-title"><?= $row['waktu_melapor']; ?></h6>
                                            </div>
                                            <p class="card-text">Divisi: <?= $row['divisi']; ?> | <?= $row['uraian_pekerjaan']; ?></p>
                                            <div class="btn btn-primary"><?= $row['keterangan']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Semua laporan di hari ini </h1>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card  mb-4">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>siswa</th>
                                            <th>Tanggal</th>
                                            <th>Divisi</th>
                                            <th>Uraian Pekerjaan</th>
                                            <th>Waktu</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($laporanpkl as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row["nama"]; ?></td>
                                                <td><?= $row["tanggal"]; ?></td>
                                                <td><?= $row["divisi"]; ?></td>
                                                <td><?= $row["uraian_pekerjaan"]; ?></td>
                                                <td><?= $row["waktu_melapor"]; ?></td>
                                                <td><?= $row["keterangan"]; ?></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Data semua siswa pkl</h1>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card  mb-4">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Asal Sekolah</th>
                                            <th>Awal Pkl</th>
                                            <th>Akhir Pkl</th>
                                            <th>dibuat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($siswapkl as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row["nama"]; ?></td>
                                                <td><?= $row["asal_sekolah"]; ?></td>
                                                <td><?= $row["awal_pkl"]; ?></td>
                                                <td><?= $row["akhir_pkl"]; ?></td>
                                                <td><?= $row["created_at"]; ?></td>
                                                <td class="d-flex">
                                                    <form method="post" class="px-2">
                                                        <input type="hidden" value="<?= $row["nama"]; ?>" name="editname">
                                                        <input type="submit" value="edit" class="btn btn-primary" name="edit">
                                                    </form>
                                                    <form method="post" class="px-2">
                                                    <input type="hidden" value="<?= $row["nama"]; ?>" name="hapussiswa">

                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                                            Hapus
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Peringatan</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        apakah anda yakin ingin tetap menghapus akun ?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                        <input type="submit" value="hapus" class="btn btn-primary" name="hapus">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex alig-items-center">
                        <div class="flex-fill pr-1">


                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">siswa lulus pkl </h1>
                            </div>
                            <!-- DataTales Example -->
                            <div class="card  mb-4">

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Awal Pkl</th>
                                                    <th>Akhir Pkl</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach ($siswapkl as $row) : ?>
                                                    <?php if ($row["akhir_pkl"] < date('Y-m-d')) { ?>
                                                        <tr>
                                                            <td><?= $i; ?></td>
                                                            <td><?= $row["nama"]; ?></td>
                                                            <td><?= $row["awal_pkl"]; ?></td>
                                                            <td><?= $row["akhir_pkl"]; ?></td>
                                                            <td>
                                                                <form method="post">
                                                                    <input type="hidden" value="<?= $row["nama"]; ?>" name="inspectnama">
                                                                    <input type="submit" value="Inspect" class="btn btn-primary" name="inspect">
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php }; ?>
                                                    <?php $i++; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-fill pl-1">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">siswa masih pkl </h1>
                            </div>
                            <!-- DataTales Example -->
                            <div class="card  mb-4">

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Awal Pkl</th>
                                                    <th>Akhir Pkl</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach ($siswapkl as $row) : ?>
                                                    <?php if ($row["akhir_pkl"] > date('Y-m-d')) { ?>
                                                        <tr>
                                                            <td><?= $i; ?></td>
                                                            <td><?= $row["nama"]; ?></td>
                                                            <td><?= $row["awal_pkl"]; ?></td>
                                                            <td><?= $row["akhir_pkl"]; ?></td>
                                                            <td>
                                                                <form method="post">
                                                                    <input type="hidden" value="<?= $row["nama"]; ?>" name="inspectnama">
                                                                    <input type="submit" value="Inspect" class="btn btn-primary" name="inspect">
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php }; ?>
                                                    <?php $i++; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
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

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>