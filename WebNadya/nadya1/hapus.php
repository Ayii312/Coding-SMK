<?php
include 'koneksi.php';

// Cek apakah ada parameter id
if (!isset($_GET['kode_barang'])) {
    echo "<p>Kode Barang tidak ditemukan.</p>";
    exit;
}

$kode_barang = $_GET['kode_barang'];

// Ambil nama file gambar dari database
$sql_select = "SELECT gambar FROM barang WHERE kode_barang = '$kode_barang'";
$result = $koneksi->query($sql_select);

if ($result->num_rows == 0) {
    echo "<p>Data tidak ditemukan.</p>";
    exit;
}

$row = $result->fetch_assoc();
$gambar = $row['gambar'];

// Hapus file gambar jika ada
if ($gambar && file_exists("uploads/" . $gambar)) {
    unlink("uploads/" . $gambar);
}

// Hapus data dari database
$sql_delete = "DELETE FROM barang WHERE kode_barang = '$kode_barang'";
if ($koneksi->query($sql_delete) === TRUE) {
    echo "<script>alert('Data berhasil dihapus.'); window.location='index.php';</script>";
} else {
    echo "<p>Gagal menghapus data: " . $koneksi->error . "</p>";
}

$koneksi->close();
?>
