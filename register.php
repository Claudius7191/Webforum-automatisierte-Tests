<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
        INSERT INTO `users` (username, email, password_hash)
        VALUES (?, ?, ?)
    ");

    $stmt->execute([
        $_POST['username'],
        $_POST['email'],
        $passwordHash
    ]);

    echo "Registrierung erfolgreich!";
}
?>