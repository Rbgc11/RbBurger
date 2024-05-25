<?php  include('partials/menu.php'); ?>


        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Administración</h1>

                <br /><br />

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; //Muestra el mensaje del sistema
                        unset($_SESSION['add']); //Eliminamos el mensaje del sistema al actualizar 
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']); 
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update']; 
                        unset($_SESSION['update']); 
                    }

                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found']; 
                        unset($_SESSION['user-not-found']); 
                    }

                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match']; 
                        unset($_SESSION['pwd-not-match']); 
                    }

                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd']; 
                        unset($_SESSION['change-pwd']); 
                    }
                ?>
                <br><br><br>

                <!-- Button para añadir un administador-->
                <a href="add-admin.php" class="btn-primary">Crear Administrador</a> 

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Nombre Completo</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                    </tr>

                    <?php
                        //Se obtiene todos los administradores
                        $sql ="SELECT * FROM tbl_admin";
                        //Ejecutamos la sentencia
                        $res = mysqli_query($conn, $sql);

                        //Verificar si la sentencia se ejecuta o no 
                        if($res==TRUE)
                        {
                            //Contar las filas para verificar si tenemos datos en la base de datos o no
                            $count = mysqli_num_rows($res); //Funcion para obtener todas las filas en la base de datos

                            $sn=1; //Creo una variable y se asignara un valor

                            //Verificamos el numero de filas
                            if($count>0)
                            {
                                //Tenemos datos en la base de datos y se almacena en la variable
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //Se usara el bucle para obtener todos los datos de la base de datos
                                    //El bucle while se ejecutará siempre que tengamos datos en la base de datos

                                    //Obtiene datos individuales
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];
                                    //No se hace la contraseña ya que es un valor cifrado y no se ha de mostrar

                                    //Mostramos los valores en nuestra tabla
                                    ?>
                                        <tr>
                                            <td><?php echo $sn++;  ?>.</td>  <!-- Esto se hace para que cada vez que se elimine un administrador su id se cambie correctamente, siendo seguido-->
                                            <td><?php echo $full_name; ?></td>
                                            <td><?php echo $username; ?></td>
                                            <td>
                                               <!-- <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>"  class="btn-primary"><img src="https://img.icons8.com/ios-filled/30/change.png"/>Contraseña</a> -->
                                                <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary"> <img src="https://img.icons8.com/pastel-glyph/30/loop.png"/></a>
                                                <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger"> <img src="https://img.icons8.com/ios-glyphs/30/filled-trash.png"/></a>
                                            </td>
                                        </tr>


                                    <?php 
                                }
                            }
                            else 
                            {
                                //No tenemos datos en la base de datos
                            }
                        }
                    ?>


                </table>



            </div>
        </div>
<?php  include('partials/footer.php'); ?>
