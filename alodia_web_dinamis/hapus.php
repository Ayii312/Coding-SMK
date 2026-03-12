<?php
include 'koneksi.php';

// Cek apakah ada parameter id
if (!isset($_GET['id'])) {
    echo "<p>ID tidak ditemukan.</p>";
    exit;
}

$id_dish = $_GET['id'];

// Ambil nama file gambar dari database
$sql_select = "SELECT gambar_dish FROM dish WHERE id_dish = '$id_dish'";
$result = $koneksi->query($sql_select);

if ($result->num_rows == 0) {
    echo "<p>Data tidak ditemukan.</p>";
    exit;
}

$row = $result->fetch_assoc();
$gambar = $row['gambar_dish'];

// Hapus file gambar jika ada
if ($gambar && file_exists("uploads/" . $gambar)) {
    unlink("uploads/" . $gambar);
}

// Hapus data dari database
$sql_delete = "DELETE FROM dish WHERE id_dish = '$id_dish'";
if ($koneksi->query($sql_delete) === TRUE) {
    echo "<script>alert('Data berhasil dihapus.'); window.location='index.php';</script>";
} else {
    echo "<p>Gagal menghapus data: " . $koneksi->error . "</p>";
}

$koneksi->close();
?>
