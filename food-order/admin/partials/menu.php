<?php  
include('../config/constants.php');  //Este include se incluye aqui ya que el menu esta incluido en todas las paginas y esto tambien ha de estar en todas las paginas -->
include('login-check.php');
?>

<html>
    <head>
        <title>Web Restaurante con Pedidos </title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="shortcut icon" href="../images/logo.ico" />

    </head>

    <body>
        <!-- Menu Sección  -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="manage-admin.php">Administrador</a></li>
                    <li><a href="manage-category.php">Categorias</a></li>
                    <li><a href="manage-food.php">Comida</a></li>
                    <li><a href="manage-order.php">Pedido</a></li>
                    <li><a href="logout.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
        <!-- Fin Menu Sección-->
    
    </body>
</html>