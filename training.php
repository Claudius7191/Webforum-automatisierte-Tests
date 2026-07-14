<?php
require 'db.php';

if (!isset($_GET['id'])) {
    die("Keine Kategorie ausgewählt");
}

$category_id = $_GET['id'];

// Kategorie laden
$stmt = $pdo->prepare("SELECT * FROM category WHERE category_id = ?");
$stmt->execute([$category_id]);
$category = $stmt->fetch();

if (!$category) {
    die("Kategorie nicht gefunden!");
}

// Threads laden
$stmt = $pdo->prepare("
    SELECT thread.*, users.username 
    FROM thread
    JOIN users ON thread.created_by = users.user_id
    WHERE category_id = ?
    ORDER BY created_at DESC
");
$stmt->execute([$category_id]);
$threads = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($category['name']); ?></title>

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

    .header h1 {
      margin: 0;
      font-size: 22px;
    }

    .header p {
      margin: 0;
      font-size: 12px;
      opacity: 0.7;
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
      grid-template-columns: 2fr 1fr 1fr;
      padding: 15px 20px;
      border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .forum-row:hover {
      background: rgba(255,255,255,0.03);
    }

    .forum-head {
      background: #1a1a24;
      font-weight: bold;
    }

    .small {
      font-size: 12px;
      opacity: 0.7;
    }

    a {
      color: white;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    .btn-custom {
      background: #2d6cdf;
      border: none;
      padding: 10px 15px;
      border-radius: 8px;
      color: white;
    }

    .btn-custom:hover {
      background: #1f4fa8;
    }
  </style>
</head>

<body>

<div class="header">
  <h1>Box-Community Forum</h1>
  <p>Vereinsübergreifende Plattform für Boxer und Boxvereine</p>
</div>

<div class="container-box">

  <h2><?php echo htmlspecialchars($category['name']); ?></h2>

  <a href="create_thread.php?category_id=<?php echo $category_id; ?>" class="btn-custom mb-3">
    ➕ Neues Thema erstellen
  </a>

  <div class="forum-table">

    <div class="forum-row forum-head">
      <div>Thema</div>
      <div>Autor</div>
      <div>Datum</div>
    </div>

    <?php if(empty($threads)): ?>
      <div class="forum-row">
        <div colspan="3" class="small">Noch keine Themen vorhanden.</div>
      </div>
    <?php else: ?>
      <?php foreach($threads as $thread): ?>
        <div class="forum-row">
          <div>
            <a href="thread.php?id=<?php echo $thread['thread_id']; ?>">
              <?php echo htmlspecialchars($thread['title']); ?>
            </a>
          </div>

          <div><?php echo htmlspecialchars($thread['username']); ?></div>

          <div class="small"><?php echo $thread['created_at']; ?></div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>

  </div>

</div>

</body>
</html>