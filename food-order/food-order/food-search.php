    <?php include('partials-front/menu.php'); ?>


    <!-- Sección palabra buscada -->
    <section class="food-search text-center">
        <div class="container">
            <?php 
                //Obtenemos la palabra clave de búsqueda. Esto se hace asi para que los caracteres especiales ", \, ', los considere como cadena
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            ?>
            <h2>Alimentos con <a href="#" class="text-search">"<?php echo $search;?>"</a></h2>

        </div>
    </section>



    <!-- Sección lista comida -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Lista de Alimentos</h2>

            <?php 

                //Consulta SQL para obtener la comida en base la busqueda de la palabra clave
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //Ejectutamos la Sentencia
                $res = mysqli_query($conn, $sql);

                //Contamos fiñas
                $count = mysqli_num_rows($res);

                //Verificamos si la comida está disponible o no
                if($count>0)
                {
                    //Comida Disponible
                    while ($row=mysqli_fetch_assoc($res))
                    {
                        //Obtenemos los detalles
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    //Verificamos si el nombre de la imagen está disponible o no
                                    if($image_name=="")
                                    {
                                        //Imagen no Disponible
                                        echo "<div class='error'>Imagen No Disponible.</div>";
                                        
                                    }
                                    else
                                    {
                                        //Imagen Disponible
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Alimento" class="img-responsive img-curve">
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
