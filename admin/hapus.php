<?php
require '../db.php'; 

if (isset($_GET['id'])) {
    $newsId = $_GET['id'];
    $db = getDB(); 
    $collection = $db->news; 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($newsId)]);

        header("Location: dashboardAdmin.php");
        exit;
    }

    $newsItem = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($newsId)]);
    if (!$newsItem) {
        die("Berita tidak ditemukan.");
    }
} else {
    die("ID berita tidak diberikan.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Hapus Berita</title>
</head>
<body>
    <div class="container">
        <h1>Hapus Berita</h1>
        <p>Apakah Anda yakin ingin menghapus berita ini?</p>
        <form method="POST">
            <button type="submit" class="btn delete">Ya, Hapus</button>
            <a href="dashboardAdmin.php" class="btn">Batal</a>
        </form>
    </div>
</body>
</html>