<!DOCTYPE html>

<?php
require 'db.php';

$db = getDB();
$posts = $db->posts->find(
    [],
    [
        'sort' => ['created_at' => -1],
    ]
);

$categories = $db->posts->distinct('category');

function generateSlug($title)
{
    return strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', trim($title)));
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>BeritaKini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style Global*/
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

        /* Header */
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

        /* Hero Section */
        .hero {
            background: #007BFF;
            color: #fff;
            padding: 32px 0;
            text-align: center;
        }

        .hero button {
            padding: 8px 16px;
            margin-top: 16px;
            background: #0056b3;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .hero button:hover {
            background: #003f7f;
        }

        /* Search Section */
        .search {
            padding: 24px 0;
            text-align: center;
            background-color: #f0f0f0;
            border-bottom: 1px solid #ddd;
        }

        .search input {
            width: 60%;
            padding: 13px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 8px;
        }

        .search input:focus {
            outline: none;
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .search button {
            padding: 13px 24px;
            font-size: 16px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search button:hover {
            background-color: #0056b3;
        }

        /*Kategori*/
        .categories {
            padding: 32px 0;
            text-align: center;
        }

        .categories .category-list {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .categories .category-item {
            background: #eee;
            padding: 16px 32px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .categories .category-item:hover {
            background: #ddd;
        }

        /* News Section */
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

        /* Footer */
        footer {
            background: #000000;
            color: #fff;
            text-align: center;
            padding: 16px 0;
            font-family: Anton, sans-serif;
        }

        .login-button {
            display: inline-block;
            background: #007BFF;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            margin-left: 16px;
        }

        .login-button:hover {
            background: #0056b3;
        }

        .news-item a {
            color: black;
            text-decoration: none;
        }

        .news-item a:hover {
            color: red;
            text-decoration: none;
        }

        .news-title {
            font-size: 20px;
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

        .category-item {
            cursor: pointer;
            padding: 5px 10px;
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: inline-block;
        }

        .category-item.active {
            background-color: #000000;
            color: #fff;
            border-color: #000000;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        .image {
            width: 100%;
            height: auto; 
            object-fit: cover;
            max-height: 200px;
            margin-bottom: 20px; 
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
                    <li><a href="#" class="nav-link px-2 text-secondary">Berita</a></li>
                    <li><a href="faq" class="nav-link px-2 text-white">FAQs</a></li>
                    <li><a href="about" class="nav-link px-2 text-white">About</a></li>
                </ul>

                <form id="search-form" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <input id="search-bar" type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
                </form>

                <div class="text-end">
                    <a href="login" class="btn btn-outline-light me-2">Login</a>
                </div>
                
            </div>
        </div>
    </header>

    <section id="categories" class="categories">
        <div class="container">
            <h2>Kategori Berita</h2>
            <div class="category-list">
                <div class="category-item" data-category="all">Semua</div>
                <?php foreach ($categories as $category): ?>
                    <div class="category-item" data-category="<?= htmlspecialchars($category) ?>">
                        <?= htmlspecialchars($category) ?>
                    </div>
                <?php endforeach; ?>
                
            </div>
        </div>
    </section>


    <section id="latest-news" class="news">
        <div class="container">
            <h2>Berita Terbaru</h2>
            <div class="news-list">
                <?php foreach ($posts as $post): ?>
                    <?php $slug = generateSlug($post['title']); ?>
                    <div class="news-item" data-category="<?= htmlspecialchars($post['category']) ?>">
                        <h3>
                            <a class="news-title id="title" href="berita/<?= $slug ?>">
                                <?= htmlspecialchars($post['title']) ?>
                            </a>
                        </h3>
                        <img src="<?=htmlspecialchars($post['image']) ?>" alt="Image" class="image">
                        <p class="news-content id="summary"><?= nl2br(htmlspecialchars($post['summary'])) ?></p>
                        <p class="news-meta"><?= htmlspecialchars($post['created_at']->toDateTime()->format('F j, Y')) ?> - <?= htmlspecialchars($post['category']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <footer class="fixed-bottom">
        <div class="container">
            <p>&copy; 2024 BeritaKini. Semua Hak Dilindungi.</p>
        </div>
    </footer>

    <script>
        function scrollToSection(id) {
            document.getElementById(id).scrollIntoView({
                behavior: "smooth"
            });
        }


        document.addEventListener("DOMContentLoaded", () => {
            const categoryItems = document.querySelectorAll(".category-item");
            const newsItems = document.querySelectorAll(".news-item");

            categoryItems.forEach((item) => {
                item.addEventListener("click", () => {
                    const selectedCategory = item.getAttribute("data-category");

                    newsItems.forEach((news) => {
                        const newsCategory = news.getAttribute("data-category");

                        if (selectedCategory === "all" || newsCategory === selectedCategory) {
                            news.style.display = "block";
                        } else {
                            news.style.display = "none";
                        }
                    });

                    categoryItems.forEach((cat) => cat.classList.remove("active"));
                    item.classList.add("active");
                });
            });
        });

        document.getElementById("search-form").addEventListener("submit", function(event) {
            event.preventDefault();
            const query = document.getElementById("search-bar").value;
            if (query) {
                window.location.href = `search.php?q=${encodeURIComponent(query)}`;
            }
        });
    </script>
</body>

</html>