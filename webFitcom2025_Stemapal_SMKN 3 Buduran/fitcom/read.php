<?php
require __DIR__.'/db.php'; 
require __DIR__.'/functions.php';
include __DIR__.'/flash.php';

if (session_status() === PHP_SESSION_NONE){ 
    session_start();
     } 

$res=$mysqli->query("SELECT * FROM products ORDER BY kode ASC");
?>
<!DOCTYPE html>
<html lang="id">
    <head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Smart Farm CRUD — FITCOM 3.0</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<main class="container py-4">
<h1>Daftar Produk</h1>
<table class="table table-dark">
    <tr>
    <th>Kode</th>
        <th>Nama</th>
        <th>Harga Satuan</th>
        <th>Stok Tersedia</th>
        <th>Satuan</th>
        <th>Aksi</th>
</tr>
<?php while($r=$res->fetch_assoc()):?>
<tr>
    <td><?=e($r['kode'])?></td>
    <td><?=e($r['nama'])?></td>
    <td><?=rupiah($r['harga'])?></td>
    <td><?=e($r['stok'])?></td>
    <td><?=e($r['satuan'])?></td>
<td>
    <a class="btn btn-warning btn-sm" href="edit.php?kode=<?=e($r['kode'])?>">Edit</a>
<form method="post" action="delete.php" style="display:inline">
    <input type="hidden" name="csrf" value="<?=e(csrf_token())?>">
    <input type="hidden" name="kode" value="<?=e($r['kode'])?>">
        <button class="btn btn-danger btn-sm">Delete</button>
</form>
</td>
</tr>
<?php endwhile;?>
</table>
</main>

<footer>
&copy; 2025 Stemapal Smart Farm - SMKN 3 Buduran
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>
