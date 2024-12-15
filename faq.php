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

        #container-faq {
            margin: 20px auto;
            max-width: 800px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
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
                    <li><a href="#" class="nav-link px-2 text-secondary">FAQs</a></li>
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

    <div id="container-faq" class="container">
    <div class="accordion" id="accordionExample">
			<div class="accordion-item">
				<h2 class="accordion-header">
					<button class="accordion-button"
						type="button" data-bs-toggle="collapse"
						data-bs-target="#collapseOne" aria-expanded="true"
						aria-controls="collapseOne">
						Apa itu BeritaKini?
					</button>
				</h2>
				<div id="collapseOne" class="accordion-collapse collapse"
					data-bs-parent="#accordionExample">
					<div class="accordion-body">
						<strong>BeritaKini</strong> 
						adalah web berita yang menyediakan antarmuka yang menarik dan mudah digunakan. 
                        Sistem ini dirancang untuk memungkinkan baik pengguna umum maupun admin untuk 
                        dengan cepat dan efisien mengakses berita terbaru, memperbarui konten, serta 
                        melaksanakan tugas-tugas terkait berita lainnya tanpa kesulitan yang sering 
                        ditemui pada antarmuka grafis. Pendekatan ini tidak hanya mempermudah akses, 
                        tetapi juga mengurangi potensi kesalahan manusia, menjaga keamanan data, dan 
                        meningkatkan efisiensi operasional dalam pengelolaan berita.
					</div>
				</div>
			</div>
			<div class="accordion-item">
				<h2 class="accordion-header">
					<button class="accordion-button collapsed" type="button"
						data-bs-toggle="collapse" data-bs-target="#collapseTwo"
						aria-expanded="false" aria-controls="collapseTwo">
						Arsitektur apa saja yang terdapat pada web ini?
					</button>
				</h2>
				<div id="collapseTwo" class="accordion-collapse collapse"
					data-bs-parent="#accordionExample">
					<div class="accordion-body">
						<strong>
							Php, Javascript, dan MongoDB
						</strong> 
						merupakan arsitektur yang digunakan untuk mengelola data 
                        pada web BeritaKini
					</div>
				</div>
			</div>
		</div>
    </div>

    <footer class="fixed-bottom">
        <div class="container">
            <p>&copy; 2024 BeritaKini. Semua Hak Dilindungi.</p>
        </div>
    </footer>
    <script src=
        "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                integrity=
        "sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
		crossorigin="anonymous">
        
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