<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="../css/admin.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 

</head>
<body>
<div class="container">  
    <h2>Restablecer Contraseña</h2>
    <?php if (!empty($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="resetear_contrasena.php?token=<?php echo htmlspecialchars($token); ?>" method="post">
        <label for="new_password">Nueva Contraseña:</label>
        <input type="password" id="new_password" name="new_password" required>
        <br>
        <label for="confirm_password">Confirmar Nueva Contraseña:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br> <br>
        <input type="submit" value="Restablecer Contraseña" class="btn-primary" />
    </form>
    <br>
    <a class="btn-secondary" href="login.php">Volver al Inicio</a>  

    </div>

</body>
</html>

<?php
$token = $_GET['token'];
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    if (empty($new_password) || empty($confirm_password)) {
        $error = "Por favor, completa los datos.";
    } elseif ($new_password !== $confirm_password) {
        $error = "Las contraseñas no coinciden.";
    } else {
        
        //Se comprueba si el token y la expiración es correcto
        $sql = "SELECT email FROM tbl_password WHERE token = ? AND expires > NOW()";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($email);
            $stmt->fetch();
            
            // Actualiza la contraseña del usuario
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $sql = "UPDATE tbl_admin SET password = ? WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $hashed_password, $email);

            if ($stmt->execute()) {
                // Eliminar el token después de usarlo
                $sql = "DELETE FROM tbl_password WHERE token = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $token);
                $stmt->execute();

                echo "Tu contraseña ha sido restablecida con éxito.";
            } else {
                $error = "Hubo un error al actualizar la contraseña.";
            }
        } else {
            $error = "El token es inválido o ha expirado.";
        }
    }
}
?>


<?php
$stmt->close();
$conn->close();
?>
