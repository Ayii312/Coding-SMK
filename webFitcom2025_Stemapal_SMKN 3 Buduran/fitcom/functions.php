<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
function csrf_token() {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));
    return $_SESSION['csrf'];
}
function csrf_check() {
    if (($_POST['csrf'] ?? '') !== ($_SESSION['csrf'] ?? '')) {
        http_response_code(403); die('Invalid CSRF token');
    }
}
function flash($key, $msg=null) {
    if ($msg !== null) { $_SESSION['flash'][$key] = $msg; return; }
    $m = $_SESSION['flash'][$key] ?? null; unset($_SESSION['flash'][$key]); return $m;
}
function rupiah($angka) { return 'Rp ' . number_format((int)$angka,0,',','.'); }
function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
