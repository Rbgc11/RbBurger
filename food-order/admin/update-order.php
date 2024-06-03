<?php  include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Actualizar Aviso</h1>
        <br><br>

        <?php 
        
            //Verificamos si el id está configurado o no
            if(isset($_GET['id']))
            {
                //Obtenemos los detalles del aviso
                $id=$_GET['id'];
                
                //Obtenemos todos los otros detalles basados en este id
                //Sentencia SQL para obtener los otros detalles
                $sql = "SELECT * FROM tbl_aviso WHERE id=$id";
                //Ejecutamos la Sentencia
                $res = mysqli_query($conn, $sql);
                //Contamos Filas
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Detalles Disponibles
                    $row=mysqli_fetch_assoc($res);

                    $num_mesa = $row['num_mesa'];
                    $status = $row['status'];
                
                }
                else
                {
                    //Detalles No Disponibles
                    //Redirigimos a la Administración de Avisos
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            else
            {
                //Redirigimos a la administración de avisos
                header('location:'.SITEURL.'admin/manage-order.php');
            }

        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Nº Mesa</td>
                    <td>
                    <br><input type="text" name="num_mesa" value="<?php echo $num_mesa; ?>"></br>
                    </td>
                </tr>


                <tr>
                    <td >Estado: </td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ir a la Mesa"){echo "selected";} ?> value="Ir a la mesa">Ir a la mesa</option>
                            <option <?php if($status=="Llevar la Cuenta"){echo "selected";} ?> value="Llevar la Cuenta">Llevar la Cuenta</option>
                            <option <?php if($status=="Pagado"){echo "selected";} ?> value="Pagado">Pagado</option>
                            <option <?php if($status=="Cancelado"){echo "selected";} ?> value="Cancelado">Cancelado</option>
                        </select>
                    </td>
                </tr>

                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        
                        <input type="submit" name="submit" value="Actualizar Aviso" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php 
            //Verificamos si el botón de actualizar se pulso o no
            if(isset($_POST['submit']))
            {
                //echo "Pulsado";
                //Obtenemos los valores del formulario
                $id = $_POST['id'];
                $num_mesa = $_POST['num_mesa'];
                $status = $_POST['status'];
    
                
                //Actualizamos los valores
                $sql2 = "UPDATE tbl_aviso SET
                    num_mesa = '$num_mesa',
                    status = '$status'
                    WHERE id=$id
                ";
                //Ejecutamos la sentencia
                $res2 = mysqli_query($conn, $sql2);

                //Verificamos si se actualizo o no
                //Redirigimos a Administración Aviso con mensaje
                if($res2==true)
                {
                    //Actualizar
                    $_SESSION['update'] = "<div class='success'>Aviso Actualizado Correctamente</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    //Error al actualizar
                    $_SESSION['update'] = "<div class='error'>Error al Realizar el Aviso</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
        ?>
    </div>
</div>

<?php  include('partials/footer.php'); ?>
