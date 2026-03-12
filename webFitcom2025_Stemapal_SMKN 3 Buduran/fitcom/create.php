<?php
require __DIR__.'/db.php'; 
require __DIR__.'/functions.php';

if($_SERVER['REQUEST_METHOD']==='POST'){ 
    csrf_check();
    $kode   = $_POST['kode'];
    $nama   = $_POST['nama'];
    $harga  = (int) $_POST['harga'];
    $stok   = (int) $_POST['stok'];
    $satuan = $_POST['satuan'];
    
    $total  = $harga * $stok;
    
    $stmt = $mysqli->prepare("INSERT INTO products(kode,nama,harga,stok,satuan,total) VALUES(?,?,?,?,?,?)");
    $stmt->bind_param('ssiisi', $kode, $nama, $harga, $stok, $satuan, $total);
    $stmt->execute();
    
flash('ok','Produk ditambah'); 
header('Location: read.php'); 
exit; }
?>

<link rel="stylesheet" href="style.css">
<br><br>
<section style="max-width: auto; margin: 50px; padding: 0px 40px;">
    <h1>Tambah Produk</h1>
        <table class="table table-dark">
        <form method="post">
        <input type="hidden" name="csrf" value="<?=e(csrf_token())?>">
        <tr>
        <td>Kode</td>
        <td><input name="kode" class="form-control" required style="width:100%"></td>
    </tr>
    <tr>
        <td>Nama</td>
        <td><input name="nama" class="form-control" required style="width:100%"></td>        
    </tr>
    <tr>
        <td>Harga Satuan</td>
        <td><input name="harga" type="number" class="form-control" required style="width:100%"></td>
    </tr>
    <tr>
        <td>Stok Tersedia</td>
        <td><input name="stok" class="form-control" required style="width:100%"></td>
    </tr>
    <tr>
        <td>Satuan</td>
        <td><input name="satuan" class="form-control" required style="width:100%"></td>
    </tr>
</table>
<br>
<button class="btn btn-primary">Simpan</button>
</form>
</table>
</section>

<footer>
&copy; 2025 Stemapal Smart Farm - SMKN 3 Buduran
</footer>