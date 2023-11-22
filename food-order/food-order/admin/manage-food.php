<?php  include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Administración Comida</h1>

        <?php 

     
?>

        <br /><br />
        <?php 
            if(isset($_SESSION['add']))  
            {
                echo $_SESSION['add']; 
                unset($_SESSION['add']);  
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);    
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);    
            }  

            if(isset($_SESSION['unauthorize']))
            {
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);    
            }           

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);    
            }  
            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);    
            }
            if(isset($_SESSION['selected']))
            {
                echo $_SESSION['selected'];
                unset($_SESSION['selected']);    
            }
        ?>
        <br><br>
                <!-- Button para añadir un administador-->
                <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Crear Comida</a> 

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Titulo</th>
                        <th>Precio</th>
                        <th>Imagen</th>
                        <th>Categoria</th>
                        <th>Destacado</th> 
                        <th>Activo</th> 
                        <th>Acciones</th> 
                    </tr>
                    <?php
                        //Consultamos para obtener todas las comidas  de la base de datos
                        $sql= "SELECT * FROM tbl_food ORDER BY category_id ASC" ;

                        //Ejecutamos la sentencia
                        $res = mysqli_query($conn, $sql);

                        //Contamos filas
                        $count = mysqli_num_rows($res);
                        
                        //Creamos una Variable de Numero de Serie y lo asignamos como 1
                        $sn=1;

                        //Verificamos si tenemos datos en la base de datos o no
                        if($count>0)
                        {
                            //Tenemos datos en la base de datos
                            //Obtenemos los datos y lo mostramos
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $category_id = $row['category_id'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>.</td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $price;  ?>€</td>
                                        <td>

                                            <?php 
                                                //Verificamos si el nombre de la imagen está disponible o no
                                                if($image_name=="")
                                                {

                                                    //Mostramos el mensaje
                                                    echo "<div class='error'>Imagen no Añadida.</div>";

                                                }
                                                else
                                                {
                                                    //Mostramos la imagen
                                                    ?>
                                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" width="100px">
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $category_id; ?></td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id; ?>"class="btn-secondary"> <img src="https://img.icons8.com/pastel-glyph/30/loop.png"/></a>
                                            <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger"> <img src="https://img.icons8.com/ios-glyphs/30/filled-trash.png"/></a>
                                        </td>
                                    </tr>
                                <?php
                            }
                            
                        }
                        else
                        {
                            //No tenemos datos en la base de datos
                            //Mostramos el mensaje dentro de la tabla. Para ello necesitamos romper el php para poder escribir en html
                            ?>

                            <tr>
                                <td colspan="7"><div class="error">Ninguna Categoría Agregada.</div></td>
                            </tr>

                            <?php
                        }

                    ?>



                </table>
    </div>

</div>


<?php  include('partials/footer.php'); ?>