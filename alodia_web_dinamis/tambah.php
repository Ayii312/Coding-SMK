<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_dish = $_POST['nama_dish'];
    $harga_dish = $_POST['harga_dish'];
    $deskripsi_dish = mysqli_real_escape_string($koneksi, $_POST['deskripsi_dish']);
    $tanggal_beli = $_POST['tanggal_beli'];
    $jam = $_POST['jam'];
    $order = $_POST['order'];

    if (isset($_FILES['gambar_dish']) && $_FILES['gambar_dish']['error'] == 0) {
        $gambar_dish = basename($_FILES['gambar_dish']['name']);
        $target_dir = "uploads/";
        $target_file = $target_dir . $gambar_dish;

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        if (move_uploaded_file($_FILES['gambar_dish']['tmp_name'], $target_file)) {
            $sql = "INSERT INTO dish (gambar_dish, nama_dish, harga_dish, deskripsi_dish, tanggal_beli, jam, `order`)
                    VALUES ('$gambar_dish', '$nama_dish', '$harga_dish', '$deskripsi_dish', '$tanggal_beli', '$jam', '$order')";

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu Dish</title>
    <link rel="stylesheet" href="index.css">

    <!-- Text  -->
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
</head>
<body>
    <h1>Tambah Menu Dish</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <td align="right">Gambar:</td>
                <td><input type="file" name="gambar_dish" required></td>
            </tr>
            <tr>
                <td align="right">Nama:</td>
                <td><input type="text" name="nama_dish" required></td>
            </tr>
            <tr>
                <td align="right">Harga:</td>
                <td><input type="number" name="harga_dish" step="0.01" required></td>
            </tr>
            <tr>
                <td align="right">Deskripsi:</td>
                <td><textarea name="deskripsi_dish" id="editor" rows="10" cols="80"></textarea></td>
                <script>
                CKEDITOR.replace('deskripsi_dish');
                </script>
            </tr>
            <tr>
                <td align="right">Tanggal Beli:</td>
                <td><input type="date" name="tanggal_beli" required></td>
            </tr>
            <tr>
                <td align="right">Jam Beli:</td>
                <td><input type="time" name="jam" required></td>
            </tr>
            <tr>
                <td align="right">Order:</td>
                <td>
                    <select name="order" required>
                        <option value="">Pilih Cara Order</option>
                        <option value="Dine in">Dine in</option>
                        <option value="Take Away">Take Away</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <button type="submit">Simpan</button>
                    <a href="index.php"><button type="button">Kembali</button></a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php $koneksi->close(); ?>
