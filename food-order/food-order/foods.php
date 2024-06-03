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
                  $select_products = mysqli_query($conn, "SELECT * FROM `tbl_food`");
                  if(mysqli_num_rows($select_products) > 0){
                     while($fetch_product = mysqli_fetch_assoc($select_products)){

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
         };
      };
      ?>
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

    <?php  
    //Procesaremos el valor del formulario y se guardará en la base de datos
    //Verificaremos si el botón se hace clik o no

    if(isset($_POST['submit']))    //Asi se verifica si pasa por el metodo de publicacion o no
    {

       //1. Obtenemos los datos del formulario
       $title = $_POST['title'];
       $description = $_POST['description'];
       $price = $_POST['price']; //Contrasea cifrada con "md5"
       $image_name = $_POST['image_name'];
       $food_id = $_POST['food_id'];
       //2. SQL Query guarda los datos en la base de datos
       //el id no se recoge ya que esta en auto incremento, por lo que solo se pasa nombre completo, usuario y contraseña
       $sql = "INSERT INTO tbl_cart SET 
            name='$name',
            price='$price',
            image_name='$image',
            food_id = '$food_id'
       ";

       //3. Ejecutaremos Query y se guarda los datos en la base de datos
       $res = mysqli_query($conn, $sql) or die(mysqli_error()); 

       //4. Verificamos si los datos (Query esta ejecutado ) están insertados o no y se muestra el mensaje
       if($res==TRUE)
       {
            //Dato introducido
            //echo "Datos Introducidos";
            //Creamos una variable para mostrar el mensaje 
            $_SESSION['add'] = "<div class='success'>Administrador Agregado Correctamente</div>";
            //Redirigimos a la pagina de Administración de Administración
            header("location:".SITEURL); 
            

       }
       else
       {
            //No se pueden insertar los datos
            //Creamos una variable para mostrar el mensaje 
            $_SESSION['add'] = "<div class='error'>Error al Añadir Administrador</div>";
            //Redirigimos a la pagina de Añadir Administración
            header("location:".SITEURL); 

       }
    }
 


?>

