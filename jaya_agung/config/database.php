<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "cv_jaya_agung_motor";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}