<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#274f75">
    <link rel="stylesheet" href="style.css">
    <title>Profil - SMKN 3 BUDURAN (PERKAPALAN)</title>
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
                <li class="current"><a href="profil.php">Profil</a></li>
                <li><a href="demokrasiku.php">Demokrasi Sekolah</a></li>
                <li><a href="kritik.php">Kritik dan Saran</a></li>
            </ul>
        </div>

        <div id="content">
            <div class="main-profile">
                <h3>Profil Sekolah</h3>
                <h2>Visi dan Misi</h2>
                <div class="visi-misi-box">
                    <p>
                        <strong>Visi:</strong> <br>
                        Terbentuknya sumber daya manusia yang kompeten sesuai standar kompetensi Nasional dan Internasional, serta peduli dan berbudaya lingkungan.
                    </p>
                    <p>
                        <strong>Misi:</strong>
                        <ul>
                            <li>Membentuk mental kepribadian yang beriman dan bertaqwa kepada Tuhan Yang Maha Esa..</li>
                            <li>Melakukan perubahan pola pikir, tingkah laku pendidik atau siswa dalam kegiatan belajar mengajar dengan menyesuaikan iklim industri.</li>
                            <li>Melaksanakan kegiatan pembelajaran keterampilan dengan menyesuaikan kebutuhan industri.</li>
                            <li>Mengembangkan lingkungan clean and green school.</li>
                            <li>Peduli dan berbudaya lingkungan.</li>
                            <li>Melestarikan fungsi lingkungan hidup.</li>
                            <li>Mencegah terjadinya pencemaran.</li>
                            <li>Mencegah kerusakan lingkungan.</li>
                        </ul>
                    </p>
                </div>

                <hr>

                <div class="konsentrasi-section">
                    <h2 class="center-text">Konsentrasi Keahlian</h2>
                    <p class="center-text">Sekolah Kami Memiliki 10 Konsentrasi Keahlian Favorit</p>
                    
                    <div class="grid-container">
                        <div class="card">
                            <img src="image/tptu.jpg" alt="TPTU">
                            <div class="overlay">
                                <h4>TPTU</h4>
                                <p>Teknik Pendinginan dan Tata Udara</p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="image/tpm.jpg" alt="TPM">
                            <div class="overlay">
                                <h4>TPM</h4>
                                <p>Teknik Pemesinan</p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="image/tkro.jpg" alt="TKRO">
                            <div class="overlay">
                                <h4>TKRO</h4>
                                <p>Teknik Kendaraan Ringan Otomotif</p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="image/kkb.jpg" alt="KKB">
                            <div class="overlay">
                                <h4>KKB</h4>
                                <p>Konstruksi Kapal Baja</p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="image/tkk.jpg" alt="TKK">
                            <div class="overlay">
                                <h4>TKK</h4>
                                <p>Teknik Kelistrikan Kapal</p>
                            </div>
                        </div>

                        <div class="card">
                            <img src="image/drbk.jpg" alt="DRBK">
                            <div class="overlay">
                                <h4>DRBK</h4>
                                <p>Desain dan Rancang Bangun Kapal</p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="image/tpk.jpg" alt="TPK">
                            <div class="overlay">
                                <h4>TPK</h4>
                                <p>Teknik Pengelasan Kapal</p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="image/ik.jpg" alt="IK">
                            <div class="overlay">
                                <h4>IK</h4>
                                <p>Interior Kapal</p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="image/tipk.jpg" alt="TIPK">
                            <div class="overlay">
                                <h4>TIPK</h4>
                                <p>Teknik Pemesinan Kapal</p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="image/tkj.jpg" alt="TKJ">
                            <div class="overlay">
                                <h4>TKJ</h4>
                                <p>Teknik Komputer dan Jaringan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <h2>Prestasi Terkini</h2>
                <p>Siswa kami aktif berpartisipasi dalam berbagai ajang nasional maupun internasional, mulai dari Olimpiade Sains, Lomba Kompetensi Siswa (LKS), hingga kompetisi Robotika.</p>
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