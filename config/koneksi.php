<?php
// ============================================================
//  Almaris Hotel Reservation Website
//  File    : config/koneksi.php
//  Purpose : Database connection configuration
//  DB      : almaris_hotel_db (MySQL via XAMPP)
// ============================================================

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'hotel_db');

// Create connection
$koneksi = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$koneksi) {
    die(json_encode([
        'status'  => 'error',
        'message' => 'Koneksi database gagal: ' . mysqli_connect_error()
    ]));
}

// Set charset to UTF-8 to support all characters
mysqli_set_charset($koneksi, 'utf8mb4');

// Optional: Set timezone consistent with PHP
date_default_timezone_set('Asia/Jakarta');
?>
