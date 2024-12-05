<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard Admin</title>
</head>
<body>
    <div class="container">
        <h1>Dashboard Admin</h1>
        <a href="tambahBerita.php" class="btn">Tambah Berita</a>
        
        <h2>Daftar Berita</h2>
        <table>
            <thead>
                <tr>
                    <th>Judul Berita</th>
                    <th>Tanggal Publish</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require '../db.php'; 
                $db = getDB(); 
                $collection = $db->news; 

                $newsCursor = $collection->find();

                foreach ($newsCursor as $news) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($news['title']) . "</td>";
                    echo "<td>" . $news['date_published']->toDateTime()->format('Y-m-d H:i:s') . "</td>";
                    echo "<td>" . htmlspecialchars($news['category']) . "</td>";
                    echo "<td>" . htmlspecialchars($news['author']) . "</td>";
                    echo "<td>
                            <a href='edit.php?id=" . $news['_id'] . "' class='btn'>Edit</a>
                            <a href='hapus.php?id=" . $news['_id'] . "' class='btn delete'>Hapus</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>