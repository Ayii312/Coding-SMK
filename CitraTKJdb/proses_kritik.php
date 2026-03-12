<?php 
include 'koneksi.php';

// Cek apakah data sudah dikirim
if (isset($_POST['submit'])) {
    // Mengambil data dan mengamankannya dari karakter berbahaya
    $komentar = mysqli_real_escape_string($conn, $_POST['komentar']);

    // Query simpan ke tabel kritik_saran
    $sql = "INSERT INTO kritik_saran (komentar) VALUES ('$komentar')";

    if (mysqli_query($conn, $sql)) {
        $pesan = "Terima kasih! Masukan Anda telah tersimpan.";
    } else {
        $pesan = "Gagal mengirim masukan: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="theme-color" content="#274f75">
    <title>Status Kritik & Saran</title>
</head>
<body>
    <div id="content">
        <h3>Kritik dan Saran</h3>
        <hr>
        <p style="text-align: center; font-weight: bold; color: #274f75;">
            <?php echo $pesan; ?>
        </p>
        <br>
        <div style="text-align: center;">
            <a href="index.php" class="btn-submit" style="display:inline-block;">Ke Beranda</a>
        </div>
    </div>
<script>
window.onscroll = function() {
    var header = document.getElementById("header");
    if (window.pageYOffset > 50) {
        header.classList.add("scrolled");
    } else {
        header.classList.remove("scrolled");
    }
};
</script>
</body>
</html>