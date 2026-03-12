<?php
// Memasukkan file koneksi.php
include 'koneksi.php';

// Fungsi untuk format tanggal ke Bahasa Indonesia
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

// **Pengaturan paginasi**
$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 25;     // Default 25 data per halaman
$limit_options = [10, 25, 50, 100, 250];                         // Opsi jumlah data

$page   = isset($_GET['page'])  ? (int) $_GET['page']  : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// **Hitung total data untuk paginasi**
$sql_count     = "SELECT COUNT(*) AS total FROM dish";
$result_count  = $koneksi->query($sql_count);
$total_data    = $result_count->fetch_assoc()['total'];
$total_pages   = ceil($total_data / $limit);

// **Query untuk mengambil data dish dengan limit dan offset**
$sql  = "
    SELECT
        id_dish,
        gambar_dish,
        nama_dish,
        harga_dish,
        deskripsi_dish,
        tanggal_beli,
        jam,
        `order` AS order_count
    FROM dish
    ORDER BY id_dish ASC
    LIMIT ? OFFSET ?
";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Dish</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>Daftar Menu Dish</h1>
    <!-- Tombol Tambah Barang -->
    <p align="center">
    <a href="tambah.php"><button>Tambah Dish</button></a>
    </p>

    <!-- Dropdown paginasi di atas tabel -->
    <p align="center">
      Tampilkan:
      <select onchange="window.location.href='tampil.php?page=1&limit=' + this.value;">
        <?php foreach ($limit_options as $option): ?>
          <option value="<?php echo $option; ?>" <?php if ($option == $limit) echo 'selected'; ?>>
            <?php echo $option; ?>
          </option>
        <?php endforeach; ?>
      </select> data
    </p>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Tanggal Beli</th>
            <th>Jam</th>
            <th>Order</th>
            <th>Aksi</th>
        </tr>

        <?php if ($result->num_rows > 0): ?>
            <?php $no = $offset + 1; ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td align="center"><?php echo $no; ?></td>
                    <td><img src="uploads/<?php echo htmlspecialchars($row['gambar_dish']); ?>" width="100" alt="Gambar Dish"></td>
                    <td><?php echo htmlspecialchars($row['nama_dish']); ?></td>
                    <td>Rp <?php echo number_format($row['harga_dish'], 0, ',', '.'); ?></td>
                    <td><?php echo htmlspecialchars($row['deskripsi_dish']); ?></td>
                    <td><?php echo formatTanggalIndonesia($row['tanggal_beli']); ?></td>
                    <td><?= htmlspecialchars($row['jam'])?></td>
                    <td><?= htmlspecialchars($row['order_count']) ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id_dish']; ?>"><button>Edit</button></a>
                        <a href="hapus.php?id=<?php echo $row['id_dish']; ?>"
                           onclick="return confirm('Yakin ingin menghapus?')"><button>Hapus</button></a>
                    </td>
                </tr>
                <?php $no++; ?>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
              <td colspan="7" align="center">Tidak ada data dish.</td>
            </tr>
        <?php endif; ?>
    </table>

    <!-- Navigasi paginasi di bawah tabel -->
    <p align="center">
      <?php if ($total_pages > 1): ?>
        Halaman
        <?php if ($page > 1): ?>
          <a href="tampil.php?page=<?php echo $page - 1; ?>&limit=<?php echo $limit; ?>">Sebelumnya</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
          <?php if ($i == $page): ?>
            <strong><?php echo $i; ?></strong>
          <?php else: ?>
            <a href="tampil.php?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>"><?php echo $i; ?></a>
          <?php endif; ?>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
          <a href="tampil.php?page=<?php echo $page + 1; ?>&limit=<?php echo $limit; ?>">Selanjutnya</a>
        <?php endif; ?>
      <?php endif; ?>
    </p>

</body>
</html>

<?php
// Menutup koneksi database
$koneksi->close();
?>
