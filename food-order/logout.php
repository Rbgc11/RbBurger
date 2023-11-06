
<?php 
    //Se incluye constants.php para la URL
    include('config/constants.php'); 
    //1. Eliminamos la Sesión 
    session_destroy(); //Desplazamos $_SESSION['users']   --

    //2. Redirigimos al Login
    header('location:'.SITEURL.'login-user.php');
?>