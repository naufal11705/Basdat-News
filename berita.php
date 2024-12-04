<?php
require 'vendor/autoload.php';
require 'db.php';

$db = getDB();
$posts = $db->posts->find();

function generateSlug($title) {
    return strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', trim($title)));
}

if (isset($_SERVER['REQUEST_URI'])) {
    $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $slug = basename($urlPath);

    foreach ($posts as $item) {
        if (generateSlug($item['title']) === $slug) {
            $post = $item;
            break;
        }
    }

    if ($post) {
        echo "<h1>" . htmlspecialchars($post['title']) . "</h1>";
        echo "<p>" . nl2br(htmlspecialchars($post['content'])) . "</p>";
    } else {
        echo "Berita tidak ditemukan.";
    }
} else {
    echo "Slug tidak diberikan.";
}
