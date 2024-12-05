<?php
require 'vendor/autoload.php';
require 'db.php';

// Koneksi ke database
$db = getDB();
$posts = $db->posts->find();

// Fungsi untuk membuat slug dari judul
function generateSlug($title) {
    return strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', trim($title)));
}

// Mendapatkan slug dari URL
if (isset($_SERVER['REQUEST_URI'])) {
    $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $slug = basename($urlPath);

    // Mencari berita berdasarkan slug
    foreach ($posts as $item) {
        if (generateSlug($item['title']) === $slug) {
            $post = $item;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title><?= isset($post) ? htmlspecialchars($post['title']) : 'Berita Tidak Ditemukan' ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            margin: 20px auto;
            max-width: 800px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .news-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .news-meta {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        .news-content {
            font-size: 16px;
            line-height: 1.8;
        }

        .back-button {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if (isset($post)): ?>
            <h1 class="news-title"><?= htmlspecialchars($post['title']) ?></h1>
            <p class="news-meta"><?= htmlspecialchars($post['created_at']->toDateTime()->format('F j, Y')) ?> - <?= htmlspecialchars($post['category']) ?></p>
            <div class="news-content">
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </div>
            <a href="dashboard" class="back-button">Kembali ke Beranda</a>
        <?php else: ?>
            <h1>Berita Tidak Ditemukan</h1>
            <p>Maaf, berita yang Anda cari tidak tersedia.</p>
            <a href="dashboard" class="back-button">Kembali ke Beranda</a>
        <?php endif; ?>
    </div>
</body>

</html>
