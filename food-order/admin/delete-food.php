<?php
    //Incluimos constantes.php 
    include('../config/constants.php');

    //Verificamos si el valor el id y image_name está configurado o no
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Obtenemos los valores y eliminamos
        //1.Obtenemos el id el nombre de la imagen
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Eliminamos el archivo de la imagen si está disponible
        //Verificamos si la imagen esta disponible o no y eliminamos solo si está disponible
        if($image_name !="")
        {
            //Imagen Disponible, entonces la eliminamos
            //Obtenemos la ruta de imagen
            $path = "../images/food/".$image_name;
            //Eliminamos la imagen
            $remove = unlink($path);

            //Verificamos si no se puede eliminar la imagen entonces se agrega un mensaje de error y detiene el proceso.
            if($remove==false)
            {
                //Se establece el mensaje de sesión al fallar al intentar eliminar la imagen
                $_SESSION['upload'] = "<div class='error'>Error al eliminar la imagen de la categoría</div>";
                // Se redirige a la página de gestión de comida 
                header('location:'.SITEURL.'admin/manage-food.php');
                // Detiene el proceso
                die();
            }
        }

        //3. Eliminamos los datos de la base de datos
        //SQL query para eliminar los datos de la base de datos
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        //Ejecutamos la Sentencia
        $res = mysqli_query($conn, $sql);

        //Verificamos si los datos están eliminados desde la base de datos o no 
        if($res==true)
        {
            //Se ejecuta la consulta correctamente y la comida se elimina
            //Creamos una variable de sistema para mostrar un mensaje 
            $_SESSION['delete'] = "<div class='success'>Comida Elminada.</div>";
            //Redirigir a la página de Gestión de Comida
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //No se ejecuta la consulta correctamente y la comida no se elimina    
            $_SESSION['delete'] = "<div class='error'>Error al Eliminar la Comida. Intentalo de nuevo.</div>";
            header('location:'.SITEURL.'food/manage-food.php');
        }

    }
    else
    {
        //Redirigimos a la pagina de gestión de categorías
        $_SESSION['unauthorize'] ="<div class='error'>Acceso No Autorizado.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    




?>