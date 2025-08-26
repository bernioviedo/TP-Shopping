<?php
session_start();
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
      </ul>
    </div>
    <form class="d-flex">
      <?php if (!isset($_SESSION['userName'])): ?>
        <a class="btn btn-primary me-2" type="button" href="login.php">Iniciar sesión</a>
        <a class="btn btn-success me-2" type="button" href="register.php">Registrarse</a>
      <?php else: ?>
        <a class="btn btn-primary me-2" type="button" href="profile.php">Perfil</a>
        <a class="btn btn-danger me-2" type="button" href="logout.php">Cerrar sesión</a>
      <?php endif; ?>
    </form>
  </div>
</nav>