<?php include('config/constants.php'); ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RbBurger</title>
    <link rel="shortcut icon" href="images/logo.ico" />

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!--Cookies -->
    <div class="cookie-container">
      <p>
      Utilizamos cookies propias y de terceros para fines estrictamente funcionales, permitiendo la navegación en la web,
		así como para fines analíticos, para mostrarte publicidad en base a un perfil elaborado a partir de tus hábitos de navegación y para optimizar la web.
		Pulsa el botón Aceptar Cookies para confirmar que has leído y aceptado la información presentada.
      </p>

      <button class="cookie-btn">Aceptar Cookies</button>
      <a href="aviso-cookies.html"><button class="aviso-btn">Aviso Cookies</btn></a>
    </div>



    <!--  Barra de Navegación -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>" title="Logo">
                    <img src="images/logorb.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul class="cont-ul" >
                    <li>
                        <a href="<?php echo SITEURL; ?>">Inicio</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categorías</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Platos</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>contact.php">Contacto</a>
                    </li>
                    <li>            
                        <a href="<?php echo SITEURL;  ?>login-user.php"><?php echo $_SESSION['username']; ?> </a>
                            <ul>
                                <li>
                                    <a href="<?php echo SITEURL;  ?>logout.php" class="salir">Salir</a>
                                </li>
                            </ul>
                    </li>

                <?php 



               if (empty($_SESSION['username'])) {
                $_SESSION['username'] = 'Usuario';
            }        
            ?>
                    </li>
                </ul>
            </div>


            <div class="clearfix"></div>
        </div>
    </section>
    
    <!-- Para hacer el boton de ir hacia arriba -->
    <div id="progress">
        <span id="progress-value">&#x1F815;</span>
    </div>
    
    <!-- Navbar Section Ends Here -->




    