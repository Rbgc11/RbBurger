<?php  include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Admisnitración Datos Cliente</h1>
        
                <br /><br /><br />

                <?php
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset ($_SESSION['update']);
                    }
                ?>
                            <a href="manage-order.php" class="btn-primary">Volver</a> 

                <table  class="tbl-full">
                    <tr >
                        <th>S.N.</th>
                        <th>Nombre</th>
                        <th>Contacto</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Accciones</th>
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
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];


                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>.</td>
                    
                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary"> <img src="https://img.icons8.com/pastel-glyph/30/loop.png"/></a>
                                            <a href="<?php echo SITEURL;?>admin/card-order.php?id=<?php echo $id; ?>"  class="btn-primary"><img src="https://img.icons8.com/ios-filled/30/bank-card-back-side.png"/></a>

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
    </div>

</div>


<?php  include('partials/footer.php'); ?>