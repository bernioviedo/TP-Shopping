<!-- página de ¿olvidaste tu contraseña? -->
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recuperar contraseña</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<body>
  <?php
  include "navbar.php";
  ?>
    <h1>Recupera la contraseña</h1>

    <form method="post" action="send-password-reset.php">
        <label for="email">Ingrese su email </label>
        <input type="email" name="email" id="email"><br><br>

        <input type="submit" id="btn" value="Enviar" name="submit">
    </form>
</body>