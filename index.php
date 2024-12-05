<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base_path = '/news_app'; // Sesuaikan dengan base path aplikasi Anda
$path = str_replace($base_path, '', $request_uri); // Hilangkan base path dari URL
$segments = explode('/', $path);
$id = isset($segments[2]) ? $segments[2] : null;

if (!empty($_SESSION['role'])) {
    require 'fungsi/pesan_kilat.php';

    switch ($path) {
        case '/':
            include 'dashboard.php';
            break;
        
        case '/berita/'. $id:
            include 'berita.php';
            break;

        case '/dashboard':
            include 'admin/dashboardAdmin.php';
            break;

        case '/tambahBerita':
            include 'admin/tambahBerita.php';
            break;

        case '/edit':
            $id = $_GET['id'] ?? null;
            if ($id) {
                include 'admin/edit.php';
            }
            break;

        case '/hapus':
            $id = $_GET['id'] ?? null;
            if ($id) {
                include 'admin/hapus.php';
            }
            break;

        default:
            header("HTTP/1.0 404 Not Found");
            echo "404 Not Found - Path: " . $path;
            break;
    }

} else {
    require 'fungsi/pesan_kilat.php';

    switch ($path) {
        case '/':
            include 'dashboard.php';
            break;

        case '/login':
            include 'login.php';
            break;

        case '/berita/'. $id:
            include 'berita.php';
            break;

        default:
            header("HTTP/1.0 404 Not Found");
            echo "404 Not Found - Path: " . $path;
            break;
    }
}
?>