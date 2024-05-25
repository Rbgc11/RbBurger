<?php  include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Administración Pedido</h1>
        
        <br /><br /><br />

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; //Muestra el mensaje del sistema
                unset($_SESSION['add']); //Eliminamos el mensaje del sistema al actualizar 
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']); 
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset ($_SESSION['update']);
            }


        ?>

<?php 
        
        //Verificamos si el id está configurado o no
        if(isset($_GET['id']))
        {
            //Obtenemos los detalles del pedido
            $id=$_GET['id'];
            
            //Obtenemos todos los otros detalles basados en este id
            //Sentencia SQL para obtener los otros detalles
            $sql2 = "SELECT * FROM tbl_order WHERE id=$id";
            //Ejecutamos la Sentencia
            $res2 = mysqli_query($conn, $sql2);
            //Contamos Filas
            $count = mysqli_num_rows($res2);

            if($count==1)
            {
                //Detalles Disponibles
                $row2=mysqli_fetch_assoc($res2);
                $status = $row2['status'];
            
            }
        }

    ?>
            <form action="" method="POST">

                <table  class="tbl-full">
                    <tr >
                        <th>S.N.</th>
                        <th>Nombre</th>
                       <!-- <th>Comida</th>
                        <th>Precio</th>
                        <th>Cantidad</th> -->
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <!--<th>Nombre</th>
                        <th>Contacto</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Tarjeta</th>
                        <th>Fecha Exp</th>
                        <th>CVV</th> -->
                        <th>Acciones</th>
                    </tr>

                    <?php 
                        //Obtenemos todos los pedidos de la base de datos
                        $sql ="SELECT * FROM tbl_order ORDER BY id DESC"; //Mostramos el ultimo pedido al principio
                        //Ejecutamos la sentencia
                        $res = mysqli_query($conn, $sql);
                        //Contamos las filas
                        $count = mysqli_num_rows($res);

                        $sn = 1; //Creamos un numero de la serie y establece su valor inicial como uno 

                        if($count>0)
                        {
                            //Pedido Disponible
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Obtenemos los Pedidos
                                $id = $row['id'];
                                $customer_name = $row['customer_name'];
                              //  $food_title = $row['food_title'];
                               // $price = $row['price'];
                               // $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                               // $customer_contact = $row['customer_contact'];
                               // $customer_email = $row['customer_email'];
                               // $customer_address = $row['customer_address'];
                               // $card = $row['card'];
                               // $expedition_date = $row['expedition_date'];
                               // $cvv = $row['cvv'];


                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>.</td>
                                        <td><?php echo $customer_name; ?></td>
                                       <!-- <td><?php echo $food_title; ?></td>
                                        <td><?php echo $price; ?>€</td>
                                        <td><?php echo $qty; ?></td> -->
                                        <td><?php echo $total; ?>€</td>
                                        <td><?php echo $order_date; ?></td>

                                        <td>
                                            <?php 
                                                //Pedidos, En Entrega, Entregado, Cancelado
                                                if($status=="Pedido")
                                                {
                                                    echo "<label>⏰</label>";
                                                }
                                                elseif($status=="En entrega")
                                                {
                                                    echo "<label style='color: orange;'>📦</label>";
                                                }
                                                elseif($status=="Entregado")
                                                {
                                                    echo "<label style='color: green;'>👍</label>";
                                                }
                                                elseif($status=="Cancelado")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }
                                            ?>
                                        </td>

                                       <!-- <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        <td><?php echo $card; ?></td>
                                        <td><?php echo $expedition_date; ?></td>
                                        <td><?php echo $cvv; ?></td> -->
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary"> <img src="https://img.icons8.com/pastel-glyph/30/loop.png"/></a>
                                            <a href="<?php echo SITEURL;?>admin/contact-order.php?id=<?php echo $id; ?>"  class="btn-primary"><img src="https://img.icons8.com/ios-filled/30/user-male-circle.png"/></a>
                                            <a href="<?php echo SITEURL;?>admin/delete-order.php?id=<?php echo $id; ?>" class="btn-danger"> <img src="https://img.icons8.com/ios-glyphs/30/filled-trash.png"/></a>

                                            <!--  <select name="status">
                                            <option <?php if($status=="Pedido"){echo "selected";} ?> value="Pedido">Pedido</option>
                                            <option <?php if($status=="En entrega"){echo "selected";} ?> value="En entrega">En entrega</option>
                                            <option <?php if($status=="Entregado"){echo "selected";} ?> value="Entregado">Entregado</option>
                                            <option <?php if($status=="Cancelado"){echo "selected";} ?> value="Cancelado">Cancelado</option>
                                                        </select>

                                                        <input type="submit" name="submit" value="Actualizar Estado" class="btn-secondary"> -->

                                        </td>
                                    </tr>

                                <?php

                            }
                        
                        }
                        else
                        {
                            //Pedido No Disponible
                            echo "<tr><td colspan='12' class='error'>Pedidos no disponible</td></tr>";
                        }
                    ?>



                </table>
                    </form>
                    <!-- ESTA COMENTAO, FIJATE -->
                    <!-- <?php 
            
            //Verificamos si el botón de actualizar se pulso o no
            if(isset($_POST['submit']))
            {
                //echo "Pulsado";
                //Obtenemos los valores del formulario

                $status = $_POST['status'];

                
                //Actualizamos los valores
                $sql3 = "UPDATE tbl_order SET
                    status = '$status'
 
                    WHERE id=$id
                ";
                //Ejecutamos la sentencia
                $res3 = mysqli_query($conn, $sql3);

                //Verificamos si se actualizo o no
                //Redirigimos a Administración Pedido con mensaje
                if($res3==true)
                {
                    //Actualizar
                    $_SESSION['update'] = "<div class='success'>Pedido Actualizado Correctamente</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    //Error al actualizar
                    $_SESSION['update'] = "<div class='error'>Error al Realizar el Pedido</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
        ?> -->
    </div>

</div>


<?php  include('partials/footer.php'); ?>