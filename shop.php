<?php
require __DIR__ . '/db.php';
session_start();

/* PRODUKTE LADEN */
$stmt = $pdo->query("
    SELECT 
        p.product_id,
        p.name,
        p.description,
        p.price,
        p.stock,
        p.image,
        c.name AS category_name
    FROM product p
    LEFT JOIN category c ON p.category_id = c.category_id
");

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Boxequipment Shop</title>

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
            margin-bottom: 30px;
        }

        .grid {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        .card {
            width: 220px;
            background: #1e1e1e;
            border: 1px solid #333;
            padding: 15px;
            border-radius: 10px;
        }

        .price {
            font-weight: bold;
            margin-top: 10px;
        }

        .category {
            font-size: 12px;
            color: #aaa;
        }

        button {
            margin-top: 10px;
            width: 100%;
            padding: 8px;
            border: none;
            background: #28a745;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background: #218838;
        }

        input {
            width: 50px;
        }
    </style>
</head>

<body>

    <h1>🥊 Boxequipment Shop</h1>

    <?php if (empty($products)): ?>
        <p style="text-align:center; color:red;">
            Keine Produkte gefunden. (DB ist leer)
        </p>
    <?php endif; ?>

    <div class="grid">

        <?php foreach ($products as $p): ?>
            <div class="card">

                <h3><?= htmlspecialchars($p['name']) ?></h3>

                <p><?= htmlspecialchars($p['description']) ?></p>

                <div class="price"><?= $p['price'] ?> €</div>

                <div class="category">
                    <?= htmlspecialchars($p['category_name'] ?? 'Ohne Kategorie') ?>
                </div>

                <form method="POST" action="add_to_cart.php">

                    <input type="hidden" name="product_id" value="<?= $p['product_id'] ?>">

                    <label>Menge:</label>

                    <input type="number" name="quantity" value="1" min="1">

                    <button id="add-cart" type="submit">
                        🛒 In den Warenkorb
                    </button>

                </form>

            </div>
        <?php endforeach; ?>

    </div>

</body>

</html>