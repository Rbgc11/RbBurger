<?php include('partials/menu.php') ?>
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
            
                    Total de Avisos para atender
                    <br><br>

                    <?php 
                        //Consulta Query
                        $sql3="SELECT Status FROM tbl_aviso WHERE status='Ir a la mesa'";
                        //Ejecutamos la Sentencia
                        $res3 = mysqli_query($conn, $sql3);
                        //Contamos Filas
                        $count3 = mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count3; ?></h1>

                </div>

                <div class="col-4 text-center">
            
                    Total de Mesas pagadas
                    <br><br>

                    <?php 
                        //Consulta Query
                        $sql3="SELECT Status FROM tbl_aviso WHERE status='Pagado'";
                        //Ejecutamos la Sentencia
                        $res3 = mysqli_query($conn, $sql3);
                        //Contamos Filas
                        $count3 = mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count3; ?></h1>

            </div>


                <div class="clearfix"></div>
            </div>
        </div>

<?php include('partials/footer.php')?>