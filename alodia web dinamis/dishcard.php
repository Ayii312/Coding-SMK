<?php
include 'koneksi.php';

// --- Ambil parameter pageNum (bukan page utama index) ---
$pagenum = isset($_GET['pagenum']) ? (int)$_GET['pagenum'] : 1;
$limit   = isset($_GET['limit']) ? (int)$_GET['limit'] : 2;

// pastikan minimal 1
if ($pagenum < 1)  $pagenum = 1;
if ($limit < 1)    $limit   = 1;

// batasi maksimal limit
$limit = min($limit, 100);

$start = ($pagenum - 1) * $limit;
if ($start < 0) $start = 0;

// --- Hitung total data ---
$total_query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM dish");
if (!$total_query) {
    die("Query error (count): " . mysqli_error($koneksi));
}
$total_data  = mysqli_fetch_assoc($total_query)['total'];
$total_pages = $total_data > 0 ? ceil($total_data / $limit) : 1;

// --- Ambil data (gunakan backtick untuk kolom order) ---
$sql = "SELECT id_dish, gambar_dish, nama_dish, harga_dish, deskripsi_dish, tanggal_beli, jam, `order`
        FROM dish
        ORDER BY id_dish ASC
        LIMIT $start, $limit";
$result = mysqli_query($koneksi, $sql);
if (!$result) {
    die("Query error (select): " . mysqli_error($koneksi));
}

// opsi limit
$limit_options = [2, 5, 10, 15, 20, 25];
?>

<h1 align="center">Daftar Dish Card</h1>

<!-- Dropdown pilih limit -->
<p align="center">
    Tampilkan:
    <select onchange="window.location.href='index.php?page=dishcard&pagenum=1&limit=' + this.value;">
        <?php foreach ($limit_options as $option) : ?>
            <option value="<?= $option ?>" <?= $option == $limit ? 'selected' : '' ?>>
                <?= $option ?>
            </option>
        <?php endforeach; ?>
    </select> dish
</p>
<br>

<?php
$no = $start + 1;
while ($r = mysqli_fetch_assoc($result)):
    $id_dish        = htmlspecialchars($r['id_dish']);
    $nama_dish      = htmlspecialchars($r['nama_dish']);
    $deskripsi_dish = htmlspecialchars($r['deskripsi_dish']);
    $harga_dish     = number_format((float)$r['harga_dish'], 0, ',', '.');
    $gambar_dish    = !empty($r['gambar_dish']) ? htmlspecialchars($r['gambar_dish']) : 'no-image.jpg';
    $tanggal_beli   = !empty($r['tanggal_beli']) ? htmlspecialchars($r['tanggal_beli']) : '-';
    $jam            = !empty($r['jam']) ? htmlspecialchars($r['jam']) : '-';
    $order_field    = isset($r['order']) ? htmlspecialchars($r['order']) : '-';
?>
    <hr><br>
    <div align="center">
        <img src="uploads/<?= $gambar_dish ?>" alt="gambar dish" width="350" height="200">
    </div>

    <table align="center" border="0" width="60%">
        <tr>
            <td width="25%"><strong>No</strong></td>
            <td>:</td>
            <td><?= $no++ ?></td>
        </tr>
        <tr>
            <td><strong>Nama</strong></td>
            <td>:</td>
            <td style="font-size: 25px;">
                <a href="detail.php?id_dish=<?= $id_dish ?>"><?= $nama_dish ?></a>
            </td>
        </tr>
        <tr>
            <td><strong>Harga</strong></td>
            <td>:</td>
            <td>Rp<?= $harga_dish ?></td>
        </tr>
        <tr>
            <td><strong>Deskripsi</strong></td>
            <td>:</td>
            <td><?= $deskripsi_dish ?></td>
        </tr>
        <tr>
            <td><strong>Tanggal Beli</strong></td>
            <td>:</td>
            <td><?= $tanggal_beli ?></td>
        </tr>
        <tr>
            <td><strong>Jam</strong></td>
            <td>:</td>
            <td><?= $jam ?></td>
        </tr>
        <tr>
            <td><strong>Order</strong></td>
            <td>:</td>
            <td><?= $order_field ?></td>
        </tr>
    </table>

    <p align="center">
        <a href="edit.php?id_dish=<?= $id_dish ?>">
            <button class="btn" style="background: rgb(0, 132, 255);">Edit</button>
        </a>
        <a href="hapus.php?id_dish=<?= $id_dish ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus dish ini?');">
            <button class="btn" style="background: rgb(190, 18, 18);">Hapus</button>
        </a>
    </p><br>
<?php endwhile; ?>

<!-- Pagination -->
<p align="center">
<?php
if ($total_pages > 1) {
    echo "Halaman: ";
    if ($pagenum > 1) {
        echo "<a class='btn btn-primary' href='index.php?page=dishcard&pagenum=" . ($pagenum - 1) . "&limit=$limit'>Sebelumnya</a> ";
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $pagenum) {
            echo "<strong>$i</strong> ";
        } else {
            echo "<a class='btn btn-primary' href='index.php?page=dishcard&pagenum=$i&limit=$limit'>$i</a> ";
        }
    }
    if ($pagenum < $total_pages) {
        echo "<a class='btn btn-primary' href='index.php?page=dishcard&pagenum=" . ($pagenum + 1) . "&limit=$limit'>Selanjutnya</a>";
    }
}
?>
</p>
