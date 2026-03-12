<?php
// Memasukkan file koneksi.php
include 'koneksi.php';

// Query untuk mengambil semua data dari tabel barang
$sql = "SELECT * FROM barang";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar barang</title>
</head>
<body>
    <h1>Daftar Menu barang</h1>
    <a href="tambah.php"><button>Tambah barang Baru</button></a>
    <br><br>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>

        <?php
        // Menampilkan data barang
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['kode_barang'] . "</td>";
                echo "<td><img src='uploads/" . $row['gambar'] . "' width='100' alt='Gambar barang'></td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>Rp" . number_format($row['harga'], 0, ',', '.') . "</td>";
                echo "<td>" . $row['deskripsi'] . "</td>";
                echo "<td>
                        <a href='edit.php?id=" . $row['kode_barang'] . "'><button>Edit</button></a>
                        <a href='hapus.php?id=" . $row['kode_barang'] . "' onclick=\"return confirm('Yakin ingin menghapus?')\"><button>Hapus</button></a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data barang.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Menutup koneksi database
$koneksi->close();
?>
