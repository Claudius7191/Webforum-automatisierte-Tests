<?php
require 'db.php';
session_start();

// TESTUSER (falls kein Login)
$_SESSION['user_id'] = 1;

// 🔥 WICHTIG: POST prüfen (nicht GET!)
if (!isset($_POST['thread_id'])) {
    die("Kein Thread!");
}

$thread_id = $_POST['thread_id'];

$stmt = $db->prepare("
    INSERT INTO post (content, created_by, thread_id)
    VALUES (?, ?, ?)
");

$stmt->execute([
    $_POST['content'],
    $_SESSION['user_id'],
    $thread_id
]);

// zurück zum Thread
header("Location: thread.php?id=" . $thread_id);
exit;