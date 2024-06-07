<?php include('partials-front/menu.php'); ?>


<section class="food-search text-center">
    <div class="container">
        
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Buscar Alimento..." required>
            <input type="submit" name="submit" value="Buscar" class="btn btn-primary">
        </form>

    </div>
</section>

<?php 
        if(isset($_SESSION['add']))  //Verificamos si la sesion esta configurada o no
        {
            echo $_SESSION['add'];  //Mostraremos el sistema de mensaje si lo esta
            unset($_SESSION['add']); //Eliminar el mensaje del sistema 
        }
    ?>

<!-- Sección lista alimentos -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Lista de Alimentos</h2>

        <?php


            //Mostramos los alimentos que están activos
            $sql ="SELECT * FROM tbl_food WHERE active='Si'";

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
                    
                    <div class="food-menu-box"  method="POST">
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
                                   <a name="product_image" href="images/food/<?php echo $image_name; ?>"><img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"  alt="Chicke Hawain Pizza" class="img-responsive img-curve"></a>
                                    <?php
                                }
                            ?>
                        </div>

                        <div  class="food-menu-desc">
                            <h4 name="product_name" ><?php echo $title; ?></h4>
                            <p name="product_price" class="food-price"><?php echo $price; ?>€</p>
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

