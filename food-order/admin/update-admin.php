<?php  include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Actualizar Administrador</h1>

        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <?php 
            //1. Conseguimos el ID del Administrador Seleccionado
            $id=$_GET['id'];

            //2. Creamos la consulta SQL para obtener los Detalles
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //Ejecutamos la sentencia
            $res=mysqli_query($conn, $sql);

            //Verificamos si la consulta se ejecuta o no
            if($res==true)
            {
                //Verficamos si los daots están disponibles o no
                $count = mysqli_num_rows($res);
                //Verficamos si tenemos los datos del administrador o no
                if($count==1)
                {
                    //Conseguimos los detalles
                    //echo "Administrador Disponible";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username']; 
                    $email = $row['email']; 
                }
                else 
                {
                    //Redirigimos a la página de Administración del Administrador
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Nombre Completo:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Usuario: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>


                <tr>
                    <td>Contraseña Actual: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Contraseña Actual">
                    </td>
                </tr>

                <tr>
                    <td>Contraseña Nueva: </td>
                    <td>
                        <input type="password" name="new_password"placeholder="Contraseña Nueva">
                    </td>
                </tr>

                <tr>
                    <td>Confirmar Contraseña: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirmar Contraseña">
                    </td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="email" value="<?php echo $email; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Actualizar Administrador" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        
              

    </div>
</div>

<?php

    //Comprobamos si se pulsa el boton "Actualizar Administrador" o no
    if(isset($_POST['submit']))
    {
        //echo "Boton pulsado";
        //Conseguimos todos los valores del formulario para actualizar
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $email = $_POST['email'];
        $confirm_password = md5($_POST['confirm_password']);

        //Creamos una sentencia para actualizar el administrador
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username', 
        email = '$email' 
        WHERE id='$id' 
        ";

        //Ejecutamos la sentencia
        $res = mysqli_query($conn, $sql);

        //Verificamos si la consulta se ejecuto correctamente o no
        if($res==true)
        {
            //La consulta se ejecuto y el Administrador se Actualizó
            $_SESSION['update'] = "<div class='success'>Administrador Actualizado.</div>";
            //Redirigimos a la pagina de Administración
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //La consulta no se ejecuto y el Administrador no se Actualizó
            $_SESSION['update'] = "<div class='error'>Error al Actualizar el Administrador .</div>";
            //Redirigimos a la pagina de Administración
            header('location:'.SITEURL.'admin/manage-admin.php');
        }

                //2. Verificamos si el usuario con el ID y la Contraseña actual si existe o no
                $sql2 = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

                //Ejecutamos la Sentencia
                $res2 = mysqli_query($conn,$sql2);
        
                if($res2 == true)
                {
                    //Verificamos si los datos están disponibles o no
                    $count=mysqli_num_rows($res2);
        
                    if($count==1)
                    {
                        //Usuario Existe y la Contraseña puede ser Cambiada
                        //echo "Usuario Encontrado";
        
                        //Verificamos si la nueva contraseña y la contraseña confirmada coinciden o no
                        if($new_password==$confirm_password)
                        {
                            //Actualizamos la Contraseña
                            //echo "Coincide la Contraseña";
                            $sql3 = "UPDATE tbl_admin SET
                                password='$new_password'
                                WHERE id=$id
                                ";
        
                            //Ejecutamos la Sentencia
                            $res3 = mysqli_query($conn, $sql3);
        
                            //Verificamos si la consulta se ejecutó o no
                            if($res3==true)
                            {
                                //Mostramos el mensaje exitoso
                                //Redirigimos al Panel de Administrador con Mensaje de Éxito
                                $_SESSION['change-pwd'] = "<div class='success'> </div>";
                                //Redirigimos el Usuario
                                header("location:".SITEURL.'admin/manage-admin.php');
                            }
                            else
                            {
                                //Mostramos el mensaje de Error
                                //Redirigimos al Panel de Administrador con Mensaje de Error
                                $_SESSION['change-pwd'] = "<div class='success'> </div>";
                                //Redirigimos el Usuario
                                header("location:".SITEURL.'admin/manage-admin.php');
        
                            }
                        }
                        else
                        {
                            //Redirigimos al Panel de Administrador con Mensaje de Error
                            $_SESSION['pwd-not-match'] = "<div class='error'>No Coincide la Contraseña. </div>";
                            //Redirigimos el Usuario
                            header("location:".SITEURL.'admin/manage-admin.php');
                        }
                    }
                    else
                    {
                        //El Usuario no Existe y es redirigido
                        $_SESSION['user-not-found'] = "<div class='error'> </div>";
                        //Redirigimos el Usuario
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }
                }
    }
    


?>

<?php  include('partials/footer.php');  ?>
