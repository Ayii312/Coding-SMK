<?php
// index.php
include 'koneksi.php';

// ————————————————
// Fungsi format tanggal ke Bahasa Indonesia
// ————————————————
function formatTanggalIndonesia($tanggal) {
    if (!$tanggal) return "-"; // kalau null atau kosong
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
// Halaman yang diizinkan
// ————————————————
$allowedPages = ['home','tambah','dish_list','dishcard','toko','visimisi','hubungi'];
$pageParam = isset($_GET['page']) ? $_GET['page'] : 'toko';
if (!in_array($pageParam, $allowedPages)) {
    $pageParam = 'toko';
}

// ————————————————
// Jika halaman dish_list ditampilkan → setup paginasi
// ————————————————
if ($pageParam === 'dish_list') {
    $limit_options = [10,25,50,100];
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 25;
    if (!in_array($limit, $limit_options)) $limit = 25;

    $currPage = isset($_GET['p']) ? max((int)$_GET['p'],1) : 1;
    $offset = ($currPage - 1) * $limit;

    // hitung total data
    $resC = $koneksi->query("SELECT COUNT(*) AS total FROM dish");
    $total = $resC->fetch_assoc()['total'];
    $totalPages = ceil($total / $limit);

    // ambil data
    $sql = "
      SELECT id_dish,gambar_dish,nama_dish,harga_dish,
             deskripsi_dish,tanggal_beli,jam,`order`
      FROM dish
      ORDER BY id_dish
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
<head>
  <meta charset="UTF-8">
  <title>Delish Ayloaf • Dashboard</title>
  <link rel="stylesheet" href="index.css">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar-container">
    <div class="sidebar-main">
      <h3>Delish Ayloaf</h3>
      <img src="logo.png" alt="Ayloaf" class="sidebar-logo">
      <a href="?page=home"><i class="fa fa-home"></i> Home</a>
      <a href="?page=tambah"><i class="fa fa-plus"></i> Tambah Dish</a>
      <a href="?page=dish_list"><i class="fa fa-list"></i> Daftar Dish</a>
      <a href="?page=dishcard"><i class="fa fa-th"></i> Daftar Dish II</a>
    </div>
    <div class="sidebar-secondary">
      <h3>Informasi</h3>
      <a href="?page=toko"><i class="fa fa-store"></i> Profil Kedai</a>
      <a href="?page=visimisi"><i class="fa fa-bullseye"></i> Visi Misi</a>
      <a href="?page=hubungi"><i class="fa fa-envelope"></i> Hubungi Kami</a>
    </div>
  </div>

  <!-- Konten Utama -->
  <div class="content">
    <?php if ($pageParam === 'dish_list'): ?>
      <h1>Daftar Menu Dish</h1>
      <p align="center">
        <a href="?page=tambah"><button>Tambah Dish</button></a>
      </p>
      <p align="center">
        Tampilkan:
        <select onchange="location.href='?page=dish_list&p=1&limit='+this.value">
          <?php foreach($limit_options as $opt): ?>
            <option value="<?= $opt ?>" <?= $opt === $limit ? 'selected' : '' ?>>
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
            <th>Jam Beli</th><th>Order</th><th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php if($data->num_rows): 
          $no = $offset + 1;
          while($r = $data->fetch_assoc()): ?>
          <tr>
            <td align="center"><?= $no ?></td>
            <td><?= $r['id_dish'] ?></td>
            <td><img src="uploads/<?= htmlspecialchars($r['gambar_dish'])?>" width="80"></td>
            <td><a href="detail.php?id=<?= $r['id_dish'] ?>">
                <?= htmlspecialchars($r['nama_dish'])?>
            </a></td>
            <td>Rp<?= number_format($r['harga_dish'],0,',','.') ?></td>
            <td><?= htmlspecialchars($r['deskripsi_dish'])?></td>
            <td><?= $r['tanggal_beli'] ? formatTanggalIndonesia($r['tanggal_beli']) : '-' ?></td>
            <td><?= htmlspecialchars($r['jam'])?></td>
            <td><?= htmlspecialchars($r['order'])?></td>
            <td>
              <a href="edit.php?id=<?= $r['id_dish'] ?>">Edit</a> |
              <a href="hapus.php?id=<?= $r['id_dish'] ?>"
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
            <a href="?page=dish_list&p=<?= $currPage-1 ?>&limit=<?= $limit ?>">&laquo; Sebelumnya</a>
          <?php endif ?>
          <?php for($i=1;$i<=$totalPages;$i++): ?>
            <?php if($i==$currPage): ?>
              <strong><?= $i ?></strong>
            <?php else: ?>
              <a href="?page=dish_list&p=<?= $i ?>&limit=<?= $limit ?>"><?= $i ?></a>
            <?php endif ?>
          <?php endfor ?>
          <?php if($currPage<$totalPages): ?>
            <a href="?page=dish_list&p=<?= $currPage+1 ?>&limit=<?= $limit ?>">Selanjutnya &raquo;</a>
          <?php endif ?>
        <?php endif ?>
      </p>

    <?php else: ?>
      <?php include $pageParam . '.php'; ?>
    <?php endif ?>
  </div>

</body>
</html>
