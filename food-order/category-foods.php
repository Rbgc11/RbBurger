    <?php include('partials-front/menu.php'); ?>


    <?php 
        //verificamos si el id se pasa o no
        if(isset($_GET['category_id']))
        {
            //CAtegoria id esta preparada y obtenemos el id
            $category_id = $_GET['category_id'];
            //Obtenemos el titulo de la categoría basado en el ID de la categoría
            $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

            //Ejecutamos la Sentencia
            $res = mysqli_query($conn, $sql);

            //Obtenemos los valores de la base de datos
            $row = mysqli_fetch_assoc($res);
            //Obtenemos el titulo
            $category_title = $row['title'];
        }
        else
        {
            //Categoría no pasa
            //Redirección a la página de inicio
            header('location:'.SITEURL); 
        }
    ?>


    <section class="food-search text-center">
        <div class="container">
            
            <h2>Alimentos con <a href="#" class="text-search">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>



    <!-- Sección lista alimentos -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Lista de Alimentos</h2>

            <?php
                //Creamos Sentencia SQL para obtener la comida basada en la Categoría Seleccionada
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id AND active='Yes'";

                //Ejecutamos la Sentencia
                $res2 = mysqli_query($conn, $sql2);

                //Contamos las filas
                $count2 = mysqli_num_rows($res2);

                //Verificamos si la comida está disponible o no
                if($count2>0)
                {
                    //Comida disponible
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id']; 
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
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
                                        <a  href="images/food/<?php echo $image_name; ?>"><img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve"></a>
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
                    //Comida No disponible
                    echo "<div class='error'> Alimento No Disponible.</div>";
                }
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>

    <?php include('partials-front/footer.php'); ?>
