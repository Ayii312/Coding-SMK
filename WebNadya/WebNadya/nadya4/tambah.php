<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $payment = $_POST['payment'];

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambar = basename($_FILES['gambar']['name']);
        $target_dir = "uploads/";
        $target_file = $target_dir . $gambar;

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            $sql = "INSERT INTO barang (gambar, nama, harga, deskripsi, tanggal, jam, `payment`)
                    VALUES ('$gambar', '$nama', '$harga', '$deskripsi', '$tanggal', '$jam', '$payment')";

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
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="index.css">

    <!-- Text  -->
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
</head>
<body>
    <h1>Tambah Barang</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <td align="right">Gambar:</td>
                <td><input type="file" name="gambar" required></td>
            </tr>
            <tr>
                <td align="right">Nama:</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td align="right">Harga:</td>
                <td><input type="number" name="harga" step="0.01" required></td>
            </tr>
            <tr>
                <td align="right">Deskripsi:</td>
                <td><textarea name="deskripsi" id="editor" rows="10" cols="80"></textarea></td>
                <script>
                CKEDITOR.replace('deskripsi');
                </script>
            </tr>
            <tr>
                <td align="right">Tanggal Beli:</td>
                <td><input type="date" name="tanggal" required></td>
            </tr>
            <tr>
                <td align="right">Jam Beli:</td>
                <td><input type="time" name="jam" required></td>
            </tr>
            <tr>
                <td align="right">Payment:</td>
                <td>
                    <select name="payment" required>
                        <option value="">Pilih Cara Payment</option>
                        <option value="Cash">Cash</option>
                        <option value="Transfer">Transfer</option>
                        <option value="Gopay">Gopay</option>
                        <option value="Shopeepay">Shopeepay</option>
                        <option value="Jago">Jago</option>
                        <option value="Qris">Qris</option>
                        <option value="OVO">OVO</option>
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
