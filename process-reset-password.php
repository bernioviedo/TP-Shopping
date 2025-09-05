<?php

//Cambia la contraseña en la base de datos

$token = $_POST["token"];

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


if($_POST["password"] !== $_POST["password_confirmation"]){
    die("Las contraseñas no coinciden");
}

$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql = "UPDATE users SET password = ?,
                    reset_token_hash = NULL,
                    reset_token_expires_at = NULL
        WHERE id = ?";


$stmt = $mysqli->prepare($sql);

$stmt->bind_param("si", $password, $user["id"]);

$stmt->execute();

header("Location: password-reset-success.php");
exit; 
?>