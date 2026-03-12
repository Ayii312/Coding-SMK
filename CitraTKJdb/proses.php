<?php 
include 'koneksi.php';

$nama       = isset($_POST['nama']) ? mysqli_real_escape_string($conn, $_POST['nama']) : "-";
$kelas      = isset($_POST['kelas']) ? mysqli_real_escape_string($conn, $_POST['kelas']) : "-";
$ketua      = isset($_POST['ketua']) ? mysqli_real_escape_string($conn, $_POST['ketua']) : "-";
$wakil      = isset($_POST['wakil']) ? mysqli_real_escape_string($conn, $_POST['wakil']) : "-";
$sekretaris = isset($_POST['sekretaris']) ? mysqli_real_escape_string($conn, $_POST['sekretaris']) : "-";
$bendahara  = isset($_POST['bendahara']) ? mysqli_real_escape_string($conn, $_POST['bendahara']) : "-";

if ($nama !== "-" && isset($_POST['submit'])) {
    $sql = "INSERT INTO pemilihan (nama_pemilih, kelas, ketua, wakil_ketua, sekretaris, bendahara) 
            VALUES ('$nama', '$kelas', '$ketua', '$wakil', '$sekretaris', '$bendahara')";
    
    if (mysqli_query($conn, $sql)) {
        $status = "Berhasil disimpan!";
    } else {
        $status = "Gagal menyimpan: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#274f75">
    <link rel="stylesheet" href="style.css">
    <title>Hasil Proses</title>
</head>
<body>
    <div id="content">
        <h3>Hasil Pemilihan Demokrasi</h3>
        <hr>
        <p style="text-align: center; color: green; font-weight: bold;"><?php echo isset($status) ? $status : ""; ?></p>
        
        <p>Halo <strong><?php echo $nama; ?></strong> dari kelas <strong><?php echo $kelas; ?></strong>, berikut pilihanmu:</p>
        
        <table class="form-table">
            <tr>
                <td>Ketua</td>
                <td>: <?php echo $ketua; ?></td>
            </tr>
            <tr>
                <td>Wakil Ketua</td>
                <td>: <?php echo $wakil; ?></td>
            </tr>
            <tr>
                <td>Sekretaris</td>
                <td>: <?php echo $sekretaris; ?></td>
            </tr>
            <tr>
                <td>Bendahara</td>
                <td>: <?php echo $bendahara; ?></td>
            </tr>
        </table>
        
        <br>
        <div style="text-align: center;">
            <a href="demokrasiku.php" class="btn-submit" style="display:inline-block;">Kembali</a>
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