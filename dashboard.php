<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeritaKini</title>
    <style>
        /* Style Global*/
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

        /* Header */
        header {
            background: #333;
            color: #fff;
            padding: 16px 0;
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
            background: #333;
            color: #fff;
            text-align: center;
            padding: 16px 0;
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
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>BeritaKini</h1>
            <nav>
                <a href="#latest-news">Berita Terbaru</a>
                <a href="#categories">Kategori</a>
                <a href="#about">Tentang Kami</a>
                <a href="login.php" class="login-button">Login</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h2>Berita Terkini dan Terpercaya</h2>
            <p>Dapatkan informasi terkini dari berbagai kategori, mulai dari politik, teknologi, olahraga, dan lainnya.</p>
            <button onclick="scrollToSection('latest-news')">Lihat Berita Terbaru</button>
        </div>
    </section>

    <section class="search">
        <div class="container">
            <input type="text" id="search-bar" placeholder="Cari berita...">
            <button onclick="searchNews()">Cari</button>
        </div>
    </section>

    <section id="categories" class="categories">
        <div class="container">
            <h2>Kategori Berita</h2>
            <div class="category-list">
                <div class="category-item">Politik</div>
                <div class="category-item">Teknologi</div>
                <div class="category-item">Olahraga</div>
                <div class="category-item">Hiburan</div>
                <div class="category-item">Bisnis</div>
                <div class="category-item">Kesehatan</div>
            </div>
        </div>
    </section>

    <section id="latest-news" class="news">
        <div class="container">
            <h2>Berita Terbaru</h2>
            <div class="news-list">
                <div class="news-item">
                    <h3>Utut Sebut Kemlu Minta Anggaran Rp 20 T: Saya Duga Bukan Terinspirasi Pigai</h3>
                    <p>Jakarta - Ketua Komisi I DPR RI, Utut Adianto, mengatakan Kementerian Luar Negeri (Kemlu) RI meminta anggaran sebesar Rp 20 triliun untuk periode yang akan datang.</p>
                    <p><a href="berita.html">Baca Selengkapnya</a></p>
                </div>
                <div class="news-item">
                <h3>Utut Sebut Kemlu Minta Anggaran Rp 20 T: Saya Duga Bukan Terinspirasi Pigai</h3>
                    <p>Jakarta - Ketua Komisi I DPR RI, Utut Adianto, mengatakan Kementerian Luar Negeri (Kemlu) RI meminta anggaran sebesar Rp 20 triliun untuk periode yang akan datang.</p>
                    <p><a href="berita.html">Baca Selengkapnya</a></p>
                </div>
                <div class="news-item">
                <h3>Utut Sebut Kemlu Minta Anggaran Rp 20 T: Saya Duga Bukan Terinspirasi Pigai</h3>
                    <p>Jakarta - Ketua Komisi I DPR RI, Utut Adianto, mengatakan Kementerian Luar Negeri (Kemlu) RI meminta anggaran sebesar Rp 20 triliun untuk periode yang akan datang.</p>
                    <p><a href="berita.html">Baca Selengkapnya</a></p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 BeritaKini. Semua Hak Dilindungi.</p>
        </div>
    </footer>

    <script>
        function scrollToSection(id) {
            document.getElementById(id).scrollIntoView({ behavior: "smooth" });
        }
    </script>
</body>
</html>
