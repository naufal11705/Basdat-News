<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = getDB();
    $collection = $db->categories; 

    $insertResult = $collection->insertOne([ 
        'name' => $_POST['name'],
        'created_at' => new MongoDB\BSON\UTCDateTime(),
        'updated_at' => new MongoDB\BSON\UTCDateTime(),
    ]);
    header("Location: index.php"); 
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <title>Tambah Kategori</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <h2>Tambah Kategori</h2>
    <form method="post">
        <label for="name">Nama Kategori:</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">Tambah</button>
    </form>
</body>
</html>
