<?php
require 'db.php';

$db = getDB();

if (session_status() === PHP_SESSION_NONE)
    session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if (($username == 'admin') && ($password && 'admin')) {
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    header("Location: dashboard ");
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>
