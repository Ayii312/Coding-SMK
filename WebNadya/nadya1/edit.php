<?php
include 'koneksi.php';

if (!isset($_GET['kode_barang'])) {
    echo "<p>Data tidak ditemukan. Kode Barang tidak ada dalam URL.</p>";
    exit;
}

$kode_barang = $_GET['kode_barang'];

// Ambil data barang
$sql = "SELECT * FROM barang WHERE kode_barang = '$kode_barang'";
$result = $koneksi->query($sql);

if ($result->num_rows == 0) {
    echo "<p>Data tidak ditemukan di database.</p>";
    exit;
}

$row = $result->fetch_assoc();
$gambar_lama = $row['gambar'];

// Proses saat form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    // Cek apakah ada file gambar baru yang di-upload
    if ($_FILES['gambar']['name'] != '') {
        $gambar_baru = basename($_FILES['gambar']['name']);
        $target_dir = "uploads/";
        $target_file = $target_dir . $gambar_baru;

        // Pindahkan file ke folder uploads/
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            $gambar = $gambar_baru;

            // Hapus gambar lama jika berbeda dan ada
            if ($gambar_lama && file_exists("uploads/" . $gambar_lama)) {
                unlink("uploads/" . $gambar_lama);
            }
        } else {
            echo "<p>Upload gambar gagal.</p>";
            exit;
        }
    } else {
        // Tidak ada gambar baru, pakai gambar lama
        $gambar = $gambar_lama;
    }

    $update = "UPDATE barang SET 
        gambar = '$gambar',
        nama = '$nama',
        harga = '$harga',
        deskripsi = '$deskripsi'
        WHERE kode_barang = '$kode_barang'";

    if ($koneksi->query($update) === TRUE) {
        echo "<script>alert('Data berhasil diupdate!'); window.location='index.php';</script>";
    } else {
        echo "<p>Error saat mengupdate: " . $koneksi->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu</title>
</head>
<body>
    <h1>Edit Menu</h1>
    <form method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Gambar Lama:</td>
                <td>
                    <img src="uploads/<?php echo $gambar_lama; ?>" width="120" alt="Gambar"><br>
                    <small>Biarkan kosong jika tidak ingin mengubah gambar</small>
                </td>
            </tr>
            <tr>
                <td>Gambar Baru:</td>
                <td><input type="file" name="gambar"></td>
            </tr>
            <tr>
                <td>Nama:</td>
                <td><input type="text" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" required></td>
            </tr>
            <tr>
                <td>Harga:</td>
                <td><input type="number" name="harga" step="0.01" value="<?php echo $row['harga']; ?>" required></td>
            </tr>
            <tr>
                <td>Deskripsi:</td>
                <td><textarea name="deskripsi" rows="4" required><?php echo htmlspecialchars($row['deskripsi']); ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Simpan Perubahan</button>
                    <a href="index.php"><button type="button">Kembali</button></a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php $koneksi->close(); ?>
