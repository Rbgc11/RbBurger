<?php 

    //Incluimos constantes.php 
    include('../config/constants.php');

    //1.Obtenemos el ID del Administrador para ser eliminado
    $id=$_GET['id'];

    //2.Creamos la sentencia Query para elminar el Administrador
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Ejectuamos la consulta
    $res = mysqli_query($conn, $sql);

    //Verificamos si la consulta ejecuta correctamente o no
    if($res==true)
    {
        //Se ejecuta la consulta correctamente y el administrador se elimina
        //echo "Administrador Elminado";
        //Creamos una variable de sistema para mostrar un mensaje 
        $_SESSION['delete'] = "<div class='success'>Administrador Elminado.</div>";
        //Redirigir a la página de Administrar Administración
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //No se ejecuta la consulta correctamente y el administrador no se elimina
        //echo "Error al Eliminar el Administrador";

        $_SESSION['delete'] = "<div class='error'>Error al Eliminar el Administrador. Intentalo de nuevo.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    //3.Redirigir a Administrar la Pagina de Administración con un mensaje (exito/error)

?>