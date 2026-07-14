<?php
require 'db.php';

$stmt = $pdo->query("
    SELECT 
        c.category_id,
        c.name,
        c.description,
        COUNT(DISTINCT t.thread_id) as threads,
        COUNT(p.post_id) as posts
    FROM category c
    LEFT JOIN thread t ON t.category_id = c.category_id
    LEFT JOIN post p ON p.thread_id = t.thread_id
    GROUP BY c.category_id
");

$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($categories);
?>