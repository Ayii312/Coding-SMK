<?php
include 'koneksi.php';

// Query untuk mengambil semua data dari tabel barang
$sql = "SELECT * FROM barang";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen barang</title>
</head>
<body>
    <h1>Daftar barang</h1>
    <a href="tambah.php">+ Tambah barang</a>
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

        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['kode_barang']; ?></td>
            <td>
                <img src="uploads/<?php echo $row['gambar']; ?>" width="100" alt="Gambar barang">
            </td>
            <td><?php echo $row['nama']; ?></td>
            <td>Rp<?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
            <td><?php echo $row['deskripsi']; ?></td>
            <td>
                <a href="edit.php?kode_barang=<?php echo $row['kode_barang']; ?>">Edit</a> |
                <a href="hapus.php?id=<?php echo $row['kode_barang']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
