<?php include('../config/constants.php'); ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    
    // Verifico que el email no esté vacío y sea válido
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, ingrese un correo electrónico válido.";
    }


    // Compruebo si el correo electrónico está en la base de datos
    $sql = "SELECT id FROM tbl_admin WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Generar un token seguro
        $token = bin2hex(random_bytes(50));
        
        // Guardo el token en la base de datos con un tiempo de expiración
        $sql = "INSERT INTO tbl_password (email, token, expires) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $token);
        if ($stmt->execute()) {
            // Enviar un correo electrónico al usuario con el enlace para la contraseña
            $reset_link = "update-password.php?token=" . $token;
            $subject = "Recupera tu contraseña";
            $message = "Aquí tienes para restablecer tu contraseña: " . $reset_link;
            $headers = "From: no-reply@rbburger.com";

            if (mail($email, $subject, $message, $headers)) {
                echo "Se ha enviado un correo electrónico para recuperar tu contraseña.";
            } else {
                echo "Hubo un error al enviar el correo electrónico.";
            }
        } else {
            echo "Hubo un error con la solicitud.";
        }
    } else {
        echo "No existe una cuenta con ese correo electrónico.";
    }

    $stmt->close();
    $conn->close();
}
?>
