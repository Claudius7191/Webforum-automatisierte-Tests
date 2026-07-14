<?php
require 'db.php';

$stmt = $pdo->prepare("
    SELECT t.*, u.username
    FROM thread t
    JOIN user u ON t.created_by = u.user_id
    WHERE category_id = ?
");

$stmt->execute([$_GET['category_id']]);

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>