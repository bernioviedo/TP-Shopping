<?php

//conexion a la base de datos

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "shopping";
$conn = new mysqli($servername, $username, $password, $db_name, 3308);
if ($conn->connect_error) {
  die("Connection failed" . $conn->connect_error);
}

return $conn;