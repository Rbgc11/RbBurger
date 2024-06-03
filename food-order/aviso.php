<?php include('partials-front/menu.php'); ?>


<section class="food-search">
    <div class="container">
        
        <br><br>
        <h2 class="text-center text-order">Dinos que necesitas</h2>

        <form action="" method="POST" class="order">

            <!-- Creación del formulario -->
            <fieldset class="js-form">
                <legend>Detalles:</legend>

                <div class="order-label">Número de Mesa</div>
                <input type="tel" name="num_mesa"    maxlength="9" class="input-responsive" required>

                <div class="order-label">¿Qué necesitas?</div>
                <select name="status" id="status" class="input-responsive" required>
                    <option value="Ir a la mesa">Llamar al Camarero</option>
                    <option value="Llevar la Cuenta">Pedir la cuenta</option>
                </select>

                <input type="submit" name="submit" value="Confirmar " class=" js-button btn btn-primary">


            </fieldset>

        </form>


        
        <?php
            //Verificamos si el botón de envio es pulsado o no
            if(isset($_POST['submit']))
            {
                // Obtenemos todos los detalles del formulario

                $num_mesa = $_POST['num_mesa'];
                $status = $_POST['status'];// Pedido, en camino, entregado, anulado


                //Guardamos el Pedido en la base de datos
                //Creamos SQL para guardar los datos
                $sql2 = "INSERT INTO tbl_aviso SET
                    num_mesa = '$num_mesa',
                    status = '$status'
                "; 

                //Ejecutamos la consulta
                $res2 = mysqli_query($conn, $sql2);

                //Verificamos si la consulta se ejecutó correctamente o no
                if($res2==true)
                {
                    //Sentencia ejecutada y aviso guardado 
                    $_SESSION['order'] = "<div class='success text-center'>Aviso Realizado Correctamente.</div>";
                    header('location:'.SITEURL);
                }
                else
                {
                    //Error al guardar el aviso
                    $_SESSION['order'] = "<div class='error text-center'>El Aviso No se pudo Realizar.</div>";
                    header('location:'.SITEURL);
                }



            }
        ?>
    </div>
</section>

<!-- Script para guardar los datos del formulario en el navegador -->
<script src="https://unpkg.com/form-storage@1.2.0/build/form-storage.js"></script>
    <script>
    var formStorage = new FormStorage('.js-form');
    formStorage.apply();
    var button = document.querySelector('.js-button');
    button.addEventListener('click', function(){
        formStorage.save();
    });
</script>

<?php include('partials-front/footer.php'); ?>



