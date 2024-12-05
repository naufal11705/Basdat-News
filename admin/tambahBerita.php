<?php
require '../db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = getDB(); 
    $collection = $db->news; 

    $newNews = [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'summary' => $_POST['summary'],
        'category' => $_POST['category'],
        'author' => $_POST['author'],
        'date_published' => new MongoDB\BSON\UTCDateTime(), 
    ];

    $insertResult = $collection->insertOne($newNews);

    header("Location: dashboardAdmin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tambah Berita</title>
</head>

<body>
    <div class="container">
        <h1>Tambah Berita</h1>
        <form method="POST">
            <label for="title">Judul:</label>
            <input type="text" name="title" required>

            <label for="content">Konten:</label>
            <textarea name="content" required></textarea>

            <label for="summary">Ringkasan:</label>
            <textarea name="summary" required></textarea>

            <label for="category">Kategori:</label>
            <input type="text" name="category" required>

            <label for="author">Penulis:</label>
            <input type="text" name="author" required>

            <button type="submit">Simpan Berita</button>
        </form>
    </div>
</body>

</html>