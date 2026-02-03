<?php
// File: config/database.php

$host = "localhost";
$user = "root";
$pass = ""; 
$db   = "ncc_db";

// Perhatikan nama variabel ini harus $koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek error
if (!$koneksi) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}
?>