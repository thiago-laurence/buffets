<?php include("../php/sesion.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">


    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="vendors/chosen/chosen.min.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
</head>
<body>
	<!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-md navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./" style="font-family: 'Great Vibes', cursive; font-size: 30px;">Buffet'S</a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php"> <i class="menu-icon fa fa-home"></i>Inicio - Pedidos Del dia </a>
                    </li>
                    <li>
                        <a href="pedidos_a_realizar.php"> <i class="menu-icon fa fa-check"></i>Pedidos a realizar </a>
                    </li>
                    <h3 class="menu-title">Opciones</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cutlery"></i>Menú</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="menu-icon fa fa-plus-circle"></i><a href="nuevo_menu.php">Añadir un nuevo menú/Categoria </a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-shopping-cart"></i><a href="combos.php">Combos</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-pencil"></i><a href="editar_eliminar_menu.php">Editar/Eliminar menú </a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-pencil"></i><a href="editar_eliminar_categoria.php">Editar/Eliminar Categoria</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Usuarios</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="menu-icon fa fa-ban"></i><a href="usuarios_bloqueados.php">Usuarios bloqueados </a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-money"></i><a href="modificar_saldo.php">Modificar saldo </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="cambiar_horarios.php"> <i class="menu-icon fa fa-clock-o"></i>Editar horarios </a>
                    </li>
                    <h3 class="menu-title">Cuenta</h3>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Perfil</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="menu-icon fa fa-key"></i><a href="cambiar_contraseña.php">Cambiar contraseña </a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-plus"></i><a href="nuevo_admin.php">Añadir administrador</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-table"></i><a href="perfil_admin.php">Gestionar perfiles</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="../php/logout.php"> <i class="menu-icon fa fa-sign-out"></i>Cerrar sesión </a>
                    </li>
                    <li>
                        <a href="#" style="text-transform: capitalize;"><i class="menu-icon fa fa-user"></i><?=$_SESSION["nombre"]." ".$_SESSION["apellido"]; ?></a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->
</body>
</html>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!--<script src="assets/js/main.js"></script>-->

<script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="vendors/jszip/dist/jszip.min.js"></script>
<script src="vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="vendors/pdfmake/build/vfs_fonts.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="assets/js/init-scripts/data-table/datatables-init.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>