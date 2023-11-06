<?php  include('partials/menu.php');  ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Añadir Administrador</h1>

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
                        <input type="text" name="full_name" placeholder="Escribe tu nombre">
                    </td>
                </tr>

                <tr>
                    <td>Usuario: </td>
                    <td><input type="text" name="username" placeholder="Escribe tu usuario"></td>
                </tr>

                <tr>
                    <td>Contraseña: </td>
                    <td><input type="password" name="password" placeholder="Escribe tu contraseña"></td>
                </tr>

                <tr>
                    <td colsplan="2">
                        <input type="submit" name="submit" value="Añadir Administrador" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php  include('partials/footer.php');  ?>

<?php  
    //Procesaremos el valor del formulario y se guardará en la base de datos
    //Verificaremos si el botón se hace clik o no

    if(isset($_POST['submit']))    //Asi se verifica si pasa por el metodo de publicacion o no
    {
        // El botón se pulsa
       // echo "Botón Pulsado";

       //1. Obtenemos los datos del formulario
       $full_name = $_POST['full_name'];
       $username = $_POST['username'];
       $password = md5($_POST['password']); //Contrasea cifrada con "md5"

       //2. SQL Query guarda los datos en la base de datos
       //el id no se recoge ya que esta en auto incremento, por lo que solo se pasa nombre completo, usuario y contraseña
       $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
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
            $_SESSION['add'] = "<div class='success'>Administrador Agregado Correctamente</div>";
            //Redirigimos a la pagina de Administración de Administración
            header("location:".SITEURL.'admin/manage-admin.php'); 
            

       }
       else
       {
            //No se pueden insertar los datos
            //echo "Error al Insertar Datos";
            //Creamos una variable para mostrar el mensaje 
            $_SESSION['add'] = "<div class='error'>Error al Añadir Administrador</div>";
            //Redirigimos a la pagina de Añadir Administración
            header("location:".SITEURL.'admin/manage-admin.php'); 

       }
    }
 


?>