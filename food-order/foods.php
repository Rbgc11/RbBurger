    <?php include('partials-front/menu.php'); ?>


    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Buscar Alimento..." required>
                <input type="submit" name="submit" value="Buscar" class="btn btn-primary">
            </form>

        </div>
    </section>



    <!-- Sección lista alimentos -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Lista de Alimentos</h2>

            <?php
                //Mostramos los alimentos que están activos
                $sql ="SELECT * FROM tbl_food WHERE active='Yes'";

                //Ejecutamos la sentencia
                $res=mysqli_query($conn, $sql);

                //Contamos Filas
                $count = mysqli_num_rows($res);

                //Verificamos si la comida está disponible o no
                if($count>0)
                {
                    //Comida Disponible
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Obtenemos los valores
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    //Verificamos si la imagen está disponible o no
                                    if($image_name=="")
                                    {
                                        //Imagen no disponible
                                        echo "<div class='error'> Imagen No Disponible</div>";
                                    }
                                    else
                                    {
                                        //Imagen disponible
                                        ?>
                                       <a  href="images/food/<?php echo $image_name; ?>"><img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"  alt="Chicke Hawain Pizza" class="img-responsive img-curve"></a>
                                        <?php
                                    }
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4 ><?php echo $title; ?></h4>
                                <p class="food-price"><?php echo $price; ?>€</p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Pedir Ahora</a>
                            </div>
                        </div>
                        <?php
                    }
                }
                else
                {
                    //Comida No Disponible
                    echo "<div class='error'>Alimento No Encontrado.</div>";
                }
            ?>



 
           


            <div class="clearfix"></div>

            

        </div>

    </section>

    <?php include('partials-front/footer.php'); ?>
