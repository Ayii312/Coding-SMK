<?php
require __DIR__.'/db.php'; 
require __DIR__.'/functions.php';

$kode = $_GET['kode'] ?? ''; 
$stmt = $mysqli->prepare("SELECT * FROM products WHERE kode=?");
$stmt->bind_param('s', $kode);
$stmt->execute();
$item = $stmt->get_result()->fetch_assoc(); 

if(!$item){
    die('Produk tidak ada');
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
    csrf_check();

    $nama   = $_POST['nama'];
    $harga  = (int)$_POST['harga'];
    $stok   = (int)$_POST['stok'];
    $satuan = $_POST['satuan'];

    // Hitung total otomatis
    $total = $harga * $stok;

    $u = $mysqli->prepare("UPDATE products SET nama=?, harga=?, stok=?, satuan=?, total=? WHERE kode=?");
    $u->bind_param('siisis', $nama, $harga, $stok, $satuan, $total, $kode);
    $u->execute();

    flash('ok','Updated');
    header('Location: read.php');exit;
}
?>

<link rel="stylesheet" href="style.css">
<h1>Edit <?=e($item['kode'])?></h1>

<section style="max-width: auto; margin: 50px; padding: 0px 40px;">
<form method="post">
    <input type="hidden" name="csrf" value="<?=e(csrf_token())?>">

    <table class="table table-dark">
        <tr>
            <td>Nama</td>
            <td><input name="nama" class="form-control" value="<?=e($item['nama'])?>" required style="width:100%"></td>        
        </tr>
        <tr>
            <td>Satuan</td>
            <td><input name="satuan" class="form-control" value="<?=e($item['satuan'])?>" required style="width:100%"></td>
        </tr>
        <tr>
            <td>Harga</td>
            <td><input name="harga" type="number" class="form-control" value="<?=e($item['harga'])?>" required style="width:100%"></td>
        </tr>
        <tr>
            <td>Stok</td>
            <td><input name="stok" type="number" class="form-control" value="<?=e($item['stok'])?>" required style="width:100%"></td>
        </tr>
    </table>
    <br>
    <a href="read.php" class="btn btn-secondary">Kembali</a>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
</section>

<footer>
&copy; 2025 Stemapal Smart Farm - SMKN 3 Buduran
</footer>
