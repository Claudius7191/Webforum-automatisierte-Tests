<?php
require_once 'db.php';

$user_id = 1;

// Order erstellen
$stmt = $pdo->prepare("INSERT INTO orders (user_id, created_at) VALUES (?, datetime('now'))");
$stmt->execute([$user_id]);

$order_id = $pdo->lastInsertId();

// Items aus Warenkorb übernehmen
$stmt = $pdo->prepare("
SELECT ci.*, p.price
FROM cart_item ci
JOIN cart c ON ci.cart_id = c.cart_id
JOIN product p ON ci.product_id = p.product_id
WHERE c.user_id = ?
");

$stmt->execute([$user_id]);
$items = $stmt->fetchAll();

foreach ($items as $item) {
    $stmt = $pdo->prepare("
        INSERT INTO order_item (order_id, product_id, quantity, price)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([
        $order_id,
        $item['product_id'],
        $item['quantity'],
        $item['price']
    ]);
}

// Warenkorb leeren
$stmt = $pdo->prepare("
DELETE FROM cart_item 
WHERE cart_id IN (SELECT cart_id FROM cart WHERE user_id = ?)
");
$stmt->execute([$user_id]);

echo "Bestellung abgeschlossen 🥊";