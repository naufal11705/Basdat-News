<?php
require 'db.php'; 

$db = getDB();
$categoryCollection = $db->categories;
$categories = $categoryCollection->find();

if (isset($_GET['id'])) {
    $newsId = $_GET['id'];
    $db = getDB();
    $collection = $db->posts; 

    $newsItem = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($newsId)]);

    if (!$newsItem) {
        die("Berita tidak ditemukan.");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = uniqid() . "_" . $_FILES['image']['name'];
            $filePath = 'uploads/' . basename($fileName);

            move_uploaded_file($fileTmpPath, $filePath);

            $updatedData = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'summary' => $_POST['summary'],
                'category' => $_POST['category'],
                'author' => $_POST['author'],
                'image' => $filePath,
                'updated_at' => new MongoDB\BSON\UTCDateTime(),
            ];
    
            $collection->updateOne(['_id' => new MongoDB\BSON\ObjectId($newsId)], ['$set' => $updatedData]);
        }

        header("Location: dashboard");
        exit;
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
    <link rel="stylesheet" href="admin/style.css">
    <title>Edit Berita</title>
</head>
<body>
    <div class="container">
        <h1>Edit Berita</h1>
        <form method="POST" enctype="multipart/form-data">
            <label for="title">Judul:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($newsItem['title']); ?>" required>
            
            <label for="content">Konten:</label>
            <textarea name="content" required><?php echo htmlspecialchars($newsItem['content']); ?></textarea>
            
            <label for="summary">Ringkasan:</label>
            <textarea name="summary" required><?php echo htmlspecialchars($newsItem['summary']); ?></textarea>
            
            <label for="category">Kategori:</label>
            <input type="text" name="category" value="<?php echo htmlspecialchars($newsItem['category']); ?>" required>
            
            <label for="author">Penulis:</label>
            <input type="text" name="author" value="<?php echo htmlspecialchars($newsItem['author']); ?>" required>

            <label for="image">Foto:</label>
            <input type="file" name="image" required>
            
            <button type="submit">Update Berita</button>
        </form>
    </div>
</body>
</html>