<?php  include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Administración Categoría</h1>

        <br /><br />
        <?php 
            if(isset($_SESSION['add']))  
            {
                echo $_SESSION['add']; 
                unset($_SESSION['add']);  
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);    
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);    
            }

            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);    
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);    
            }
            
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);    
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);    
            }
        ?>
        <br><br>

                <!-- Button para añadir un administador-->
                <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Crear Categoría</a> 

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Titulo</th>
                        <th>Imagen</th> 
                        <th>Destacado</th> 
                        <th>Activo</th> 
                        <th>Acciones</th>
                    </tr>

                    <?php
                        //Consultamos para obtener todas las categorias de la base de datos
                        $sql= "SELECT * FROM tbl_category";

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
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>

                                        <td>

                                            <?php 
                                                //Verificamos si el nombre de la imagen está disponible o no
                                                if($image_name!="")
                                                {
                                                    //Mostramos la imagen
                                                    ?>
                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" width="100px">
                                                    <?php

                                                }
                                                else
                                                {
                                                    //Mostramos el mensaje
                                                    echo "<div class='error'>Imagen no Añadida.</div>";
                                                }
                                            ?>
                                        </td>

                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>"class="btn-secondary">  <img src="https://img.icons8.com/pastel-glyph/30/loop.png"/></a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger"> <img src="https://img.icons8.com/ios-glyphs/30/filled-trash.png"/></a>
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
                                <td colspan="6"><div class="error">Ninguna Categoría Agregada.</div></td>
                            </tr>

                            <?php
                        }

                    ?>




                </table>
    </div>

</div>


<?php  include('partials/footer.php'); ?>