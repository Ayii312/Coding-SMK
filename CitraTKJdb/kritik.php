<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#274f75">
    <link rel="stylesheet" href="style.css">
    <title>KritSar - SMKN 3 BUDURAN (PERKAPALAN)</title>
</head>
<body>
    <div id="page">
        <div id="header">
            <div id="section">
                <div class="logo-wrapper"><a href="index.php"><img src="image/logo.png" alt="Logo SMK"></a></div>
                <span>
                    <strong>SMKN 3 BUDURAN (PERKAPALAN)</strong>
                    <span class="location-text"><br>📍Jl. Jenggolo 1C, Buduran.</span>
                </span></div>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="demokrasiku.php">Demokrasi Sekolah</a></li>
                <li class="current"><a href="kritik.php">Kritik dan Saran</a></li>
            </ul>
        </div>

        <div id="content">
            <div class="feedback-container">
                <h3>Kritik dan Saran</h3>
                <h2>Sampaikan Aspirasimu</h2>
                <p>Masukan Anda sangat berharga bagi kemajuan sekolah kami. Silakan tuliskan kritik atau saran secara bijak.</p>
                
                <form action="proses_kritik.php" method="post">
                    <div class="input-group">
                        <textarea name="komentar" placeholder="Tuliskan kritik dan saranmu di sini..." required></textarea>
                    </div>
                    <input type="submit" name="submit" value="KIRIM MASUKAN" class="btn-submit">
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