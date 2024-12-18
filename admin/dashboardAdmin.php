<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="admin/style.css"> 
</head>
<body>
    <div class="container">
        <h1>Dashboard Admin</h1>
        <a href="tambahBerita" class="btn">Tambah Berita</a>
        <a href="register" class="btn">Tambah User</a>
        
        <h2>Daftar Berita</h2>
        <table>
            <thead>
                <tr>
                    <th>Judul Berita</th>
                    <th>Tanggal Publish</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'db.php'; 
                $db = getDB(); 
                $collection = $db->posts; 

                $newsCursor = $collection->find();

                foreach ($newsCursor as $news) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($news['title']) . "</td>";
                    echo "<td>" . $news['created_at']->toDateTime()->format('Y-m-d H:i:s') . "</td>";
                    echo "<td>" . htmlspecialchars($news['category']) . "</td>";
                    echo "<td>" . htmlspecialchars($news['author']) . "</td>";
                    echo "<td><img src='" . htmlspecialchars($news['image']) . "' alt='Image' style='max-width:100px; height:auto;'></td>";
                    echo "<td>
                            <a href='edit?id=" . $news['_id'] . "' class='btn'>Edit</a>
                            <a href='hapus?id=" . $news['_id'] . "' class='btn delete'>Hapus</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>