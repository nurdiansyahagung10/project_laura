<?php
$servername = "localhost";
$database = "db_laporan";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);
date_default_timezone_set('Asia/Jakarta');

if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());
}

?>