<?php
include 'koneksi.php';

// Proses saat form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    // Tangani upload file
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambar = basename($_FILES['gambar']['name']);
        $target_dir = "uploads/";
        $target_file = $target_dir . $gambar;
        
        // Tambahan pengecekan folder
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

        // Pindahkan file ke folder uploads
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            // Simpan data ke database
            $sql = "INSERT INTO barang (gambar, nama, harga, deskripsi)
                    VALUES ('$gambar', '$nama', '$harga', '$deskripsi')";

            if ($koneksi->query($sql) === TRUE) {
                echo "<script>alert('Data berhasil ditambahkan!'); window.location='index.php';</script>";
            } else {
                echo "<p>Gagal menambahkan data: " . $koneksi->error . "</p>";
            }
        } else {
            echo "<p>Upload gambar gagal.</p>";
        }
    } else {
        echo "<p>Gambar tidak dipilih atau terjadi error.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Menu</title>
</head>
<body>
    <h1>Tambah Menu</h1>
    <form method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Gambar:</td>
                <td><input type="file" name="gambar" required></td>
            </tr>
            <tr>
                <td>Nama:</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td>Harga:</td>
                <td><input type="number" name="harga" step="0.01" required></td>
            </tr>
            <tr>
                <td>Deskripsi:</td>
                <td><textarea name="deskripsi" rows="4" required></textarea></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Tambah</button>
                    <a href="index.php"><button type="button">Kembali</button></a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>


<?php $koneksi->close(); ?>
