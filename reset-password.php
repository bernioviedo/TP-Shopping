<?php

//comprueba que el token sea válido y presenta el form para que el usuario cambie su contraseña

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require  __DIR__ . "/connection.php";

$sql  = "SELECT * FROM users WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null){
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time() ){
    die("token has expired");
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reinicio de contraseña</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<body>

    <h1>Reinicio de contraseña</h1>
    <form method="post" action="process-reset-password.php">
        
        <input type="hidden" name="token" value="<?= htmlspecialchars($token)?>">
        
        <label for="password">Nueva contraseña</label>
        <input type="password" id="password" name="password"><br><br>
        
        <label for="password_confirmation">Confirmar contraseña</label>
        <input type="password" id="password_confirmation" name="password_confirmation"><br><br>

        <button>Enviar</button>
    </form>

</body>
</html>