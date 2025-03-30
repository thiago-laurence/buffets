<?php include("../php/sesion.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--links de fuentes de letra-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
    <!--hojas de estilos enlazadas-->
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php"><img src="images/logo.png" width="200px"></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index.php" class="nav-link"><span class="icon icon-home" style="margin-right: 5px; font-size: 20px;"></span>Inicio</a></li>
	          <li class="nav-item"><a href="<?=$_SESSION['menu'];?>" class="nav-link"><span class="icon icon-cutlery" style="margin-right: 5px; font-size: 20px;"></span>Menú</a></li>
	          <?=$_SESSION['cambiar_contraseña'];?>
	          <li class="nav-item"><a href="<?=$_SESSION['logout'];?>" class="nav-link"><span class="<?=$_SESSION['logout_icono'];?>" style="margin-right: 5px; font-size: 20px;"></span><?=$_SESSION['cerrar_sesion'];?></a></li>
	          <li class="nav-item cart"><a href="carrito.php" class="nav-link"><span class="icon icon-shopping_cart" style="margin-right: 5px; font-size: 20px;"></span><?=$_SESSION['carrito'];?>Carrito</a></li>
	          <li class="nav-item" id="nombre-apellido"><a href="#" class="nav-link"><?=$_SESSION["nombre"]." ".$_SESSION["apellido"]; ?></a></li>
	        </ul>
	      </div>
		  </div>
	  </nav>
	</header>
</body>
</html>