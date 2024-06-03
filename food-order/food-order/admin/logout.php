
<?php 
    //Se incluye constants.php para la URL
    include('../config/constants.php'); 
    //1. Eliminamos la Sesión 
    session_destroy(); 

    //2. Redirigimos al Login
    header('location:'.SITEURL.'admin/login.php');
?>