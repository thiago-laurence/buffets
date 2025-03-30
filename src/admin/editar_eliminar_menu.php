<?php 
	require("../php/conexion_bdd.php");
	$menu=mysqli_query($con, "CALL select_menu();");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Buffet'S - Editar/Eliminar</title>
</head>
<body>
	<?php include("header.php"); ?>

	<div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                </div>
            </div>
        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Editar/Eliminar menú</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
        	<div class="content mt-3">
	            <div class="animated fadeIn">
	                <div class="row">
	                	<?php 
                		while ($row=mysqli_fetch_array($menu)) {
                			$plato=$row['plato'];
							$precio=$row['precio'];
							$img=$row['url_img'];
							$categoria=$row['categoria'];
							$descripcion=$row['descripcion'];
							$estado=$row['estado_menu'];
							$stock=$row['stock'];
	                	?>
	                	<div class="col-sm-6 col-md-4">
	                        <aside class="profile-nav alt">
	                            <section class="card">
	                                <div class="card-header user-header alt bg-dark">
	                                    <div class="media">
	                                        <a href="#">
	                                        	<?php echo "<img class='align-self-center rounded-circle mr-3' style='width:85px; height:85px;' alt='".$plato." Sin imagen' src='../usuario/images/menu/".$img."'>"; ?>
	                                        </a>
	                                        <div class="media-body">
	                                            <h2 class="text-light display-6"><?php echo $plato; ?></h2>
	                                            <p><?php echo $descripcion; ?></p>
	                                        </div>
	                                    </div>
	                                </div>


	                                <ul class="list-group list-group-flush">
	                                    <li class="list-group-item">
	                                        <a href="#"> <i class="fa fa-money"></i><?php echo "Precio: "; ?><span class="badge badge-primary pull-right"><?php echo "$ ".$precio; ?></span></a>
	                                    </li>
	                                    <li class="list-group-item">
	                                        <a href="#"> <i class="fa fa-tasks"></i><?php echo "Categoria: "; ?><span class="badge badge-danger pull-right"><?php echo $categoria; ?></span></a>
	                                    </li>
	                                    <li class="list-group-item">
	                                        <a href="#"> <i class="fa fa-inbox"></i><?php echo "Stock: "; ?><span class="badge badge-success pull-right"><?php echo $stock; ?></span></a>
	                                    </li>
	                                    <li class="list-group-item">
	                                        <a href="#"> <i class="fa fa-question"></i><?php echo "Estado: ";?><span class="badge badge-warning pull-right r-activity"><?php echo $estado; ?></span></a>
	                                    </li>
	                                    <li class="list-group-item">
	                                        <a href="#"><p><a class="btn btn-primary" href='editar_menu.php?id=<?=$row['id_menu'];?>' role="button">Editar</a></p></a>
	                                        <?php echo "<button class='btn btn-danger' id='btn-eliminar' data-id_menu='".$row['id_menu']."' data-plato='".$plato."'>
													Eliminar
												</button>"; ?>
	                                    </li>
	                                </ul>

	                            </section>
	                        </aside>
                    	</div>
                    <?php } ?>
	                </div><!-- .row -->
	            </div><!-- .animated -->
        	</div><!-- .content -->
        </div>
        
    </div><!-- /#right-panel -->
</body>
</html>
<script>
  $(document).on("click", "#btn-eliminar", function(){
    var plato = $(this).data("plato")
    var id_menu = $(this).data("id_menu");
    swal({
      title: "¿Seguro desea eliminar: "+plato+"?",
      text: "El menú sera eliminado del sistema",
      icon: "warning",
      buttons: ["Cancelar", "Aceptar"],
    })
    .then((confirmar) => {
      if (confirmar) {
        swal("Menú eliminado correctamente!", {
          icon: "success",
          button: true,
        })
        .then((redireccion) => {
          if (redireccion) {
            window.location.href="../php/borrar_menu.php?id="+id_menu;
          }
        });
      }
    });
  })
</script>