<?php session_start(); ?>

<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BoxCommunity</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-image: url('wallpaper.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      min-height: 100vh;
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .overlay {
      background: rgba(0, 0, 0, 0.6);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: white;
      padding: 2rem;
    }

    /* Navbar */
    .navbar {
      background: transparent;
    }

    .navbar .nav-link {
      color: white !important;
      margin-left: 15px;
    }

    .navbar .nav-link:hover {
      text-decoration: underline;
    }

    /* Karten */
    .menu-card {
      background: rgba(255, 255, 255, 0.08);
      border-radius: 15px;
      backdrop-filter: blur(10px);
      transition: all 0.3s ease;
      height: 100%;
      padding: 20px;
    }

    .menu-card:hover {
      transform: translateY(-6px);
      background: rgba(255, 255, 255, 0.15);
    }

    .menu-card h5 {
      font-weight: bold;
      margin-bottom: 10px;
    }

    .menu-card p {
      font-size: 0.9rem;
      opacity: 0.85;
    }

    .icon {
      font-size: 2rem;
      margin-bottom: 10px;
    }

    /* Buttons */
    .btn-custom {
      border-radius: 10px;
      padding: 10px 20px;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand text-white fw-bold" href="#">BoxCommunity</a>

      <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        ☰
      </button>

      <div class="mt-5">
        <?php if (isset($_SESSION['user_id'])): ?>

          <p>Willkommen, <b><?php echo $_SESSION['username']; ?></b> 👋</p>

          <a href="categories.php" class="btn btn-light btn-custom me-3">
            Zum Forum
          </a>

          <a href="logout.php" class="btn btn-outline-light btn-custom">
            Logout
          </a>

        <?php else: ?>



        <?php endif; ?>
      </div>
    </div>
  </nav>

  <!-- Hauptbereich -->
  <section class="overlay">
    <div class="container">

      <h1 class="mb-3 fw-bold">BoxCommunity</h1>
      <p class="mb-5">Die vereinsübergreifende Plattform für Boxer</p>

      <div class="row justify-content-center g-4">

        <div class="col-md-3">
          <div class="menu-card">
            <div class="icon">💪</div>
            <h5>Trainingsmethoden</h5>
            <p>Austausch über Techniken, Übungen und Trainingspläne</p>
          </div>
        </div>

        <div class="col-md-3">
          <div class="menu-card">
            <div class="icon">🤝</div>
            <h5>Sparring & Events</h5>
            <p>Organisation von Sparring Sessions und gemeinsamen Veranstaltungen</p>
          </div>
        </div>

        <div class="col-md-3">
          <div class="menu-card">
            <div class="icon">🏆</div>
            <h5>Wettkämpfe</h5>
            <p>Infos zu Wettkämpfen, Ergebnissen und Erfahrungen</p>
          </div>
        </div>

        <div class="col-md-3">
          <div class="menu-card">
            <div class="icon">🥊</div>
            <h5>Boxequipment</h5>
            <p>Das Beste Equipment für dein Training</p>
          </div>
        </div>

      </div>

      <!-- Buttons -->
      <div class="mt-5">
        <a href="register.html" class="btn btn-light btn-custom me-3">
          Jetzt registrieren
        </a>

        <a href="login.html" class="btn btn-outline-light btn-custom">
          Anmelden
        </a>
      </div>

      <!-- Stats -->
      <div class="row mt-5 text-center">
        <div class="col">
          <h4>250+</h4>
          <small>Mitglieder</small>
        </div>
        <div class="col">
          <h4>45</h4>
          <small>Vereine</small>
        </div>
        <div class="col">
          <h4>1.200+</h4>
          <small>Beiträge</small>
        </div>
      </div>

    </div>
  </section>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>