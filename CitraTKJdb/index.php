<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#274f75">
    <link rel="stylesheet" href="style.css">
    <title>SMKN 3 BUDURAN (PERKAPALAN)</title>
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
                    <li class="current"><a href="index.php">Beranda</a></li>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="demokrasiku.php">Demokrasi Sekolah</a></li>
                    <li><a href="kritik.php">Kritik dan Saran</a></li>
                </ul>
        </div>
        <div id="content">
            <div class="hero-banner">
                <div class="hero-text">
                    <h2>Membangun Masa Depan Berbasis Teknologi</h2>
                    <p>Pusat pendidikan kejuruan yang mencetak lulusan kompeten, berkarakter, dan siap kerja di industri global.</p>
                    <a href="profil.php" class="btn-more">Jelajahi Profil</a>
                </div>
            </div>

            <div class="welcome-section">
                <h3>Selamat Datang di</h3>
                <h2>SMKN 3 BUDURAN (PERKAPALAN)</h2>
                <p>Selamat datang di portal informasi sekolah kami. Di sini Anda dapat menemukan berbagai informasi mengenai kurikulum, prestasi, hingga kegiatan demokrasi di lingkungan sekolah kami.</p>
            </div>

            <hr>

            <div class="features-grid">
                <div class="feature-item">
                    <div class="icon-box">
                        <img src="image/teknologi.png" alt="Teknologi">
                    </div>
                    <h4>Fasilitas Modern</h4>
                    <p>Laboratorium praktik dengan standar industri terbaru untuk semua jurusan.</p>
                </div>

                <div class="feature-item">
                    <div class="icon-box">
                        <img src="image/karir.png" alt="Karir">
                    </div>
                    <h4>Siap Kerja</h4>
                    <p>Bekerja sama dengan puluhan perusahaan nasional untuk penyaluran lulusan.</p>
                </div>

                <div class="feature-item">
                    <div class="icon-box">
                        <img src="image/prestasi.png" alt="Prestasi">
                    </div>
                    <h4>Berprestasi</h4>
                    <p>Juara di berbagai kompetisi nasional mulai dari LKS hingga Robotika.</p>
                </div>
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