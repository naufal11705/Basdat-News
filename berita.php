<?php
require 'vendor/autoload.php';
require 'db.php';

$db = getDB();
$posts = $db->posts->find();
$commentsCollection = $db->comments;

function generateSlug($title)
{
    return strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', trim($title)));
}

if (isset($_SERVER['REQUEST_URI'])) {
    $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $slug = basename($urlPath);

    foreach ($posts as $item) {
        if (generateSlug($item['title']) === $slug) {
            $post = $item;
            break;
        }
    }
}

// Menangani pengiriman komentar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $name = $_SESSION['username'];
    $comment = htmlspecialchars($_POST['comment']);

    if (!empty($name) && !empty($comment)) {
        $commentsCollection->insertOne([
            'post_id' => $post['_id'],
            'name' => $name,
            'comment' => $comment,
            'created_at' => new MongoDB\BSON\UTCDateTime()
        ]);
    }
}

// Mengambil komentar untuk post ini
$comments = $commentsCollection->find(['post_id' => $post['_id']]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title><?= isset($post) ? htmlspecialchars($post['title']) : 'Berita Tidak Ditemukan' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Roboto, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        #container-berita {
            margin: 20px auto;
            max-width: 800px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        header {
            background: #333;
            color: #fff;
            padding: 16px 0;
            font-family: Anton;
        }

        header h1 {
            margin: 0;
            text-align: center;
        }

        header nav {
            text-align: center;
            margin-top: 8px;
        }

        header nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 16px;
        }

        header nav a:hover {
            text-decoration: underline;
        }

        footer {
            background: #000000;
            color: #fff;
            text-align: center;
            padding: 16px 0;
            font-family: Anton, sans-serif;
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
            margin-bottom: 20px;
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

        ::-webkit-scrollbar {
            display: none;
        }

        .image {
            width: 100%;
            height: auto;
            object-fit: cover;
            max-height: 300px;
            margin-bottom: 20px;
        }

        .comment {
            background-color: #f8f8f8;
            border-left: 5px solid #007bff;
            /* Add a left border to match the header theme */
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 14px;
            /* Smaller text size for comments */
        }

        .comment strong {
            color: #007bff;
            font-size: 1.1em;
        }

        .comment small {
            display: block;
            color: #666;
            font-size: 0.9em;
            margin-top: 5px;
        }

        .comment p {
            margin: 10px 0 0;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-primary {
            border-radius: 5px;
        }

        .comments-list {
            max-height: 500px;
            overflow-y: auto;
        }

        /* Ensure comment form has the same width as the article content */
        .comment-form {
            width: 100%;
            max-width: 800px;
        }

        .comment-form textarea {
            resize: vertical;
        }

        .comment-form .form-label {
            font-size: 14px;
        }

        .comment-form .form-control {
            font-size: 14px;
        }

        .comment-form button {
            font-size: 14px;
        }
    </style>
</head>

<body>

    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="../img/BeritaKini.png" alt="BeritaKini Logo" width="70" height="48" class="me-3">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="../berita" class="nav-link px-2 text-secondary">Berita</a></li>
                    <li><a href="../faq" class="nav-link px-2 text-white">FAQs</a></li>
                    <li><a href="../about" class="nav-link px-2 text-white">About</a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
                </form>

                <div class="text-end">
                    <a href="../login" class="btn btn-outline-light me-2">Login</a>
                </div>

            </div>
        </div>
    </header>

    <div id="container-berita" class="container">
        <?php if (isset($post)): ?>
            <img src="<?= '../' . htmlspecialchars($post['image']) ?>" alt="Image" class="image">
            <h1 class="news-title"><?= htmlspecialchars($post['title']) ?></h1>
            <p class="news-meta"><?= htmlspecialchars($post['created_at']->toDateTime()->format('F j, Y')) ?> - <?= htmlspecialchars($post['category']) ?></p>
            <div class="news-content">
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </div>
            <p class="news-meta"> Author: <?= htmlspecialchars($post['author']) ?></p>
            <a href="../" class="back-button">Kembali ke Beranda</a>

            <hr style="border: 1px solid #ddd; margin: 30px 0;">

            <h5>Komentar</h5>
                <form method="POST" class="comment-form mb-4 mt-3">
                    <div class="mb-3">
                        <label for="comment" class="form-label">Komentar</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                </form>

                <div class="mt-4 comments-list">
                    <h5>Daftar Komentar:</h5>
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment">
                            <strong><?= htmlspecialchars($comment['name']) ?></strong>
                            <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                            <small><?= $comment['created_at']->toDateTime()->format('F j, Y, g:i a') ?></small>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <h1>Berita Tidak Ditemukan</h1>
                <p>Maaf, berita yang Anda cari tidak tersedia.</p>
                <a href="../" class="back-button">Kembali ke Beranda</a>
            <?php endif; ?>
    </div>

    <footer class="sticky-bottom">
        <div class="container">
            <p>&copy; 2024 BeritaKini. Semua Hak Dilindungi.</p>
        </div>
    </footer>

</body>

</html>