<?php
$config = require __DIR__ . '/config.php';
$mysqli = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
if ($mysqli->connect_errno) {
    die('Gagal konek database: ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');
