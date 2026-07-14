<?php

require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE email = ?");
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($_POST['password'], $user['password_hash'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];

        //  Weiterleitung nach Login
        header("Location: categories.php");
        exit;

    } else {
        echo "Falsche Zugangsdaten!";
    }
}
?>