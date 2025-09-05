<?php

//Genera el token para el reinicio de contraseña, le pone tiempo de vencimiento y envía el mail al usuario

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

require __DIR__ . "/connection.php";

$sql = "UPDATE users
        SET reset_token_hash = ?,
        reset_token_expires_at = ?
        WHERE email = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

if($conn->affected_rows){
        $mail = require __DIR__ . "/mailer.php";

        $mail->setFrom("noreply@example.com");
        $mail->addAddress($email);
        $mail->Subject = "Reinicio de clave";
        $mail->Body = <<<END

        Ingresá en <a href="http://localhost:3000/reset-password.php?token=$token">este link</a>
        para reiniciar tu contraseña.

        END;

        try{
                $mail->send();
        } catch (Exception $e) {
                echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
        }
}

header("Location: password-reset-mail-sent.php");
exit; 