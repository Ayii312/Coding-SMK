<?php
$host = "localhost";
$user = "root"; // Sesuaikan dengan username database kamu
$pass = ""; // Jika ada password, isi di sini
$db = "ayloaff"; // Sesuaikan dengan nama database kamu

$koneksi = new mysqli($host, $user, $pass, $db);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
