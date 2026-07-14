<?php
require 'db.php';
session_start();

// TEST: Falls du noch kein Login hast
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1; // Testuser
}

if (!isset($_GET['category_id'])) {
    die("Keine Kategorie!");
}

$category_id = $_GET['category_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $stmt = $pdo->prepare("
        INSERT INTO thread (title, created_by, category_id, created_at)
        VALUES (?, ?, ?, datetime('now'))
    ");

    $stmt->execute([
        $_POST['title'],
        $_SESSION['user_id'],
        $category_id
    ]);

    // 👉 WICHTIG: zurück zur Kategorie
    header("Location: training.php?id=" . $category_id);
    exit;
}
?>

<h1>Neues Thema erstellen</h1>

<form method="POST">
    <input type="text" name="title" placeholder="Titel" required>
    <button type="submit">Erstellen</button>
</form>
