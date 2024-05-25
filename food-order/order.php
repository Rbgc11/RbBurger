    <?php include('partials-front/menu.php'); ?>

    <?php 
        //Verificamos si la identificación de la comida esta configurada o no
        if(isset($_GET['food_id']))
        {
            //Comida id esta preparada y obtenemos el id
            $food_id = $_GET['food_id'];
            //Obtenemos el titulo de la categoría basado en el ID de la categoría
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

            //Ejecutamos la Sentencia
            $res = mysqli_query($conn, $sql);

            //Contamos las filas
            $count = mysqli_num_rows($res);

            //Verificamos si los datos están disponibles o no
            if($count==1)
            {
                //Tenemos los datos
                //Obtenemos los datos de la base de datoss
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                //Comida no disponible
                //Redirección a la página de inicio
                header('location:'.SITEURL); 
            }
        }
        else
        {
            //Categoría no pasa
            //Redirección a la página de inicio
            header('location:'.SITEURL); 
        }
    ?>

    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-order">Rellena Este Formulario para Confirmar tu Pedido</h2>
            <p class="text-center text-order">Para rellenar automaticamente los detalles de la entrega para el resto de pedidos, pulsa el botón "Guardar Datos"</p>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Comida Seleccionada</legend>

                    <div class="food-menu-img">
                        <?php
                            //Verificamos si la imagen está disponible o no
                            if($image_name=="")
                            {
                                //Imagen NO Disponibpe
                                echo "<div class='error'>Imagen No Disponible.</div>";
                            }
                            else
                            {
                                //Imagen Disponible
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="alimento" class="img-responsive img-curve">
                                <?php

                            }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food_title" value="<?php echo $title; ?>">
                        <!--
                        <h3 hidden><?php echo $food_id; ?></h3>
                        <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">-->


                        <p class="food-price"><?php echo $price; ?>€</p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Cantidad</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>


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




