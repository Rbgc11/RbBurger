<?php  include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Administración Avisos</h1>
        
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
            $sql2 = "SELECT * FROM tbl_aviso WHERE id=$id";
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
                        <th>Nº Mesa</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>

                    <?php 
                        //Obtenemos todos los pedidos de la base de datos
                        $sql ="SELECT * FROM tbl_aviso ORDER BY id DESC"; //Mostramos el ultimo pedido al principio
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
                                $num_mesa = $row['num_mesa'];
                                $status = $row['status'];

                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>.</td>
                                        <td><?php echo $num_mesa; ?></td>

                                        <td>
                                            <?php 
                                                //Pedidos, En Entrega, Entregado, Cancelado
                                                if($status=="Ir a la mesa")
                                                {
                                                    echo "<label>Ir a la mesa</label>";
                                                }
                                                elseif($status=="Llevar la Cuenta")
                                                {
                                                    echo "<label style='color: orange;'>Llevar la Cuenta</label>";
                                                }
                                                elseif($status=="Pagado")
                                                {
                                                    echo "<label style='color: green;'>Pagado</label>";
                                                }
                                                elseif($status=="Cancelado")
                                                {
                                                    echo "<label style='color: red;'>Cancelado</label>";
                                                }
                                            ?>
                                        </td>

                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary"> <img src="https://img.icons8.com/pastel-glyph/30/loop.png"/></a>
                                            <a href="<?php echo SITEURL;?>admin/delete-order.php?id=<?php echo $id; ?>" class="btn-danger"> <img src="https://img.icons8.com/ios-glyphs/30/filled-trash.png"/></a>
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
    </div>

</div>


<?php  include('partials/footer.php'); ?>