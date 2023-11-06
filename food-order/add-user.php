<?php  include('partials-front/menu.php');  ?>




<head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="css/admin.css">
</head>
<div class="main-content">
    <div class="wrapper">
        <h1>Registro Usuario</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add']))  //Verificamos si la sesion esta configurada o no
            {
                echo $_SESSION['add'];  //Mostraremos el sistema de mensaje si lo esta
                unset($_SESSION['add']); //Eliminar el mensaje del sistema 
            }
        ?>
        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Nombre Completo: </td>
                    <td>
                        <input type="text" name="customer_name" placeholder="Escribe tu nombre" class="input-responsive" required>
                    </td>
                </tr>

                <tr>
                    <td>Usuario: </td>
                    <td><input type="text" name="username" placeholder="Escribe tu usuario" class="input-responsive" required></td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td><input type="text" name="customer_email" placeholder="Escribe tu email" class="input-responsive" required></td>
                </tr>
                <!--
                <tr>
                    <td>Número tarjeta: </td>
                    <td><input type="number" name="card" placeholder="XXXXXXXXXXXXX" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="input-responsive" required></td>
                </tr>
                
                <tr>
                    <td>Fecha de expedición: </td>
                    <td><input type="date" name="expedition_date" min="2023-09-21" max="2033-12-31" class="input-responsive" required></td>
                </tr>

                <tr>
                    <td>CVV: </td>
                    <td><input type="number" name="cvv" placeholder="XXX"   maxlength="3" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="input-responsive" required></td>
                </tr>
        -->

                <tr>
                    <td>Contraseña: </td> 
                    <td><input type="password" name="password" placeholder="Escribe tu contraseña" class="input-responsive" required></td>
                </tr>
                
                <tr>
                    <td colsplan="2">
                        <input type="submit" name="submit" value="Registrar Usuario" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>


<?php  
    //Procesaremos el valor del formulario y se guardará en la base de datos
    //Verificaremos si el botón se hace clik o no

    if(isset($_POST['submit']))    //Asi se verifica si pasa por el metodo de publicacion o no
    {
        // El botón se pulsa
       // echo "Botón Pulsado";

       //1. Obtenemos los datos del formulario
       $customer_name = $_POST['customer_name'];
       $username = $_POST['username'];
       $customer_email = $_POST['customer_email'];
       $card = $_POST['card'];
       $expedition_date = $_POST['expedition_date'];
       $cvv = $_POST['cvv'];
       $password = md5($_POST['password']); //Contrasea cifrada con "md5"

       //2. SQL Query guarda los datos en la base de datos
       //el id no se recoge ya que esta en auto incremento, por lo que solo se pasa nombre completo, usuario y contraseña
       $sql = "INSERT INTO tbl_user SET 
            customer_name='$customer_name',
            username='$username',
            customer_email='$customer_email',
            card='$card',
            expedition_date='$expedition_date',
            cvv='$cvv',
            password='$password'

       ";

       //3. Ejecutaremos Query y se guarda los datos en la base de datos
       $res = mysqli_query($conn, $sql) or die(mysqli_error()); 

       //4. Verificamos si los datos (Query esta ejecutado ) están insertados o no y se muestra el mensaje
       if($res==TRUE)
       {
            //Dato introducido
            //echo "Datos Introducidos";
            //Creamos una variable para mostrar el mensaje 
            $_SESSION['add'] = "<div class='success'>Usuario Agregado Correctamente</div>";
            //Redirigimos a la pagina de Administración de Administración
            header("location:".SITEURL.'add-user.php'); 
            

       }
       else
       {
            //No se pueden insertar los datos
            //echo "Error al Insertar Datos";
            //Creamos una variable para mostrar el mensaje 
            $_SESSION['add'] = "<div class='error'>Error al Registrar</div>";
            //Redirigimos a la pagina de Añadir Administración
            header("location:".SITEURL.'add-user.php'); 

       }
    }
 


?>