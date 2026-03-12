<?php
include 'koneksi.php';

// Fungsi format tanggal ke Bahasa Indonesia
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

// Validasi & ambil data berdasarkan Kode Barang
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    die('kode barang tidak valid.');
}
$kode_barang = (int) $_GET['id'];

$sql  = "SELECT * FROM barang WHERE kode_barang = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $kode_barang);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Data tidak ditemukan.');
}
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Barang: <?php echo htmlspecialchars($row['nama']); ?></title>
  <link rel="stylesheet" href="index.css">
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    .container { max-width: 600px; margin: auto; }
    .center { text-align: center; }
    .field { margin: 8px 0; }
    .field-label { display: inline-block; width: 120px; font-weight: bold; vertical-align: top; }
    .field-value { display: inline-block; }
    .back-btn { margin-top: 20px; }
  </style>
</head>
<body>
  <div class="container">
    <div class="center">
      <img src="uploads/<?php echo htmlspecialchars($row['gambar']); ?>"
           alt="Gambar <?php echo htmlspecialchars($row['nama']); ?>"
           width="200">
    </div>

    <div class="field">
      <span class="field-label">Nama Barang</span>
      <span class="field-value"><?php echo htmlspecialchars($row['nama']); ?></span>
    </div>

    <div class="field">
      <span class="field-label">Deskripsi</span>
      <div class="field-value">
        <p><?php echo nl2br(htmlspecialchars($row['deskripsi'])); ?></p>
      </div>
    </div>

    <div class="field">
      <span class="field-label">Tanggal</span>
      <span class="field-value"><?php echo formatTanggalIndonesia($row['tanggal']); ?></span>
    </div>

    <div class="field">
      <span class="field-label">Jam</span>
      <span class="field-value"><?php echo htmlspecialchars($row['jam']); ?></span>
    </div>

    <div class="field">
      <span class="field-label">Harga</span>
      <span class="field-value">Rp <?php echo number_format($row['harga'],0,',','.'); ?></span>
    </div>

    <div class="field">
      <span class="field-label">Payment</span>
      <span class="field-value"><?php echo htmlspecialchars($row['payment']); ?></span>
    </div>

    <div class="back-btn center">
      <a href="index.php"><button>Kembali</button></a>
    </div>
  </div>
</body>
</html>

<?php
$stmt->close();
$koneksi->close();
?>
