<?php
if (isset($_POST['submit'])) {
  include "connection.php";
  $userName = $_POST['userName'];
  $userLastname = $_POST['userLastname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmpassword = $_POST['confirmpassword'];
  $userType = 'Cliente';

  $sql = "SELECT * FROM users WHERE email='$email' ";
  $result = mysqli_query($conn, $sql);
  $count_email = mysqli_num_rows($result);

  if ($count_email == 0) {
    if ($password == $confirmpassword) {
      $hash = password_hash($password, PASSWORD_DEFAULT);

      $email = mysqli_real_escape_string($conn, $email);
      $userName = mysqli_real_escape_string($conn, $userName);
      $userLastname = mysqli_real_escape_string($conn, $userLastname);
      $userType = mysqli_real_escape_string($conn, $userType);

      $sql = "INSERT INTO users(email, password, userName, userLastname, userType) VALUES ('$email', '$hash', '$userName', '$userLastname', '$userType')";
      $result = mysqli_query($conn, $sql);

      //toda esta parte de alert hay que cambiarla
      if ($result) {
        echo "<script>alert('Usuario registrado con éxito'); window.location.href = 'index.php';</script>";
      } else {
        echo "<script>alert('Error al registrar');</script>";
      }
    } else {
      echo '<script>alert("Las contraseñas no coinciden"); window.location.href = "register.php";</script>';
    }
  } else {
    echo '<script>alert("El mail ya está registrado"); window.location.href = "index.php";</script>';
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
    <h1>Registrarse</h1>
    <form action="register.php" name="form" method="POST">
      <label>Ingrese nombre</label>
      <input type="text" id="userName" name="userName" required><br><br>
      <label>Ingrese apellido</label>
      <input type="text" id="userLastname" name="userLastname" required><br><br>
      <label>Ingrese email</label>
      <input type="email" id="email" name="email" required><br><br>
      <label>Ingrese contraseña</label>
      <input type="password" id="password" name="password" required><br><br>
      <label>Confirmar contraseña</label>
      <input type="password" id="confirmpassword" name="confirmpassword" required><br><br>
      <input type="submit" id="btn" value="Confirmar" name="submit">
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>