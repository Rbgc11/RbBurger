<?php  include('partials/menu.php');  ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Actualizar Categoría</h1>

        <br><br>

        <?php 
            //Verificamos si el ID esta configurada o no
            if(isset($_GET['id']))
            {
                //Conseguiomos el ID y todos los demás detalles
                //echo "Conseguimos los Datos";
                $id=$_GET['id'];

                //Creamos una consulta SQL para obtener todos los demás detalles
                $sql="SELECT * FROM tbl_category WHERE id=$id";

                //Ejecutamos la sentencia
                $res=mysqli_query($conn, $sql);

                //Contamos las filas para verificar si el ID es valido o no
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Conseguimos los detalles
                    //echo "Administrador Disponible";
                    $row=mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];  
                }
                else 
                {
                    //Redirigimos a la página de Gestión de la Categoría
                    $_SESSION['no-category-found'] = "<div class='error'>Categoría No Encontrada</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                //Redirigimos a la página de Gestión de Categorías
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Titulo:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Imagen Actual: </td>
                    <td>
                        <?php 
                            if($current_image !="")
                            {
                                //Mostramos la imagen
                                ?>
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                //Mostramos el mensaje
                                echo "<div class='error'>Imagen No Añadida.</div>";
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
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Actualizar Categoría" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <?php
                //Comprobamos si se pulsa el boton "Actualizar Administrador" o no
            if(isset($_POST['submit']))
            {
                //echo "Boton pulsado";
                //1.Conseguimos todos los valores del formulario para actualizar
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
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
                        $ext = end(explode('.', $image_name));

                        //Renombramos la Imagen
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext; //ex: food_category_572.jpg

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path ="../images/category/".$image_name;

                        //Finalmente Carga la Imagen
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Verificamos si la imagen esta subida o no
                        //Y si la imagen no se sube, detendremos el proceso y redirigimos con un mensaje de error
                        if($upload==false)
                        {
                            //Establecemos un mensaje
                            $_SESSION['upload'] = "<div class='error'>Error al Subir la Imagen.</div>";
                            //Redirigimos a la Pagina de Añadir Categorías
                            header("location:".SITEURL.'admin/manage-category.php'); 
                            //Terminamos el Proceso. Esto se hace porque si no carga la imagen no queremos que el resto de datos entren en la base de datos
                            die();
                        }
                        //2. Elimina la imagen actual si está disponible
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);
    
                            //Verificamos si la imagen es eliminada o no
                            //Si no se elimina se mostrará el mensaje y detiene el proceso
                            if($remove==false)
                            {
                                //Error al eliminar la imagen
                                $_SESSION['failed-remove'] = "<div class='error'>Error al eliminar la imagen actual.</div>";
                                header("location:".SITEURL.'admin/manage-category.php'); 
                                die(); //Para el proceso
                            }
                        }

                    }
                    else
                    {
                        $image_name = $current_image;
                    }

                }
                else
                {
                    $image_name = $current_image;
                }
                //3. Actualizamos la base de datos
                $sql2 = "UPDATE tbl_category SET
                title = '$title',
                image_name = '$image_name', 
                featured = '$featured',
                active = '$active'
                WHERE id='$id'
                ";
                
                //Ejecutamos la sentencia
                $res2 = mysqli_query($conn, $sql2);

                //4. Redirigimos al Panel de Categoria con mensaje
                //Verificamos si la consulta se ejecuto correctamente o no
                if($res2==true)
                {
                    //La consulta se ejecuto y la Categoría se Actualizó
                    $_SESSION['update'] = "<div class='success'>Categoría Actualizada.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //La consulta no se ejecuto y la Categoría no se Actualizó
                    $_SESSION['update'] = "<div class='error'>Error al Actualizar la Categoría.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }  
            }
        ?>
    </div>
</div>

<?php  include('partials/footer.php');  ?>

