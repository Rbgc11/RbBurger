<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Inicio</h1>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <!-- El login empieza aquí -->
            <form action="" method="POST" class="text-center">
                Usuario: <br>
                <input type="text" name="username" placeholder="Escribe el Usuario"><br><br>

                Contraseña: <br>
                <input type="password" name="password" placeholder="Escribe la Contraseña"> <br><br>    

                <input type="submit" name="submit" value="Entrar" class="btn-primary">

                <br><br>
            </form>
            <!-- El login termina aquí -->
            <p class="text-center">Creado por Rubén García Caparrós</p>
        </div>


    </body>
</html>

<?php

    //Verificamos si se pulsa el boton de enviar o no
    if(isset($_POST['submit']))
    {
        //Proceso para el Login
        //1. Conseguimos los Datos del Formulario del Login
        //$username = $_POST['username'];
        //$password = md5($_POST['password']);

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);


        //2. Verificamos si el usuario con su usuario y contraseña existe o no
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Ejecutamos la sentencia
        $res = mysqli_query($conn, $sql);

        //4. Contamos las filas para verificar si el usuario existe o no
        $count =mysqli_num_rows($res);

        if($count==1)
        {
            //Usuario Disponible y Login exitoso
            $_SESSION['login'] = "<div class='success'>Login Exitoso.</div>";
            $_SESSION['user'] = $username; //Verificamos si el usuario inició sesión o no y el cierre de sesión se desactivará.
            //Redirigimos al Inicio
            header('location:'.SITEURL.'admin/');

        }
        else
        {
            //Usuario No Disponible y Login fallido
            $_SESSION['login'] = "<div class='error text-center'>Usuario o Contraseña No Coinciden.</div>";
            //Redirigimos al Inicio
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>