<?php
require 'db.php';
session_start();

$user_id = 1; // später: $_SESSION['user_id']

$stmt = $pdo->prepare("
    SELECT ci.*, p.name, p.price
    FROM cart_item ci
    JOIN cart c ON ci.cart_id = c.cart_id
    JOIN product p ON ci.product_id = p.product_id
    WHERE c.user_id = ?
");

$stmt->execute([$user_id]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 0;
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Warenkorb</title>

    <style>
        body {
            font-family: Arial;
            background: #111;
            color: white;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .cart {
            max-width: 700px;
            margin: auto;
        }

        .item {
            display: flex;
            justify-content: space-between;
            background: #1e1e1e;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 10px;
            border: 1px solid #333;
        }

        .left {
            display: flex;
            flex-direction: column;
        }

        .name {
            font-weight: bold;
        }

        .price {
            color: #aaa;
            font-size: 14px;
        }

        .total-box {
            text-align: center;
            margin-top: 20px;
            font-size: 20px;
        }

        .btn {
            display: block;
            text-align: center;
            margin-top: 20px;
            padding: 12px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        .btn:hover {
            background: #218838;
        }

        .summary {
            margin-top: 30px;
            background: #1e1e1e;
            border-radius: 10px;
            padding: 20px;
            border: 1px solid #333;
        }

        .summary h2 {
            margin-top: 0;
            margin-bottom: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }

        .total {
            font-size: 22px;
            font-weight: bold;
            color: #ffc107;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            gap: 15px;
        }

        .btn {
            flex: 1;
            text-align: center;
            padding: 15px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
        }

        .btn:hover {
            background: #218838;
        }

        .btn-secondary {
            flex: 1;
            text-align: center;
            padding: 15px;
            background: #444;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
        }

        .btn-secondary:hover {
            background: #666;
        }

        .remove-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
        }

        .remove-btn:hover {
            background: #bb2d3b;
        }

        .empty-cart {
            text-align: center;
            padding: 50px;
        }
    </style>
</head>

<body>

    <h1>🛒 Dein Warenkorb</h1>

    <div class="cart">

        <?php if (empty($items)): ?>
            <div class="empty-cart">
                <h2>🛒 Dein Warenkorb ist leer</h2>
                <p>Lege zunächst Produkte in deinen Warenkorb.</p>
                <a href="shop.php" class="btn-secondary">Zum Shop</a>
            </div>
        <?php endif; ?>

        <?php foreach ($items as $item):
            $sum = $item['price'] * $item['quantity'];
            $total += $sum;
            ?>

            <div class="item">

                <div class="left">
                    <div class="name"><?= htmlspecialchars($item['name']) ?></div>

                    <div class="price">
                        Einzelpreis:
                        <b><?= number_format($item['price'], 2) ?> €</b>
                    </div>

                    <div class="price">
                        Menge:
                        <?= $item['quantity'] ?>
                    </div>

                    <div class="price">
                        Zwischensumme:
                        <b><?= number_format($sum, 2) ?> €</b>
                    </div>

                    <div style="margin-top:12px;">
                        <button class="remove-btn">
                            🗑 Entfernen
                        </button>
                    </div>

                </div>

            </div>

        <?php endforeach; ?>

        <?php if (!empty($items)): ?>

            <div class="summary">

                <h2>Bestellübersicht</h2>

                <div class="summary-row">
                    <span>Zwischensumme</span>
                    <span><?= number_format($total, 2) ?> €</span>
                </div>

                <div class="summary-row">
                    <span>Versand</span>
                    <span>Kostenlos</span>
                </div>

                <hr>

                <div class="summary-row total">
                    <span>Gesamt</span>
                    <span><?= number_format($total, 2) ?> €</span>
                </div>

            </div>

            <div class="buttons">

                <a href="shop.php" class="btn-secondary">
                    ← Weiter einkaufen
                </a>

                <a id="checkout-button" class="btn" href="success.php">
                    Kauf abschließen
                </a>

            </div>

        <?php endif; ?>

    </div>

</body>

</html>