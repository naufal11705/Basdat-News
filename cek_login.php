<?php
require 'db.php';

$db = getDB();

if (session_status() === PHP_SESSION_NONE)
    session_start();

include "fungsi/pesan_kilat.php";

$username = $_POST['username'];
$password = $_POST['password'];

$user = $db->users->findOne(['username' => $username]);

if ($user) {
    if ($user['password'] === $password) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        header("Location: dashboard ");
        exit();
    } else {
        pesan('danger', "Login gagal. Password Anda salah.");
        header("Location: login.php");
        exit();
    }
} else {
    pesan('danger', "Login gagal. Username tidak ditemukan.");
    header("Location: login.php");
    exit();
}
?>
