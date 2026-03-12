<?php
include 'koneksi.php';

function formatTanggalIndonesia($tanggal) {
    $bulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
        4 => 'April', 5 => 'Mei', 6 => 'Juni',
        7 => 'Juli', 8 => 'Agustus', 9 => 'September',
        10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    $date = new DateTime($tanggal);
    $hari = $date->format('j');
    $bulan_index = (int)$date->format('n');
    $tahun = $date->format('Y');

    return "$hari {$bulan[$bulan_index]} $tahun";
}

if (!isset($_GET['id'])) {
    echo "<p>Data tidak ditemukan. Kode Barang tidak ada dalam URL.</p>";
    exit;
}

$kode_barang = intval($_GET['id']);


// Ambil data barang
$sql = "SELECT * FROM barang WHERE kode_barang = $kode_barang";
$result = $koneksi->query($sql);

if ($result->num_rows == 0) {
    echo "<p>Data tidak ditemukan di database.</p>";
    exit;
}

$row = $result->fetch_assoc();
$gambar_lama = $row['gambar'];

// Proses saat form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama      = $_POST['nama'];
    $harga     = str_replace('.', '', $_POST['harga']);
    $deskripsi = $_POST['deskripsi'];
    $tanggal   = $_POST['tanggal'];
    $jam            = $_POST['jam'];      
    $payment_mode     = $_POST['payment'];   

    // Cek apakah ada file gambar baru yang di-upload
    if ($_FILES['gambar']['name'] != '') {
        $gambar_baru = basename($_FILES['gambar']['name']);
        $target_dir = "uploads/";
        $target_file = $target_dir . $gambar_baru;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            $gambar = $gambar_baru;

            // Hapus gambar lama jika ada
            if ($gambar_lama && file_exists("uploads/" . $gambar_lama)) {
                unlink("uploads/" . $gambar_lama);
            }
        } else {
            echo "<p>Upload gambar gagal.</p>";
            exit;
        }
    } else {
        $gambar = $gambar_lama;
    }

    // Update data
    $update = "
      UPDATE barang SET
        gambar   = '{$gambar}',
        nama     = '{$nama}',
        harga    = '{$harga}',
        deskripsi = '{$deskripsi}',
        tanggal  = '{$tanggal}',
        jam           = '{$jam}',
        `payment`       = '{$payment_mode}'
      WHERE kode_barang = {$kode_barang}
    ";

    if ($koneksi->query($update) === TRUE) {
        echo "<script>
                alert('Data berhasil diupdate!');
                window.location='index.php';
              </script>";
    } else {
        echo "<p>Error saat mengupdate: " . $koneksi->error . "</p>";
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
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
</head>
<body>
    <h1>Tambah Barang</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td align="right">Gambar Lama:</td>
                <td>
                    <img src="uploads/<?php echo $gambar_lama; ?>" width="120" alt="Gambar Barang" size="30" required><br>
                    <small>Biarkan kosong jika tidak ingin mengubah gambar</small>
                </td>
            </tr>
            <tr>
                <td align="right">Gambar:</td>
                <td><input type="file" name="gambar" size="30" required></td>
            </tr>
            <tr>
                <td align="right">Nama:</td>
                <td><input type="text" name="nama" size="30" required></td>
            </tr>
            <tr>
                <td align="right">Harga:</td>
                <td><input type="number" name="harga" size="30" step="0.01" required></td>
            </tr>
            <tr>
                <td align="right">Deskripsi:</td>
                <td><textarea name="deskripsi" id="editor" rows="10" cols="80"></textarea></td>
                <script>
                CKEDITOR.replace('deskripsi');
                </script>
            </tr>
            <tr>
                <td align="right" width="30%">Tanggal Beli:</td>
                <td><input type="date" name="tanggal" size="30" required></td>
            </tr>
            <tr>
                <td align="right">Jam Beli:</td>
                <td><input type="time" name="jam" size="30" required></td>
            </tr>
            <tr>
                <td align="right">Payment:</td>
                <td>
                    <select name="payment" style="width: 170px;" required>
                        <option value="">Pilih Cara payment</option>
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
                <td colspan="2" style="text-align:center;">
                    <button type="submit">Simpan</button>
                    <a href="index.php"><button type="button">Kembali</button></a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php $koneksi->close(); ?>