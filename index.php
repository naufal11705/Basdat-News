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
        require_once 'login.php';
        break;

    case '/register':
        require_once 'register.php';
        break;

    case '/':
        require_once 'dashboard.php';
        break;

    case '/berita':
        require_once 'dashboard.php';
        break;

    case '/about':
        require_once 'about.php';
        break;

    case '/faq':
        require_once 'faq.php';
        break;

    case '/kategori':
        require_once 'kategori.php';
        break;
    
    case '/berita/'. $id:
        require_once 'berita.php';
        break;

    case '/dashboard':
        require_once 'admin/dashboardAdmin.php';
        break;

    case '/tambahBerita':
        require_once 'admin/tambahBerita.php';
        break;

    case '/edit':
        $id = $_GET['id'] ?? null;
        if ($id) {
            require_once 'admin/edit.php';
        }
        break;

    case '/hapus':
        $id = $_GET['id'] ?? null;
        if ($id) {
            require_once 'admin/hapus.php';
        }
        break;

    default:
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found - Path: " . $path;
        break;
}

?>