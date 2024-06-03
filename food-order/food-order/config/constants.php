<?php
    ob_start();
    //Empieza la sesion
    session_start();

    //Esta pagina se crea por si se cambia el nombre de la base de datos no cambiarla en cada pagina

    //Crea una constante para no almacenar valores repetidos
    define('SITEURL', 'http://localhost/food-order/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD','');
    define('DB_NAME', 'food-order');

    //Ejecutamos Query y guardamos los datos en la base de datos
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Conexión Base de Datos //Mysql se conectara a nuestros datos usando las creedenciales, con  el host de localhost y los datos a recoger
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Seleciona la base de datos (food-order es el nombre de la tabla general phpmyadmin)


?>