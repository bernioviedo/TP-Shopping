<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = "";
if (isset($_POST['submit'])) {
  include "connection.php";
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $sql = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($conn, $sql);

  if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
  }

  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

  if ($row) {
    if (password_verify($password, $row["password"])) {
      $sql = "SELECT userName FROM users WHERE email = '$email'";
      $r = mysqli_fetch_array(mysqli_query($conn, $sql));
      session_start();
      $_SESSION['user'] = $row['email'];
      $_SESSION['userName'] = $row['userName'];

      header("Location: index.php");
    } else {
      $error = "Email o contraseña inválida";
    }
  } else {
    $error = "Email o contraseña inválida";
  }
}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shopping</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<body>
  <?php
  include "navbar.php";
  ?>
  <div id="form">
    <h1>Iniciar sesión</h1>
    <form action="login.php" name="form" method="POST">
      <label>Ingrese email</label>
      <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email ?? ''); ?>"><br><br>
      <label>Ingrese contraseña</label>
      <input type="password" id="password" name="password" required><br><br>
      <?php if (!empty($error)): ?>
        <div class="text-danger"><?php echo $error; ?></div>
      <?php endif; ?>
      <input type="submit" id="btn" value="Iniciar sesión" name="submit">
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>