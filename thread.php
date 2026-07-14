<?php
require 'db.php';

if (!isset($_GET['id'])) {
    die("Kein Thread ausgewählt");
}

$thread_id = $_GET['id'];

// Thread laden
$stmt = $pdo->prepare("
    SELECT thread.*, users.username 
    FROM thread
    JOIN users ON thread.created_by = users.user_id
    WHERE thread.thread_id = ?
");
$stmt->execute([$thread_id]);
$thread = $stmt->fetch();

if (!$thread) {
    die("Thread nicht gefunden!");
}

// Posts laden
$stmt = $pdo->prepare("
    SELECT post.*, users.username 
    FROM post
    JOIN users ON post.created_by = users.user_id
    WHERE thread_id = ?
    ORDER BY created_at ASC
");
$stmt->execute([$thread_id]);
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($thread['title']); ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: #0b0b12;
      color: white;
      font-family: Arial, sans-serif;
    }

    .header {
      background: #070712;
      padding: 20px;
    }

    .container-box {
      max-width: 1100px;
      margin: auto;
      padding: 30px;
    }

    .forum-table {
      background: #12121a;
      border-radius: 10px;
      overflow: hidden;
    }

    .forum-row {
      display: grid;
      grid-template-columns: 3fr 1fr 1fr;
      padding: 15px 20px;
      border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .forum-head {
      background: #1a1a24;
      font-weight: bold;
    }

    .small {
      font-size: 12px;
      opacity: 0.7;
    }

    textarea {
      background: #12121a;
      color: white;
      border: 1px solid rgba(255,255,255,0.1);
    }

    textarea:focus {
      background: #12121a;
      color: white;
      border-color: #555;
    }

    a {
      color: white;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>

<div class="header">
  <h1>Box-Community Forum</h1>
  <p>Vereinsübergreifende Plattform für Boxer und Boxvereine</p>
</div>

<div class="container-box">

  <!-- Thread Titel -->
  <h2><?php echo htmlspecialchars($thread['title']); ?></h2>
  <p class="small">erstellt von <?php echo htmlspecialchars($thread['username']); ?></p>

  <!-- Beitrag schreiben -->
  <form action="create_post.php" method="POST" class="mb-4">
    <input type="hidden" name="thread_id" value="<?php echo $thread_id; ?>">
    
    <textarea name="content" class="form-control mb-2" placeholder="Dein Beitrag..." required></textarea>
    
    <button type="submit" class="btn btn-success">Antworten</button>
  </form>

  <!-- Beiträge -->
  <div class="forum-table">

    <div class="forum-row forum-head">
      <div>Beitrag</div>
      <div>Autor</div>
      <div>Datum</div>
    </div>

    <?php foreach($posts as $post): ?>
      <div class="forum-row">
        <div><?php echo nl2br(htmlspecialchars($post['content'])); ?></div>
        <div><?php echo htmlspecialchars($post['username']); ?></div>
        <div class="small"><?php echo $post['created_at']; ?></div>
      </div>
    <?php endforeach; ?>

  </div>

</div>

</body>
</html>