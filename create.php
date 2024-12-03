<?php 
require 'db.php'; 

$db = getDB();
$categoryCollection = $db->categories;
$categories = $categoryCollection->find();
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $db = getDB(); 
    $collection = $db->posts; 
 
    $insertResult = $collection->insertOne([ 
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'summary' => $_POST['summary'],
        'author' => $_POST['author'],
        'category' => $_POST['category'],
        'created_at' => new MongoDB\BSON\UTCDateTime(),
        'updated_at' => new MongoDB\BSON\UTCDateTime(),
    ]); 
    header("Location: index.php"); 
    exit(); 
}
?> 
 
<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Buat Postingan Baru</title> 
    <link rel="stylesheet" href="style.css"> 
</head> 
<body> 
    <h1>Buat Postingan Baru</h1> 
    <form method="post"> 
        <input type="text" name="title" placeholder="Judul" required> 
        <textarea name="content" placeholder="Konten" required></textarea>
        <textarea name="summary" placeholder="Summary" required></textarea>
        <label for="category">Pilih Kategori:</label>
        <select name="category" id="category" required>
            <option value="">Pilih Kategori</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category['name']) ?>">
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Buat</button> 
    </form> 
    <a href="index.php">Kembali ke Daftar Postingan</a> 
</body> 
</html>