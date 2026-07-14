<?php
require 'db.php';
session_start();

$user_id = 1; // später Login-System

$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Warenkorb holen oder erstellen
$stmt = $pdo->prepare("SELECT cart_id FROM cart WHERE user_id = ?");
$stmt->execute([$user_id]);
$cart = $stmt->fetch();

if (!$cart) {
    $stmt = $pdo->prepare("INSERT INTO cart (user_id) VALUES (?)");
    $stmt->execute([$user_id]);
    $cart_id = $pdo->lastInsertId();
} else {
    $cart_id = $cart['cart_id'];
}

// Produkt hinzufügen
$stmt = $pdo->prepare("
    INSERT INTO cart_item (cart_id, product_id, quantity)
    VALUES (?, ?, ?)
");
$stmt->execute([$cart_id, $product_id, $quantity]);

header("Location: cart.php");