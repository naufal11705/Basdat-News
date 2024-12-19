<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = getDB();
    $collection = $db->users;

    $newUsers = [
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'role' => 'users',
        'created_at' => new MongoDB\BSON\UTCDateTime(),
        'updated_at' => new MongoDB\BSON\UTCDateTime(),
    ];

    $insertResult = $collection->insertOne($newUsers);

    header("Location: ../Basdat-News/");
    exit();

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin/style.css">
    <title>Tambah User</title>
</head>

<body>
    <div class="container">
        <h1>Tambah User</h1>
        <form method="POST" enctype="multipart/form-data">
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="text" name="password" required>

            <button type="submit">Simpan User</button>
        </form>
    </div>
</body>

</html>