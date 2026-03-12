<?php
// Konfig Database
$host = "localhost";    
$user = "root";         
$pass = "";             
$db   = "db_sekolah";   

// Hubungkan ke MySQL
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek Koneksi (Opsional)
if (!$conn) {
    die("Wah, koneksi ke database gagal nih: " . mysqli_connect_error());
}

?>