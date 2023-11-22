<?php 
    //Autorización - Control de Acceso
    //Verificamos si el usuario ha iniciado sesión o no
    if(!isset($_SESSION['user'])) //Si el sistema de usuario no está configurado 
    {
        //Usuario no ha iniciado sesión
        //Redirigimos al login con un mensaje
        $_SESSION['no-login-message'] = "<div class='error text-center'>Por favor, inicie sesión</div>";
        //Redirigimos al login
        header('location:'.SITEURL.'login-user.php');
        exit();
    }
?>