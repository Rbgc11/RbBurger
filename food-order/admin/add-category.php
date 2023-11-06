<?php  include('partials/menu.php');  ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Añadir Categoría</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add']))  
            {
                echo $_SESSION['add']; 
                unset($_SESSION['add']);  
            }

            if(isset($_SESSION['upload']))  
            {
                echo $_SESSION['upload']; 
                unset($_SESSION['upload']);  
            }
        ?>

        <br><br>

        <!--Creamos Formulario para crear Categoría-->  
        <form action="" method="POST" enctype="multipart/form-data"> <!-- Con "enctype" nos permite cargar un archivo o imagen-->

            <table class="tbl-30">
                <tr>
                    <td>Titulo: </td>
                    <td>
                        <input type="text" name="title" placeholder="Titulo Categoría">
                    </td>
                </tr>

                <tr>
                    <td>Imagen: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Destacado: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Sí
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Activo: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Sí
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Añadir Categoría" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        
        <?php 

            //Verificamos si se pulsa el botón de enviar o no
            if(isset($_POST['submit']))
            {
                //echo "Pulsado";

                //1. Obtenemos el Valor del Formulario
                $title = $_POST['title'];

                //Para el tipo de Radio, debemos verificar si el botón es seleccionado o no
                if(isset($_POST['featured']))
                {
                    // Obtenemos el Valor del formulario
                    $featured = $_POST['featured'];

                }
                else
                {
                    //Establecer el Valor por Defecto
                    $title = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }
                

                //Verificamos si la imagen esta seleccionada o no y establecemos el valor para el nombre de la imagen en consecuencia
                if(isset($_FILES['image']['name']))
                {
                    //Carga la Imagen
                    //Para cargar la imagen necesitamos el nombre de la imagen, ruta de orgen y ruta de destino
                    $image_name = $_FILES['image']['name'];

                    //Se actualiza la imagen si es seleccionada
                    if($image_name != "")
                    {

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
                            header("location:".SITEURL.'admin/add-category.php'); 
                            //Terminamos el Proceso. Esto se hace porque si no carga la imagen no queremos que el resto de datos entren en la base de datos
                            die();
                        }
                    }
                }
                else
                {
                    //No Carga la imagen y establezca el valor del nombre de la imagen en blanco 
                    $image_name="";
                } 

                //2. Creamos la Consulta para Insertar la Categoría en la Base de Datos
                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                //3. Ejecutamos la Sentencia y se Guarda en la Base de Datos
                $res = mysqli_query($conn, $sql);
                 
                //4. Verificamos si la Sentencia ha sido ejecutada o no y agregen los datos o no
                if($res==true)
                {
                    //La Sentencia se ejecutó y se Agrego la Categoría
                    $_SESSION['add'] = "<div class='success'>Se Agregó la Categoría Exitosamente.</div>";
                    //Redirigimos a la página de administración de categorías
                    header("location:".SITEURL.'admin/manage-category.php'); 
                    
                }
                else
                {
                    //No se puede Agregar la Categoría
                    $_SESSION['add'] = "<div class='error'>Error al Agregar la Categoría.</div>";
                    //Redirigimos a la página de administración de categorías
                    header("location:".SITEURL.'admin/add-category.php'); 
                }


            }

        ?>


    </div>
</div>
 
<?php  include('partials/footer.php');  ?>
