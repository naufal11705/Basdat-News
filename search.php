<?php
require 'db.php';

$db = getDB();
$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';

$searchCriteria = [
    '$or' => [
        ['title' => new MongoDB\BSON\Regex($searchQuery, 'i')],
        ['category' => new MongoDB\BSON\Regex($searchQuery, 'i')],
        ['author' => new MongoDB\BSON\Regex($searchQuery, 'i')]
    ]
];

$posts = $db->posts->find($searchCriteria, [
    'sort' => ['created_at' => -1],
]);

$categories = $db->categories->find();

function generateSlug($title)
{
    return strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', trim($title)));
}
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
    <title>Search Results - BeritaKini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
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

        .news {
            padding: 32px 0;
        }

        .news-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 16px;
        }

        .news-item {
            background: #fff;
            padding: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: box-shadow 0.3s;
        }

        .news-item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .news-item button {
            background: #007BFF;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 8px;
        }

        .news-item button:hover {
            background: #0056b3;
        }

        footer {
            background: #000000;
            color: #fff;
            text-align: center;
            padding: 16px 0;
            font-family: Anton, sans-serif;
        }

        .news-item a {
            color: black;
            text-decoration: none;
        }

        .news-item a:hover {
            color: red;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="img/BeritaKini.png" alt="BeritaKini Logo" width="70" height="48" class="me-3">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="home" class="nav-link px-2 text-white">Home</a></li>
                    <li><a href="berita" class="nav-link px-2 text-white">Berita</a></li>
                    <li><a href="kategori" class="nav-link px-2 text-white">Kategori</a></li>
                    <li><a href="faq" class="nav-link px-2 text-white">FAQs</a></li>
                    <li><a href="about" class="nav-link px-2 text-white">About</a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
                </form>

                <div class="text-end">
                    <a href="login" class="btn btn-outline-light me-2">Login</a>
                </div>
                
            </div>
        </div>
    </header>

    <div class="container">
        <h1>Hasil Pencarian untuk: <?= htmlspecialchars($searchQuery) ?></h1>
    </div>

    <section class="news">
        <div class="container">
            <h2>Berita Ditemukan</h2>
            <div class="news-list">
                <?php if ($posts->isDead()): ?>
                    <p>Tidak ada berita yang ditemukan.</p>
                <?php else: ?>
                    <?php foreach ($posts as $post): ?>
                        <?php $slug = generateSlug($post['title']); ?>
                        <div class="news-item" data-category="<?= htmlspecialchars($post['category']) ?>">
                            <h3>
                                <a id="title" href="berita/<?= $slug ?>">
                                    <?= htmlspecialchars($post['title']) ?>
                                </a>
                            </h3>
                            <p id="summary"><?= nl2br(htmlspecialchars($post['summary'])) ?></p>
                            <p id="date"><?= htmlspecialchars($post['created_at']->toDateTime()->format('F j, Y')) ?></p>
                            <p><?= htmlspecialchars($post['category']) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <footer class="fixed-bottom">
        <div class="container">
            <p>&copy; 2024 BeritaKini. Semua Hak Dilindungi.</p>
        </div>
    </footer>
</body>
</html>