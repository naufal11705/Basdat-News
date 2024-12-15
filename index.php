<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base_path = '/Basdat-News';
$path = str_replace($base_path, '', $request_uri);
$segments = explode('/', $path);
$id = isset($segments[2]) ? $segments[2] : null;

switch ($path) {
    case '/login':
        include 'login.php';
        break;

    case '/':
        include 'dashboard.php';
        break;

    case '/berita':
        include 'dashboard.php';
        break;

    case '/about':
        include 'about.php';
        break;

    case '/faq':
        include 'faq.php';
        break;

    case '/kategori':
        include 'kategori.php';
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

?>