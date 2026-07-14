<?php
session_start();
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestellung erfolgreich</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #111;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            background: #1e1e1e;
            padding: 50px;
            border-radius: 12px;
            text-align: center;
            width: 500px;
            box-shadow: 0 0 20px rgba(0,0,0,.5);
        }

        h1 {
            color: #28a745;
            margin-bottom: 20px;
        }

        p {
            color: #ccc;
            font-size: 18px;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
        }

        .btn:hover {
            background: #218838;
        }
    </style>

</head>

<body>

    <div class="box">

        <h1>✅ Vielen Dank für deinen Einkauf!</h1>

        <p>
            Deine Bestellung wurde erfolgreich abgeschlossen.
            <br><br>
            Wir wünschen dir viel Erfolg beim Training! 🥊
        </p>

        <a href="shop.php" class="btn">
            Zurück zum Shop
        </a>

    </div>

</body>

</html>