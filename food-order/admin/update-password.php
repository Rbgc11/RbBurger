<?php  include('partials/menu.php');  ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Cambiar Contraseña</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
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
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Cambiar Contraseña" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php 

    //Comprobamos que el botón "Cambiar" ha sido pulsado o no
    if(isset($_POST['submit']))
    {
        //echo "Pulsado";
        //1.Obtenemos los datos del formulario
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //2. Verificamos si el usuario con el ID y la Contraseña actual si existe o no
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        //Ejecutamos la Sentencia
        $res = mysqli_query($conn,$sql);

        if($res == true)
        {
            //Verificamos si los datos están disponibles o no
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                //Usuario Existe y la Contraseña puede ser Cambiada
                //echo "Usuario Encontrado";

                //Verificamos si la nueva contraseña y la contraseña confirmada coinciden o no
                if($new_password==$confirm_password)
                {
                    //Actualizamos la Contraseña
                    //echo "Coincide la Contraseña";
                    $sql2 = "UPDATE tbl_admin SET
                        password='$new_password'
                        WHERE id=$id
                        ";

                    //Ejecutamos la Sentencia
                    $res2 = mysqli_query($conn, $sql2);

                    //Verificamos si la consulta se ejecutó o no
                    if($res2==true)
                    {
                        //Mostramos el mensaje exitoso
                        //Redirigimos al Panel de Administrador con Mensaje de Éxito
                        $_SESSION['change-pwd'] = "<div class='success'>Cambio de Contraseña Exitoso. </div>";
                        //Redirigimos el Usuario
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        //Mostramos el mensaje de Error
                        //Redirigimos al Panel de Administrador con Mensaje de Error
                        $_SESSION['change-pwd'] = "<div class='success'> Error al Cambiar de Contraseña. </div>";
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
                $_SESSION['user-not-found'] = "<div class='error'>Usuario No Encontrado. </div>";
                //Redirigimos el Usuario
                header("location:".SITEURL.'admin/manage-admin.php');
            }
        }

        //3. Verificamos si la Nueva Contraseña y Confirmar la Contraseña Coinciden o no

        //4. Cambiar la Contraseña si todo lo anterior es verdadero
    }

?>

<?php  include('partials/footer.php');  ?>
