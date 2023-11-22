<?php include('partials/menu.php') ?>
        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Panel</h1>
                <br><br>
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>

                <div class="col-4 text-center">
                    Categorías
                    <br><br> 
                    <?php 
                        //Consulta Query
                        $sql="SELECT * FROM tbl_category";
                        //Ejecutamos la Sentencia
                        $res = mysqli_query($conn, $sql);
                        //Contamos Filas
                        $count = mysqli_num_rows($res);
                    ?>

                    <h1><?php echo $count; ?></h1>
                </div>

                <div class="col-4 text-center">
                    Comida
                    <br><br>
                    <?php 
                        //Consulta Query
                        $sql2="SELECT * FROM tbl_food";
                        //Ejecutamos la Sentencia
                        $res2 = mysqli_query($conn, $sql2);
                        //Contamos Filas
                        $count2 = mysqli_num_rows($res2);
                    ?>

                    <h1><?php echo $count2; ?></h1>
       
                </div>

                <div class="col-4 text-center">
            
                    Total de Pedidos
                    <br><br>

                    <?php 
                        //Consulta Query
                        $sql3="SELECT * FROM tbl_order";
                        //Ejecutamos la Sentencia
                        $res3 = mysqli_query($conn, $sql3);
                        //Contamos Filas
                        $count3 = mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count3; ?></h1>

                </div>

                <div class="col-4 text-center">
                    Ingresos Generadoss
                    <br> <br>

                    <?php
                        //Consulta Query para obtener los ingresos totales generados
                        //Función Agregada en SQL
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Entregado'";

                        //Ejecutamos la Sentencia
                        $res4 = mysqli_query($conn, $sql4);

                        //Obtenemos los valores
                        $row4 = mysqli_fetch_assoc($res4);

                        //Obtenemos los ingresos totales
                        $total_revenue = $row4['Total'];

                    ?>

                    <h1><?php echo $total_revenue; ?>€</h1>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main Content Section Ends --> 

<?php include('partials/footer.php')?>