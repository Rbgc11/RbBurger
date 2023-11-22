    <?php include('partials-front/menu.php');?>


    <!-- Sección de búsqueda de alimentos -->
    <section class="food-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Buscar Alimento..." required>
                <input type="submit" name="submit" value="Buscar" class="btn btn-primary">
            </form>

        </div>
    </section>
    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- Sección Categoría -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Categorías Destacadas</h2>
            

            <?php 
                //Creamos una sentencia para mostrar las categorías de la base de datos 
                $sql = "SELECT * FROM tbl_category WHERE active='Si' AND featured='Si' LIMIT 6";
                //Ejecutamos la Sentencia
                $res = mysqli_query($conn, $sql);
                //Contamos filas para verificar si la categoría está disponible o no
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //Categoría Disponible
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Obtenemos los valores como  id, titulo, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    //Verificamos si la imagen esta disponible o no 
                                    if($image_name=="")
                                    {
                                        //Muestra el mensaje
                                        echo "<div class='error'>Imagen No Disponible</div>";
                                    }
                                    else
                                    {
                                        //Imagen Disponible
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="pizza" class="img-responsive img-curve img-dest">
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
                    //Categoría No Dispononible
                    echo "<div class='error'>Categoría No Agregada.</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>

    <!-- Seccion Alimentos Destacados -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Alimentos Destacados</h2>

            <?php 
                //Obtenemos los Alimentos de la base de datos que están activos y destacados
                //Sentencia SQL
                $sql2 = "SELECT * FROM tbl_food WHERE active='Si' AND featured='Si' LIMIT 6";

                //Ejecutamos la Consulta
                $res2 = mysqli_query($conn, $sql2);

                //Contamos filas
                $count2 = mysqli_num_rows($res2);

                //Verificamos si los alimentos están disponibles o no
                if($count2>0)
                {
                    //Comida Disponible
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        //Obtenemos todos los valores
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
                                        //Imagen NO Disponibpe
                                        echo "<div class='error'>Imagen No Disponible.</div>";
                                    }
                                    else
                                    {
                                        //Imagen Disponible
                                        ?>
                                        <a  href="images/food/<?php echo $image_name; ?>"><img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Food" class="img-responsive img-curve"></a>
                                        <?php

                                    }
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price"><?php echo $price; ?>€</p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Pedir ahora</a>
                            </div>
                        </div>
                        <?php
                    }

                }
                else
                {
                    //Comida No Disponible
                    echo "<div class='error'>Comida No Disponible.</div>";
                }
            ?>



         
            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="foods.php">Observa la lista completa.</a>
        </p>
    </section>

    <?php include('partials-front/footer.php'); ?>

     