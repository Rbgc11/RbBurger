<?php include('partials-front/menu.php'); ?>


<section class="food-search">
    <div class="container">
        
        <h3 class="text-center text-order">Rellena Este Formulario para Confirmar tu Pedido</h3>
        <p class="text-center text-order">Para rellenar automaticamente los detalles de la entrega para el resto de pedidos, pulsa el botón "Guardar Datos"</p>

        <form action="" method="POST" class="order">


            <fieldset class="js-form">
                <legend>Detalles de la Entrega:</legend>
                <div class="order-label">Nombre Completo</div>
                <input type="text" name="full-name" placeholder="" class="input-responsive" required>

                <div class="order-label">Número de Teléfono</div>
                <input type="tel" name="contact" placeholder="6XXXXXXX"   maxlength="9" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="xxxxxx@gmail.com" class="input-responsive" required>

                <div class="order-label">Dirección</div>
                <input type="address" name="address" placeholder="Calle, Ciudad, País" class="input-responsive" required>

                <div class="order-label">Número Tarjeta</div>
                <input type="text" name="card" placeholder="XXXX-XXXX-XXXX-XXXX" maxlength="19" class="input-responsive" required>

                <div class="order-label">Fecha expedición</div>
                <input type="date" name="expedition_date" min="2023-11-22" max="2033-12-31" class="input-responsive" required>

                <div class="order-label">CVV</div>
                <input type="number" name="cvv" placeholder="XXX"  maxlength="3" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="input-responsive" required>

                <input type="submit" name="submit" value="Confirmar Pedido " class=" js-button btn btn-primary">

               <!-- <button type="button" class="  btn btn-secondary ">Guardar Datos</button> -->

            </fieldset>

        </form>


        
        <?php
            //Verificamos si el botón de envio es pulsado o no
            if(isset($_POST['submit']))
            {
                // Obtenemos todos los detalles del formulario

                $food_title = $_POST['food_title'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty; // Total = precio x cantidad 

                $order_date = date("Y-m-d h:i:sa");

                $status = "Pedido"; // Pedido, en camino, entregado, anulado
                $food_id = $_POST['food_id'];

                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];
                $card = $_POST['card'];
                $expedition_date = $_POST['expedition_date'];
                $cvv = $_POST['cvv'];

                //Guardamos el Pedido en la base de datos
                //Creamos SQL para guardar los datos
                $sql2 = "INSERT INTO tbl_order SET
                    food_title = '$food_title',
                    price = $price,
                    qty = $qty,
                    total = $total,
                    order_date ='$order_date',
                    status = '$status',
                    food_id = '$food_id',
                    customer_name = '$customer_name',
                    customer_contact ='$customer_contact',
                    customer_email ='$customer_email',
                    customer_address = '$customer_address',
                    card = '$card',
                    expedition_date = '$expedition_date',
                    cvv = '$cvv'
                "; 

               // echo $sql2; die()

                //Ejecutamos la consulta
                $res2 = mysqli_query($conn, $sql2);

                //Verificamos si la consulta se ejecutó correctamente o no
                if($res2==true)
                {
                    //Sentencia ejecutada y pedido guardado 
                    $_SESSION['order'] = "<div class='success text-center'>Pedido Realizado Correctamente. Cantidad: $qty | $title | $total €</div>";
                    header('location:'.SITEURL);
                }
                else
                {
                    //Error al guardar el pedido
                    $_SESSION['order'] = "<div class='error text-center'>El Pedido No se pudo Realizar.</div>";
                    header('location:'.SITEURL);
                }



            }
        ?>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>

<script src="https://unpkg.com/form-storage@1.2.0/build/form-storage.js"></script>
    <script>
    var formStorage = new FormStorage('.js-form');
    formStorage.apply();
    var button = document.querySelector('.js-button');
    button.addEventListener('click', function(){
        formStorage.save();
    });
</script>




