<?php
require 'db.php'; // Pastikan koneksi ke MongoDB sudah benar

$db = getDB(); // Mengambil koneksi ke database MongoDB

if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Memulai session jika belum dimulai
}

// Mengambil input dari form login
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Validasi input
if (empty($username) || empty($password)) {
    // Jika form kosong, kirimkan pesan error melalui session
    $_SESSION['error'] = "Username atau Password tidak boleh kosong!";
    header("Location: login.php");
    exit();
}

// Mengakses koleksi users pada database news_database
$userCollection = $db->users;  // Mengakses koleksi 'users'

if (!$userCollection) {
    die("Collection 'users' tidak ditemukan!");
}

// Mencari user di MongoDB berdasarkan username
$user = $userCollection->findOne(['username' => $username]);

// Periksa apakah user ditemukan
if (!$user) {
    // Jika username tidak ditemukan, kirimkan pesan error
    $_SESSION['error'] = "Username tidak ditemukan!";
    header("Location: login.php");
    exit();
}

// Periksa apakah password cocok
if ($user['password'] !== $password) {
    // Jika password salah, kirimkan pesan error
    $_SESSION['error'] = "Password salah!";
    header("Location: login.php");
    exit();
}

// Jika username dan password benar, set session
$_SESSION['username'] = $user['username'];
$_SESSION['role'] = $user['role'];

// Redirect ke dashboard
header("Location: dashboard"); 
exit();
?>
