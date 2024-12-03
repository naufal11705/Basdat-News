<?php
require 'db.php';
$db = getDB();
$collection = $db->posts;

$db = getDB();
$categoryCollection = $db->categories;
$categories = $categoryCollection->find();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = new MongoDB\BSON\ObjectId($_GET['id']);
    $post = $collection->findOne(['_id' => $id]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = new MongoDB\BSON\ObjectId($_POST['id']);
    $collection->updateOne(
        ['_id' => $id],
        ['$set' => [
            'title' => $_POST['title'], 
            'content' => $_POST['content'],
            'summary' => $_POST['summary'],
            'category' => $_POST['category']
        ]]
    );
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Postingan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Edit Postingan</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo
                                                $post['_id']; ?>">
        <input type="text" name="title" value="<?php echo
                                                htmlspecialchars($post['title']); ?>" required>
        <textarea name="content" required><?php echo
                                            htmlspecialchars($post['content']); ?></textarea>

        <textarea name="summary" required><?php echo htmlspecialchars($post['summary']); ?></textarea>

        <label for="category">Pilih Kategori:</label>
        <select name="category" id="category" required>
            <option value="">Pilih Kategori</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category['name']) ?>"
                    <?php echo ($post['category'] == $category['name']) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Perbarui</button>
    </form>
    <a href="index.php">Kembali ke Daftar Postingan</a>
</body>

</html>