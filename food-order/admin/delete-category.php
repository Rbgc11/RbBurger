<?php
    //Incluimos constantes.php 
    include('../config/constants.php');

    //echo "Eliminar Categoría";
    //Verificamos si el valor el id y image_name está configurado o no
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Obtenemos los valores y eliminamos
        //echo "Obtiene los valores y Elimina";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Eliminamos el archivo de la imagen si está disponible
        if($image_name !="")
        {
            //Imagen Disponible, entonces la eliminamos
            $path = "../images/category/".$image_name;
            //Eliminamos la imagen
            $remove = unlink($path);

            //Si no se puede eliminar la imagen entonces se agrega un mensaje de error y detiene el proceso.
            if($remove==false)
            {
                //Se establece el mensaje de sesión 
                $_SESSION['remove'] = "<div class='error'>Error al eliminar la imagen de la categoría</div>";
                // Se redirige a la página de gestión de categorías 
                header('location:'.SITEURL.'admin/manage-category.php');
                // Detiene el proceso
                die();
            }
        }

        //Eliminamos los datos de la base de datos
        //SQL query para eliminar los datos de la base de datos
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Ejecutamos la Sentencia
        $res = mysqli_query($conn, $sql);

        //Verificamos si los datos están eliminados desde la base de datos o no 
        if($res==true)
        {
            //Se ejecuta la consulta correctamente y la categoria se elimina
            //Creamos una variable de sistema para mostrar un mensaje 
            $_SESSION['delete'] = "<div class='success'>Categoría Elminada.</div>";
            //Redirigir a la página de Gestión de Categorías
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //No se ejecuta la consulta correctamente y la categoría no se elimina    
            $_SESSION['delete'] = "<div class='error'>Error al Eliminar la Categoría. Intentalo de nuevo.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    }
    else
    {
        //Redirigimos a la pagina de gestión de categorías
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>