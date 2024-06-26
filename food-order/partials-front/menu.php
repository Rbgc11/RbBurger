<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RbBurger</title>
    <link rel="shortcut icon" href="images/logo.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Enlace de los estilos para la web -->
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
        <nav class="navbar fixed-top navbar-expand-md navbar-light bg-light">

            <a href="<?php echo SITEURL; ?>" class="navbar-brand mb-0 h1">
                <img src="images/logorb.png" class="d-inline-block align-top" />
            </a>
            <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" class="navbar-toggler" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div  class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a href="<?php echo SITEURL; ?>" class="nav-link">
                            Inicio
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a href="<?php echo SITEURL; ?>categories.php" class="nav-link">
                            Categorías
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a href="<?php echo SITEURL; ?>foods.php" class="nav-link">
                            Alimentos
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a href="<?php echo SITEURL; ?>contact.php" class="nav-link">
                            Contacto
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        </div>
        <div class="clearfix"></div>
        </div>
    </section>



    
    <!-- Para hacer el boton de ir hacia arriba -->
    <div id="progress">
        <span id="progress-value"> </span> <img src=" https://img.icons8.com/?size=40&id=70730&format=png&color=000000"/> 
    </div>

    <!-- Para hacer el boton de mandar un aviso al camarero -->
    <div class="aviso">
        <a href="<?php echo SITEURL; ?>aviso.php" class="nav-link">
            <img src="https://img.icons8.com/?size=40&id=3715&format=png&color=000000"/>
        </a>      
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    



    