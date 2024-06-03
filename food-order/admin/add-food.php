    <?php  include('partials/menu.php');  ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Añadir Comida</h1>

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

        <!--Creamos Formulario para crear Comida-->  
        <form action="" method="POST" enctype="multipart/form-data"> <!-- Con "enctype" nos permite cargar un archivo o imagen-->
            <table class="tbl-30">
                <tr>
                    <td>Titulo: </td>
                    <td>
                        <input type="text" name="title" placeholder="Titulo Comida">
                    </td>
                </tr>

                <tr>
                    <td>Descripción: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Descripción de la Comida"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Precio: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Imagen: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Categoría: </td>
                    <td>
                        
                        <select name="category">

                            <?php
                                //Creamos un código PHP para mostrar las categorías desde la base de datos
                                //1. Creamos un SQL para obtener todas las categorías activadas desde la base de datos
                                $sql = "SELECT * FROM tbl_category WHERE active='Si'";

                                //Ejecutamos la Sentencia
                                $res = mysqli_query($conn, $sql);

                                //Contamos las filas para verificar si tenemos categorías o no
                                $count = mysqli_num_rows($res);

                                //Si el recuento es mayor que 0, tenemos categorías sino no las tenemos
                                if($count>0)
                                {
                                    //Tenemos categorías
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //Conseguimos el valor de las categorías
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        
                                        <?php
                                    }
                                }
                                else
                                {
                                    //No tenemos categorías
                                    ?>
                                    <option value="0">No se encontraron Categorías</option>
                                    <?php
                                }
                                //2.Mostramos el menu desplegable

                            ?>  
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Destacado: </td>
                    <td>
                        <input type="radio" name="featured" value="Si"> Sí
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Activo: </td>
                    <td>
                        <input type="radio" name="active" value="Si"> Sí
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Añadir Comida" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php 

            //Verificamos si el botón es pulsado o no
            if(isset($_POST['submit']))
            {
                //Agregamos la comida en la base de datos
                //echo "Boton pulsado";

                //1.Conseguimos los datos del formulario 
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category_id = $_POST['category_id'];


                //Para el tipo de Radio, debemos verificar si el botón es seleccionado o no
                if(isset($_POST['featured']))
                {
                    // Obtenemos el Valor del formulario
                    $featured = $_POST['featured'];

                }
                else
                {
                    //Establecer el Valor por Defecto
                    $featured = "No";      
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                //2.Cargamos la imagen si está seleccionada
                //Verificamos si la imagen seleccionada es pulsada o no y subir la imagen solo si la imagen esta seleccionada
                if(isset($_FILES['image']['name']))
                {
                    //Obtenemos los detalles de la imagen seleccionada
                    $image_name = $_FILES['image']['name'];

                    //Verificamos si la imagen es seleccionada o no y subir la imagen si está seleccionada
                    if($image_name != "")
                    {

                        //Renombramos automáticamente nuestra imagen
                        //Obtenemos la Extensión de nuestra imagen (jpg, png..)
                        $ext = end(explode('.', $image_name));

                        //Renombramos la Imagen
                        $image_name = "Food-Name-".rand(0000, 9999).".".$ext; //ejemplo como ha de ser el nombre de la imagen: food-name572.jpg
                        
                        //Subimos la imagen
                        //Conseguimos la ruta de origen del archivo fuente y la ruta de destino
                        //La ruta de origen es la ubicacion actual de la imagen
                        $src = $_FILES['image']['tmp_name'];

                        //Ruta de destino para la imagen subida
                        $dst ="../images/food/".$image_name;

                        //Finalmente Carga la Imagen
                        $upload = move_uploaded_file($src, $dst);

                        //Verificamos si la imagen esta subida o no
                        //Y si la imagen no se sube, detendremos el proceso y redirigimos con un mensaje de error
                        if($upload==false)
                        {
                            //Establecemos un mensaje
                            $_SESSION['upload'] = "<div class='error'>Error al Subir la Imagen.</div>";
                            //Redirigimos a la Pagina de Añadir Comida
                            header("location:".SITEURL.'admin/add-food.php'); 
                            //Terminamos el Proceso. Esto se hace porque si no carga la imagen no queremos que el resto de datos entren en la base de datos
                            die();
                        }
                    }
                }
                else
                {
                    $image_name =""; //Establecemos el valor prederteminado en blanco, ya que la imagen no está seleccionada
                }

                //3.Insertamos los datos en la base de datos
                //Creamos la sentencia para guardar o añadir comida
                // Para el valor numerico no necesitamos pasar el valor entre comillas '', pero para el valor de cadena es obligatorio añadirlas
                $sql2 = "INSERT INTO tbl_food SET
                    title='$title',
                    description='$description',
                    price= $price,
                    image_name= '$image_name',
                    category= $category,
                    featured= '$featured',
                    active= '$active'
            ";

                //Ejecutamos la Sentencia y se Guarda en la Base de Datos
                $res2 = mysqli_query($conn, $sql2);

                //4. Verificamos si la Sentencia ha sido ejecutada o no y agregen los datos o no 
                // y redirigimos con mensaje a la página de adminstracion/panel de Comida

                if($res2==true)
                {
                    //La Sentencia se ejecutó y se Agrego la Comida
                    $_SESSION['add'] = "<div class='success'>Se Agregó la Comida Exitosamente.</div>";
                    //Redirigimos a la página de administración de Comida
                    header("location:".SITEURL.'admin/manage-food.php'); 
                    
                }
                else
                {
                    //No se puede Agregar la Comida
                    $_SESSION['add'] = "<div class='error'>Error al Agregar la Comida.</div>";
                    //Redirigimos a la página de administración de Comida
                    header("location:".SITEURL.'admin/manage-food.php'); 
                }


            }

        ?>

    </div>
</div>

<?php  include('partials/footer.php');  ?>