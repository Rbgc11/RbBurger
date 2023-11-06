<?php  include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Actualizar Administrador</h1>

        <br><br>

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
                        <input type="text" name="username" value="<?php echo $username ; ?>">
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

        //Creamos una sentencia para actualizar el administrador
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username' 
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
    }
    


?>

<?php  include('partials/footer.php');  ?>
