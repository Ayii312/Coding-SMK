<?php 
require __DIR__.'/db.php'; 
require __DIR__.'/functions.php';
csrf_check(); 
$kode=$_POST['kode']; 
$stmt=$mysqli->prepare("DELETE FROM products WHERE kode=?");
$stmt->bind_param('s',$kode);
$stmt->execute(); 
flash('ok','Dihapus'); 
header('Location: read.php'); 
?>
