<?php
// index.php
include 'koneksi.php';

// ————————————————
// Fungsi format tanggal ke Bahasa Indonesia
// ————————————————
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

// ————————————————
// Jika halaman barang_list ditampilkan (melalui GET page=barang_list)
// maka jalankan query paginasi; otherwise load toko
// ————————————————
$pageParam = isset($_GET['page']) ? $_GET['page'] : 'toko';

if ($pageParam === 'barang_list') {
    // setup paginasi
    $limit_options = [10,25,50,100];
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 25;
    if (!in_array($limit, $limit_options)) $limit = 25;
    $currPage = isset($_GET['p']) ? max((int)$_GET['p'],1) : 1;
    $offset = ($currPage - 1) * $limit;

    // hitung total
    $resC = $koneksi->query("SELECT COUNT(*) AS total FROM barang");
    $total = $resC->fetch_assoc()['total'];
    $totalPages = ceil($total / $limit);

    // ambil data
    $sql = "
      SELECT kode_barang,gambar,nama,harga,
             deskripsi,tanggal,jam,`payment`
      FROM barang
      ORDER BY kode_barang
      LIMIT ? OFFSET ?
    ";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ii",$limit,$offset);
    $stmt->execute();
    $data = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html lang="id">
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  integrity="sha512-pO1XKqv3Yl4qY4d+zR5fzs9Xwqe7F9cNH1h08O6DqBswDPc5rUBhVvZHCPNzQWjt5oj3jIZYjvQbIY3zaM+7XQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"/>
<head>
  <meta charset="UTF-8">
  <title>NadyaMart • Dashboard</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar-container">
    <div class="sidebar-main">
      <h3>NadyaMart</h3>
      <img src="mart.png" alt="NadyaMart" class="sidebar-logo">
      <a href="?page=home"><span class="icon icon-home"></span> Home</a>
      <a href="?page=tambah"><span class="icon icon-plus"></span> Tambah Barang</a>
      <a href="?page=barang_list"><span class="icon icon-list"></span> Daftar Barang</a>
    </div>
    <div class="sidebar-secondary">
      <h3>Informasi</h3>
      <a href="?page=toko"><span class="icon icon-company"></span> Profil Kedai</a>
      <a href="?page=visimisi"><span class="icon icon-vision"></span> Visi Misi</a>
      <a href="?page=hubungi"><span class="icon icon-contact"></span> Hubungi Kami</a>
    </div>
  </div>

  <!-- Konten Utama -->
  <div class="content">
    <?php if ($pageParam === 'barang_list'): ?>
      <h1>Daftar Barang</h1>
      <p align="center">
        <a href="?page=tambah"><button>Tambah Barang</button></a>
      </p>
      <p align="center">
        Tampilkan:
        <select onchange="location.href='?page=barang_list&p=1&limit='+this.value">
          <?php foreach($limit_options as $opt): ?>
            <option value="<?= $opt ?>"
              <?= $opt === $limit ? 'selected' : '' ?>>
              <?= $opt ?>
            </option>
          <?php endforeach ?>
        </select> data
      </p>

      <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>No.</th><th>ID</th><th>Gambar</th><th>Nama</th>
            <th>Harga</th><th>Deskripsi</th><th>Tanggal Beli</th>
            <th>Jam Beli</th><th>payment</th><th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php if($data->num_rows): 
          $no = $offset + 1;
          while($r = $data->fetch_assoc()): ?>
          <tr>
            <td align="center"><?= $no ?></td>
            <td><?= $r['kode_barang'] ?></td>
            <td><img src="uploads/<?= htmlspecialchars($r['gambar'])?>" width="80"></td>
            <td><a href="detail.php?id=<?= $r['kode_barang'] ?>">
                <?= htmlspecialchars($r['nama'])?>
            </a></td>
            <td>Rp<?= number_format($r['harga'],0,',','.') ?></td>
            <td><?= htmlspecialchars($r['deskripsi'])?></td>
            <td><?= formatTanggalIndonesia($r['tanggal']) ?></td>
            <td><?= htmlspecialchars($r['jam'])?></td>
            <td><?= htmlspecialchars($r['payment'])?></td>
            <td>
              <a href="edit.php?id=<?= $r['kode_barang'] ?>">Edit</a> |
              <a href="hapus.php?id=<?= $r['kode_barang'] ?>"
                 onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
          </tr>
        <?php 
            $no++;
          endwhile;
        else: ?>
          <tr><td colspan="10" align="center">Tidak ada data.</td></tr>
        <?php endif ?>
        </tbody>
      </table>

      <!-- navigasi -->
      <p align="center">
        <?php if($totalPages>1): ?>
          <?php if($currPage>1): ?>
            <a href="?page=barang_list&p=<?= $currPage-1 ?>&limit=<?= $limit ?>">&laquo; Sebelumnya</a>
          <?php endif ?>
          <?php for($i=1;$i<=$totalPages;$i++): ?>
            <?php if($i==$currPage): ?>
              <strong><?= $i ?></strong>
            <?php else: ?>
              <a href="?page=barang_list&p=<?= $i ?>&limit=<?= $limit ?>"><?= $i ?></a>
            <?php endif ?>
          <?php endfor ?>
          <?php if($currPage<$totalPages): ?>
            <a href="?page=barang_list&p=<?= $currPage+1 ?>&limit=<?= $limit ?>">Selanjutnya &raquo;</a>
          <?php endif ?>
        <?php endif ?>
      </p>

    <?php else: ?>
      <!-- di sini kamu include file toko.php, tambah.php, profil_perusahaan.php, dll -->
      <?php include $pageParam . '.php'; ?>
    <?php endif ?>
  </div>

</body>
</html>