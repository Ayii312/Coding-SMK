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
    echo "<p>Data tidak ditemukan. ID Dish tidak ada dalam URL.</p>";
    exit;
}

$id_dish = intval($_GET['id']);


// Ambil data dish
$sql = "SELECT * FROM dish WHERE id_dish = $id_dish";
$result = $koneksi->query($sql);

if ($result->num_rows == 0) {
    echo "<p>Data tidak ditemukan di database.</p>";
    exit;
}

$row = $result->fetch_assoc();
$gambar_lama = $row['gambar_dish'];

// Proses saat form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_dish      = $_POST['nama_dish'];
    $harga_dish     = str_replace('.', '', $_POST['harga_dish']);
    $deskripsi_dish = $_POST['deskripsi_dish'];
    $tanggal_beli   = $_POST['tanggal_beli'];
    $jam            = $_POST['jam'];      
    $order_mode     = $_POST['order'];   

    // Cek apakah ada file gambar baru yang di-upload
    if ($_FILES['gambar_dish']['name'] != '') {
        $gambar_baru = basename($_FILES['gambar_dish']['name']);
        $target_dir = "uploads/";
        $target_file = $target_dir . $gambar_baru;

        if (move_uploaded_file($_FILES['gambar_dish']['tmp_name'], $target_file)) {
            $gambar_dish = $gambar_baru;

            // Hapus gambar lama jika ada
            if ($gambar_lama && file_exists("uploads/" . $gambar_lama)) {
                unlink("uploads/" . $gambar_lama);
            }
        } else {
            echo "<p>Upload gambar gagal.</p>";
            exit;
        }
    } else {
        $gambar_dish = $gambar_lama;
    }

    // Update data
    $update = "
      UPDATE dish SET
        gambar_dish   = '{$gambar_dish}',
        nama_dish     = '{$nama_dish}',
        harga_dish    = '{$harga_dish}',
        deskripsi_dish= '{$deskripsi_dish}',
        tanggal_beli  = '{$tanggal_beli}',
        jam           = '{$jam}',
        `order`       = '{$order_mode}'
      WHERE id_dish = {$id_dish}
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
    <title>Tambah Menu Dish</title>
    <link rel="stylesheet" href="index.css">
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
</head>
<body>
    <h1>Tambah Menu Dish</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td align="right">Gambar Lama:</td>
                <td>
                    <img src="uploads/<?php echo $gambar_lama; ?>" width="120" alt="Gambar Dish" size="30" required><br>
                    <small>Biarkan kosong jika tidak ingin mengubah gambar</small>
                </td>
            </tr>
            <tr>
                <td align="right">Gambar:</td>
                <td><input type="file" name="gambar_dish" size="30" required></td>
            </tr>
            <tr>
                <td align="right">Nama:</td>
                <td><input type="text" name="nama_dish" size="30" required></td>
            </tr>
            <tr>
                <td align="right">Harga:</td>
                <td><input type="number" name="harga_dish" size="30" step="0.01" required></td>
            </tr>
            <tr>
                <td align="right">Deskripsi:</td>
                <td><textarea name="deskripsi_dish" id="editor" rows="10" cols="80"></textarea></td>
                <script>
                CKEDITOR.replace('deskripsi_dish');
                </script>
            </tr>
            <tr>
                <td align="right" width="30%">Tanggal Beli:</td>
                <td><input type="date" name="tanggal_beli" size="30" required></td>
            </tr>
            <tr>
                <td align="right">Jam Beli:</td>
                <td><input type="time" name="jam" size="30" required></td>
            </tr>
            <tr>
                <td align="right">Order:</td>
                <td>
                    <select name="order" style="width: 170px;" required>
                        <option value="">Pilih Cara Order</option>
                        <option value="Dine in">Dine in</option>
                        <option value="Take Away">Take Away</option>
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
