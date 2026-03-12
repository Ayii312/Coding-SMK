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
    <title>Edit Barang</title>
    <form method="POST" enctype="multipart/form-data">
    <style>
        table {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }
        td {
            padding: 8px;
            vertical-align: top;
        }
        input[type="text"], input[type="file"], textarea {
            width: 100%;
            box-sizing: border-box;
        }
        button {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Edit Barang</h1>
    <form method="POST" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td align="right">Gambar Lama:</td>
                <td>
                    <img src="uploads/<?php echo $gambar_lama; ?>" width="120" alt="Gambar Barang"><br>
                    <small>Biarkan kosong jika tidak ingin mengubah gambar</small>
                </td>
            </tr>
            <tr>
                <td align="right">Gambar Baru:</td>
                <td><input type="file" name="gambar"></td>
            </tr>
            <tr>
               <td align="right">Nama:</td>
                <td><input type="text" name="nama" size="30" value="<?php echo htmlspecialchars($row['nama']); ?>" required></td>
            </tr>
            <tr>
                <td align="right">Harga:</td>
                <td><input type="text" name="harga" size="30" value="<?php echo number_format($row['harga'], 0, ',', '.'); ?>" required></td>
            </tr>
            <tr>
                <td align="right">Deskripsi:</td>
                <td><textarea name="deskripsi" rows="4" cols="30" size="30" required><?php echo htmlspecialchars($row['deskripsi']); ?></textarea></td>
            </tr>
            <tr>
                <td align="right" colspan="2" style="text-align:center;">
                    <button type="submit">Simpan Perubahan</button>
                    <a href="index.php"><button type="button">Kembali</button></a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>


<?php $koneksi->close(); ?>
