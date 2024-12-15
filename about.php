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

$db = getDB();
$categoryCollection = $db->categories;
$categories = $categoryCollection->find();

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

        #container-about {
            margin: 20px auto;
            max-width: 800px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .meta {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        .content {
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 20px;
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

        footer {
            background: #000000;
            color: #fff;
            text-align: center;
            padding: 16px 0;
            font-family: Anton, sans-serif;
        }

        ::-webkit-scrollbar {
            display: none;
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
                    <li><a href="berita" class="nav-link px-2 text-white">Berita</a></li>
                    <li><a href="faq" class="nav-link px-2 text-white">FAQs</a></li>
                    <li><a href="#" class="nav-link px-2 text-secondary">About</a></li>
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

    <div id="container-about" class="container">

    <div style="position: relative; width: 100%; height: 0; padding-top: 141.4286%;
        padding-bottom: 0; box-shadow: 0 2px 8px 0 rgba(63,69,81,0.16); margin-top: 1.6em; margin-bottom: 0.9em; overflow: hidden;
        border-radius: 8px; will-change: transform;">
        <iframe loading="lazy" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none; padding: 0;margin: 0;"
            src="https://www.canva.com/design/DAGYYmJGFPc/EFNpyWVpxODRNpmIUYAe2w/view?embed" allowfullscreen="allowfullscreen" allow="fullscreen">
        </iframe>
    </div>
    <a href="https:&#x2F;&#x2F;www.canva.com&#x2F;design&#x2F;DAGYYmJGFPc&#x2F;EFNpyWVpxODRNpmIUYAe2w&#x2F;view?utm_content=DAGYYmJGFPc&amp;utm_campaign=designshare&amp;utm_medium=embeds&amp;utm_source=link" target="_blank" rel="noopener"></a>

    </div>

    <footer class="sticky-bottom">
        <div class="container">
            <p>&copy; 2024 BeritaKini. Semua Hak Dilindungi.</p>
        </div>
    </footer>

    <script>
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