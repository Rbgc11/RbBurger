<?php  include('partials/menu.php');  ?>

<?php 
    //Verificamos si el ID esta configurada o no
    if(isset($_GET['id']))
    {
        //Conseguiomos el ID y todos los demás detalles
        //echo "Conseguimos los Datos";
        $id = $_GET['id'];

        //Creamos una consulta SQL para obtener todos los demás detalles
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";  

        //Ejecutamos la sentencia
        $res2 = mysqli_query($conn, $sql2);

        //Conseguimos los valores basado en la consulta ejectutada
        $row2 = mysqli_fetch_assoc($res2);    
        
            //Conseguimos los detalles
            //echo "Administrador Disponible";
            $title = $row2['title'];
            $description = $row2['description'];
            $price = $row2['price'];
            $current_image = $row2['image_name'];
            $current_category = $row2['category_id'];
            $current_category2 = $row2['category_id'];
            $featured = $row2['featured'];
            $active = $row2['active']; 
    }
    else
    {
        //Redirigimos a la página de Gestión de Commida
        header('location:'.SITEURL.'admin/manage-food.php');
    }
     
?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Actualizar Comida</h1>
            <br><br>

            <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Titulo:</td>
                    <td>
                        <input type="text" name="title"  value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Descripción:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"> <?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Precio: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Imagen Actual: </td>
                    <td>
                        <?php 
                            if($current_image =="")
                            {
                                // Imagen no disponible
                                echo "<div class='error'>Imagen No Añadida.</div>"; 

                            }
                            else
                            {
                                // Mostramos la imagen
                                ?>
                               <img src="<?php echo SITEURL;  ?>images/food/<?php echo $current_image; ?>" width="150px"> 
                                <?php
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Imagen Nueva: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Categoria: </td>
                    <td>
                        <select name="category">
                            <?php 
                                //Sentencia para Conseguir las Categorías Activas 
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                //Ejecuta la sentencia
                                $res = mysqli_query($conn, $sql);
                                //Contamos filas
                                $count = mysqli_num_rows($res);

                                //Verificamos si la categoria esta disponible o no
                                if($count>0)
                                {
                                    //Categoria disponible
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];
                                        ?>
                                        <option <?php if($current_category==$category_id){echo "selected";}?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                       <?php
                                    }
                                }
                                else
                                {
                                    //Categoría No disponible
                                    echo "<option value='0'>Categoria No Disponible.</option>";
                                }


                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Destacado:</td>
                    <td>
                        <!-- El php sirve para mostrar por defecto marcado si es destacado o activo al darle a actualizar -->
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Sí 

                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Activo:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Sí
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Actualizar Comida" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form> 

        <?php
            if(isset($_POST['submit']))
            {
                //1.Conseguimos todos los valores del formulario para actualizar
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. Actualizamos la nueva imagen si se selecciono
                //Verificar si la imagen esta seleccionada o no
                if(isset($_FILES['image']['name']))
                {
                    //Conseguimos los detalles de la imagen
                    $image_name = $_FILES['image']['name'];

                    //Verificamos si la imagen está disponible o no
                    if($image_name !="")
                    {
                        //Imagen Disponible  

                        //1. Sube la imagen nueva
                        
                        //Renombramos automáticamente nuestra imagen
                        //Obtenemos la Extensión de nuestra imagen (jpg, png..)
                        $ext=end(explode('.', $image_name));

                        //Renombramos la Imagen
                        $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext; //ex: food_food_5722.jpg

                        $src_path = $_FILES['image']['tmp_name'];

                        $dest_path ="../images/food/".$image_name;

                        //Finalmente Carga la Imagen
                        $upload = move_uploaded_file($src_path, $dest_path);

                        //Verificamos si la imagen esta subida o no
                        //Y si la imagen no se sube, detendremos el proceso y redirigimos con un mensaje de error
                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Error al Subir la Imagen.</div>";
                            //Redirigimos a la Pagina de Añadir Categorías
                            header('location:'.SITEURL.'admin/manage-food.php'); 
                            //Terminamos el Proceso. Esto se hace porque si no carga la imagen no queremos que el resto de datos entren en la base de datos
                            die();
                        }

                        //2. Elimina la imagen actual si está disponible
                        if($current_image!="")
                        {
                            $remove_path = "../images/food/".$current_image;

                            $remove = unlink($remove_path);
                        
                             //Verificamos si la imagen es eliminada o no
                            //Si no se elimina se mostrará el mensaje y detiene el proceso
                            if($remove==false)
                            {
                                //Error al eliminar la imagen
                                $_SESSION['failed-remove'] = "<div class='error'>Error al eliminar la imagen actual.</div>";
                                header('location:'.SITEURL.'admin/manage-food.php'); 
                                die(); //Para el proceso
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image; //Imagen por Defecto cuando la imagen no está seleccionada
                    }
                }
                else 
                {
                    $image_name = $current_image; //Imagen por defecto cuando el botón no está pulsado
                }
                    
                

                //3. Actualizamos la base de datos
                $sql3 = "UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name', 
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id='$id'
                ";

              //Ejecutamos la sentencia
              $res3 = mysqli_query($conn, $sql3);

               //4. Redirigimos al Panel de Comida con mensaje
                //Verificamos si la consulta se ejecuto correctamente o no
                if($res3==true)
                {
                    //La consulta se ejecuto y la Comida se Actualizó
                    $_SESSION['update'] = "<div class='success'>Comida Actualizada.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //La consulta no se ejecuto y la Categoría no se Actualizó
                    $_SESSION['update'] = "<div class='error'>Error al Actualizar la Categoría.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }  

            }
        ?>
        </div>
    </div>

<?php  include('partials/footer.php');  ?>