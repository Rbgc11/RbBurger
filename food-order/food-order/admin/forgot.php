<?php  
include('../config/constants.php');
?>

<html>
<!-- Se crea aquí un head porque no debe de tener la barra de navegación del menú, ya que esto se encuentra tras acceder -->
<head>
    <link rel="stylesheet" href="../css/admin.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 

</head>
<body>
<!-- Creación del formulario -->
<div class="container">  
    <h3 class="text-center">Recuperar Contraseña</h3><br/>
    <form id="validate_form" action="password-reset.php" method="post">
        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>
        <input type="submit" id="login" value="Enviar Enlace de recuperación" class="btn-primary" />


        <a class="btn-secondary" href="login.php">Volver al Inicio</a>  




    </form>
</div>
</body>
</html>