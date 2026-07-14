<?php

try {
    $pdo = new PDO("sqlite:" . __DIR__ . "/forum.db");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Datenbankfehler: " . $e->getMessage());
}

?>