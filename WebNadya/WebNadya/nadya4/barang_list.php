<?php
// barang_list.php
include 'koneksi.php';

// Fungsi format tanggal ke Bahasa Indonesia
function formatTanggalIndonesia($tanggal) {
    $bulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
        4 => 'April', 5 => 'Mei', 6 => 'Juni',
        7 => 'Juli', 8 => 'Agustus', 9 => 'September',
        10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
    $d = new DateTime($tanggal);
    return $d->format('j') . ' ' . $bulan[(int)$d->format('n')] . ' ' . $d->format('Y');
}

// Pengaturan paginasi
$limit_options = [10, 25, 50, 100];
$limit   = isset($_GET['limit']) ? (int)$_GET['limit'] : 25;
if (!in_array($limit, $limit_options)) $limit = 25;
$page    = isset($_GET['p'])     ? max((int)$_GET['p'], 1) : 1;
$offset  = ($page - 1) * $limit;

// Hitung total data
$resCount    = $koneksi->query("SELECT COUNT(*) AS total FROM barang");
$total_data  = $resCount->fetch_assoc()['total'];
$totalPages  = ceil($total_data / $limit);

// Ambil data barang
$sql = "
    SELECT kode_barang, gambar, nama, harga,
           deskripsi, tanggal, jam, `payment`
    FROM barang
    ORDER BY kode_barang ASC
    LIMIT ? OFFSET ?
";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>

<h1>Daftar Barang</h1>

<p align="center">
  <a href="?page=tambah"><button>Tambah Barang</button></a>
</p>

<p align="center">
  Tampilkan:
  <select onchange="location.href='?page=barang_list&p=1&limit='+this.value;">
    <?php foreach($limit_options as $opt): ?>
      <option value="<?php echo $opt; ?>" <?php if($opt === $limit) echo 'selected'; ?>>
        <?php echo $opt; ?>
      </option>
    <?php endforeach; ?>
  </select> data
</p>

<table border="1" cellpadding="10" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>No.</th>
      <th>ID</th>
      <th>Gambar</th>
      <th>Nama</th>
      <th>Harga</th>
      <th>Deskripsi</th>
      <th>Tanggal Beli</th>
      <th>Jam Beli</th>
      <th>Payment</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($result->num_rows): 
      $no = $offset + 1;
      while($row = $result->fetch_assoc()): ?>
      <tr>
        <td align="center"><?php echo $no++; ?></td>
        <td><?php echo $row['kode_barang']; ?></td>
        <td>
          <img src="uploads/<?php echo htmlspecialchars($row['gambar']); ?>" width="80" alt="">
        </td>
        <td>
          <a href="detail.php?id=<?php echo $row['kode_barang']; ?>">
            <?php echo htmlspecialchars($row['nama']); ?>
          </a>
        </td>
        <td>Rp<?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
        <td><?php echo htmlspecialchars($row['deskripsi']); ?></td>
        <td><?php echo formatTanggalIndonesia($row['tanggal']); ?></td>
        <td><?php echo htmlspecialchars($row['jam']); ?></td>
        <td><?php echo htmlspecialchars($row['payment']); ?></td>
        <td>
          <a href="edit.php?id=<?php echo $row['kode_barang']; ?>">Edit</a> |
          <a href="hapus.php?id=<?php echo $row['kode_barang']; ?>"
             onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
        </td>
      </tr>
    <?php endwhile; else: ?>
      <tr>
        <td colspan="10" align="center">Tidak ada data.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>

<p align="center">
  <?php if ($totalPages > 1): ?>
    <?php if ($page > 1): ?>
      <a href="?page=barang_list&p=<?php echo $page-1; ?>&limit=<?php echo $limit; ?>">&laquo; Sebelumnya</a>
    <?php endif; ?>

    <?php for($i = 1; $i <= $totalPages; $i++): ?>
      <?php if ($i === $page): ?>
        <strong><?php echo $i; ?></strong>
      <?php else: ?>
        <a href="?page=barang_list&p=<?php echo $i; ?>&limit=<?php echo $limit; ?>">
          <?php echo $i; ?>
        </a>
      <?php endif; ?>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
      <a href="?page=barang_list&p=<?php echo $page+1; ?>&limit=<?php echo $limit; ?>">
        Selanjutnya &raquo;
      </a>
    <?php endif; ?>
  <?php endif; ?>
</p>

<?php
$koneksi->close();
?>
