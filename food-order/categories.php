
<?php include('partials-front/menu.php'); ?>


    <!-- Sección de Categorías -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explorar Categorías</h2>

            <?php 

                //Mostramos Todas las Categorías que estén activas
                //Sentecia SQL
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                //Ejecutamos la Sentencia
                $res = mysqli_query($conn, $sql);

                //Contamos filas
                $count = mysqli_num_rows($res);

                //Verificamos si la categoría esta disponible o no
                if($count > 0)
                {
                    //Categoría Disponible
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Obtenemos los datos
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    if($image_name=="")
                                    {
                                        //Imagen no disponible
                                        echo "<div class='error'>Imagen No Encontrada</div>";

                                    }
                                    else
                                    {
                                        //Imagen disponible
                                        ?>
                                           <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Alimento" class="img-responsive img-curve img-dest">
                                        <?php
                                    }
                                ?>

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                            </a> 
                        <?php
                    }
                }
                else
                {
                    //Categoría no disponible
                    echo "<div class='error'>Categoría No Encontrada</div>";
                }

            ?>

           

            <div class="clearfix"></div>
        </div>
    </section>


    <?php include('partials-front/footer.php'); ?>
