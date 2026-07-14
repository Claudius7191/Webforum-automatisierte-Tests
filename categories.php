<?php
require 'db.php';

// Kategorien aus DB laden
$stmt = $pdo->query("SELECT * FROM category");
$categories = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BoxCommunity – Kategorien</title>

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
      text-align: left;
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
      grid-template-columns: 2fr 1fr 2fr;
      padding: 15px 20px;
      align-items: center;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
      transition: 0.2s;
    }

    .forum-row:hover {
      background: rgba(255, 255, 255, 0.03);
    }

    .forum-head {
      background: #1a1a24;
      font-weight: bold;
    }

    .category {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .icon {
      width: 35px;
      height: 35px;
      background: rgba(255, 255, 255, 0.08);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
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

    .stats-boxes {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      margin-top: 30px;
    }

    .stat {
      background: #12121a;
      padding: 20px;
      border-radius: 10px;
    }

    .shop-banner {
      background: linear-gradient(135deg, #8B0000, #111);
      border-radius: 15px;
      padding: 35px;
      margin-bottom: 35px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, .4);
    }

    .shop-banner h2 {
      font-size: 36px;
      font-weight: bold;
      margin-bottom: 15px;
    }

    .shop-banner p {
      font-size: 18px;
      color: #ddd;
      margin-bottom: 20px;
    }

    .shop-image {
      max-width: 230px;
      transition: .3s;
    }

    .shop-image:hover {
      transform: scale(1.08);
    }
  </style>
</head>

<body>

  <div class="header">
    <h1>Box-Community Forum</h1>
    <p>Vereinsübergreifende Plattform für Boxer und Boxvereine</p>
  </div>



  <div class="container-box">
    <div class="shop-banner mb-4">
      <div class="row align-items-center">

        <div class="col-md-8">
          <h2>🥊 Neu: Box-Shop eröffnet!</h2>
          <p>
            Entdecke hochwertige Boxhandschuhe, Bandagen, Kleidung und
            weiteres Equipment für dein Training.
          </p>
          <a id="shop-link" href="shop.php" class="btn btn-warning btn-lg">
            🛒 Jetzt zum Shop
          </a>
        </div>

        <div class="col-md-4 text-center">
          <img src="images/boxhandschuhe.png" class="shop-image" alt="Boxhandschuhe">
        </div>

      </div>
    </div>

    <div class="forum-table">

      <div class="forum-row forum-head">
        <div>Kategorie</div>
        <div>Themen</div>
        <div>Letzter Beitrag</div>
      </div>

      <!-- DYNAMISCHE KATEGORIEN -->
      <?php foreach ($categories as $cat): ?>
        <div class="forum-row">
          <div class="category">
            <div class="icon"><?php echo $cat['icon']; ?></div>
            <div>
              <a href="training.php?id=<?php echo $cat['category_id']; ?>">
                <b><?php echo htmlspecialchars($cat['name']); ?></b>
              </a><br>
              <span class="small"><?php echo htmlspecialchars($cat['description']); ?></span>
            </div>
          </div>

          <div>
            <!-- Optional später dynamisch -->
            -
          </div>

          <div>
            <!-- Optional später dynamisch -->
            -
          </div>
        </div>
      <?php endforeach; ?>

    </div>

    <!-- Stats -->
    <div class="stats-boxes">

      <div class="stat">
        <h5>👥 Online Mitglieder</h5>
        <p>42 Mitglieder online</p>
        <small>256 registrierte Mitglieder</small>
      </div>

      <div class="stat">
        <h5>📊 Statistiken</h5>
        <p>545 Themen</p>
        <small>4.455 Beiträge gesamt</small>
      </div>

      <div class="stat">
        <h5>📅 Nächste Events</h5>
        <p>Lehrgang: 15. Apr 2026</p>
        <small>Sommerfest: 20. Juni 2026</small>
      </div>

    </div>

  </div>

</body>

</html>