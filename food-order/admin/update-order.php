<?php  include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Actualizar Pedido</h1>
        <br><br>

        <?php 
        
            //Verificamos si el id está configurado o no
            if(isset($_GET['id']))
            {
                //Obtenemos los detalles del pedido
                $id=$_GET['id'];
                
                //Obtenemos todos los otros detalles basados en este id
                //Sentencia SQL para obtener los otros detalles
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                //Ejecutamos la Sentencia
                $res = mysqli_query($conn, $sql);
                //Contamos Filas
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Detalles Disponibles
                    $row=mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                    $card = $row['card'];
                    $expedition_date = $row['expedition_date'];
                    $cvv = $row['cvv'];
                
                }
                else
                {
                    //Detalles No Disponibles
                    //Redirigimos a la Administración de Pedidos
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            else
            {
                //Redirigimos a la administración de pedidos
                header('location:'.SITEURL.'admin/manage-order.php');
            }

        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Nombre Comida</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>

                <tr>
                    <td>Precio: </td>
                    <td>
                        <b><?php echo $price; ?> €</b>
                    </td>
                </tr> 

                <tr>
                    <td>Cantidad: </td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>

                <tr>
                    <td >Estado: </td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Pedido"){echo "selected";} ?> value="Pedido">Pedido</option>
                            <option <?php if($status=="En entrega"){echo "selected";} ?> value="En entrega">En entrega</option>
                            <option <?php if($status=="Entregado"){echo "selected";} ?> value="Entregado">Entregado</option>
                            <option <?php if($status=="Cancelado"){echo "selected";} ?> value="Cancelado">Cancelado</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Nombre Cliente: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Contacto Cliente: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr> 
                
                <tr>
                    <td>Email Cliente: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Dirección Cliente: </td>
                    <td>
                        <input type="text" name="customer_address" value="<?php echo $customer_address; ?>">
                    </td>
                </tr> 

                <tr>
                    <td>Número Tarjeta: </td>
                    <td>
                        <input type="text" name="card" value="<?php echo $card; ?>">
                    </td>
                </tr> 
                
                <tr>
                    <td>Fecha Expedición</td>
                    <td>
                        <input type="date" name="expedition_date" min="2023-09-21" max="2033-12-31" value="<?php echo $expedition_date; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>CVV: </td>
                    <td>
                    <input type="text" name="cvv" minlength="3" value="<?php echo $cvv; ?>">
                    </td>
                </tr> 
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
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
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty;

                $status = $_POST['status'];
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];
                $card = $_POST['card'];
                $expedition_date = $_POST['expedition_date'];
                $cvv = $_POST['cvv'];
                
                //Actualizamos los valores
                $sql2 = "UPDATE tbl_order SET
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address',
                    card = '$card',
                    expedition_date = '$expedition_date',
                    cvv = '$cvv'    
                    WHERE id=$id
                ";
                //Ejecutamos la sentencia
                $res2 = mysqli_query($conn, $sql2);

                //Verificamos si se actualizo o no
                //Redirigimos a Administración Pedido con mensaje
                if($res2==true)
                {
                    //Actualizar
                    $_SESSION['update'] = "<div class='success'>Pedido Realizado Correctamente</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    //Error al actualizar
                    $_SESSION['update'] = "<div class='error'>Error al Realizar el Pedido</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
        ?>
    </div>
</div>

<?php  include('partials/footer.php'); ?>
