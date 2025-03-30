<?php 
	include("../php/conexion_bdd.php");
	$sql="SELECT * FROM categoria_menu;";
	$query=mysqli_query($con, $sql);
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
                        <h1>Editar/Eliminar categoria</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
        	<div class="content mt-3">
	            <div class="animated fadeIn">
	                <div class="row">
	                    <div class="container">
							<?php
								$indice=0;
								while($row=mysqli_fetch_array($query)){
									if($indice==3){
										$indice=0;
									}
									$id=$row['id'];
									$categoria=$row['categoria'];
									
							?>
									
										<?php if($indice==0){ ?>
										<div class="row" style="margin-top: 40px; margin-bottom: 40px;">
										<?php }	?>
											<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
												<div class="panel panel-default" style="padding: 30px;">
													<div class="panel-heading">
														<?php
															echo "<h4 style='text-transform: capitalize; margin-bottom: 10px;'>".$categoria."</h4>";
														?>
													</div>
													<div class="panel-footer">
														<div>
															<div>
																<label>
																	Modifica el nombre de la categoria (opcional)
																</label>
																<input type="text" name="categoria" id="categoria" class="form-control" placeholder="Nombre">
															</div>
															<div class="pater">
																<div style="float: right; margin-top: 20px;">
																		<?php
																		echo"
																		<button class='btn btn-primary' id='btn-editar' data-id='".$id."' data-accion='1' id='btn-editar'>
																			Editar
																		</button>
																		<button class='btn btn-primary' id='btn-eliminar' data-categoria='".$categoria."' data-accion='2' data-id='".$id."' id='btn-eliminar'>
																			Eliminar
																		</button>
																		";
																		?>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php if($indice==2){ ?>
										</div>
										<?php }	
										$indice++;
									}
									?>
						</div>
	                </div><!-- .row -->
	            </div><!-- .animated -->
        	</div><!-- .content -->
        </div>
        
    </div><!-- /#right-panel -->
</body>
</html>
<script>
  $(document).on("click", "#btn-eliminar", function(){
    var id = $(this).data("id")
    var accion = $(this).data("accion");
    var categoria = $(this).data("categoria");
    swal({
      title: "¿Seguro desea eliminar: "+categoria+"?",
      text: "La categoria sera eliminada del sistema",
      icon: "warning",
      buttons: ["Cancelar", "Aceptar"],
    })
    .then((confirmar) => {
      if (confirmar) {
        swal("Categoria eliminada correctamente!", {
          icon: "success",
          button: true,
        })
        .then((redireccion) => {
          if (redireccion) {
            window.location.href="../php/editar_eliminar_categoria.php?id="+id+"&accion="+accion+"&categoria="+categoria;
          }
        });
      }
    });
  })
</script>
<script>
  $(document).on("click", "#btn-editar", function(){
    var id = $(this).data("id")
    var accion = $(this).data("accion");
    var categoria = $('#categoria').val();
    swal("Categoria actualizada correctamente!", {
          icon: "success",
          button: true,
    })
    .then((confirmar) => {
      	if (confirmar) {
        	window.location.href="../php/editar_eliminar_categoria.php?id="+id+"&accion="+accion+"&categoria="+categoria;
    	}
    });
})
</script>