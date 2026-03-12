<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stemapal Smart Farm - SMKN 3 Buduran</title>
  <link rel="stylesheet" href="php.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="sidebar-container">
    <div class="sidebar-main">
      <h3>STEMAPAL SMART FARM</h3>
      <div class="menu">
        <img src="farm.jpg" alt="Logo farm" class="sidebar-logo"><br>
        <a href="#" onclick="loadPage('ind.php')"><span class="icon icon-home"></span> Home</a>
        <a href="#" onclick="loadPage('create.php')"><span class="icon icon-plus"></span> Tambahkan Stok</a>
        <a href="#" onclick="loadPage('read.php')"><span class="icon icon-list"></span> Tampilkan Stok</a>
        <a href="#" onclick="loadPage('profil.php')"><span class="icon icon-user"></span> Tentang Kami</a>
      </div>
    </div>
  </div>

  <div class="content">
    <iframe id="contentFrame" src="ind.php"></iframe>
  </div>

  <script>
    // Fungsi untuk memuat halaman ke dalam iframe
    function loadPage(page) {
      document.getElementById("contentFrame").src = page;
    }

    function resetFrame() {
      document.getElementById("contentFrame").src = 'ind.php';
    }
  </script>
</body>
</html>
