<?php
session_start();
include 'koneksi.php';
$namasiswa = $_SESSION['hapussiswa'];
mysqli_query($conn, "DELETE FROM siswapkl WHERE nama = '$namasiswa'");

if($result){
    unset($_SESSION['hapussiswa']);
    echo "<script>alert('Data siswa berhasil dihapus.');window.location='indexadmin.php';</script>";
} else {
    echo "<script>alert('Data siswa tidak berhasil dihapus.');window.location='indexadmin.php';</script>";
}
?>