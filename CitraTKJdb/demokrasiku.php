<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#274f75">
    <link rel="stylesheet" href="style.css">
    <title>Demokrasi - SMKN 3 BUDURAN (PERKAPALAN)</title>
</head>
<body>
    <div id="page">
        <div id="header">
            <div id="section">
                <div class="logo-wrapper"><a href="index.php"><img src="image/logo.png" alt="Logo SMK"></a></div>
                <span>
                    <strong>SMKN 3 BUDURAN (PERKAPALAN)</strong>
                    <span class="location-text"><br>📍Jl. Jenggolo 1C, Buduran.</span>
                </span> </div>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li class="current"><a href="demokrasiku.php">Demokrasi Sekolah</a></li>
                <li><a href="kritik.php">Kritik dan Saran</a></li>
            </ul>
        </div>

        <div id="content">
            <div class="form-container">
                <h3>Suara Demokrasi</h3>
                <h2>Pemilihan Pengurus Kelas</h2>
                <p>Silakan isi form di bawah ini untuk menyalurkan aspirasi pilihanmu.</p>
                
                <form action="proses.php" method="post">
                    <table class="form-table">
                        <tr>
                            <td><label>Nama Pemilih</label></td>
                            <td>:</td>
                            <td><input type="text" name="nama" placeholder="Masukkan nama lengkap" required></td>
                        </tr>
                        <tr>
                            <td><label>Kelas dan Jurusan</label></td>
                            <td>:</td>
                            <td><input type="text" name="kelas" placeholder="Masukkan kelas dan jurusanmu" required></td>
                        </tr>
                        <tr>
                            <td><label>Ketua Kelas</label></td>
                            <td>:</td>
                            <td><input type="text" name="ketua" placeholder="Nama calon ketua" required></td>
                        </tr>
                        <tr>
                            <td><label>Wakil Ketua</label></td>
                            <td>:</td>
                            <td><input type="text" name="wakil" placeholder="Nama calon wakil" required></td>
                        </tr>
                        <tr>
                            <td><label>Sekretaris</label></td>
                            <td>:</td>
                            <td><input type="text" name="sekretaris" placeholder="Nama calon sekretaris" required></td>
                        </tr>
                        <tr>
                            <td><label>Bendahara</label></td>
                            <td>:</td>
                            <td><input type="text" name="bendahara" placeholder="Nama calon bendahara" required></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" value="SIMPAN DATA" class="btn-submit">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div id="footer">
            <p>&copy; 2026 SMKN 3 BUDURAN (PERKAPALAN) - TEKNIK KOMPUTER JARINGAN 2.</p>
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