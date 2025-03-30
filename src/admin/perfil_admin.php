<?php 
    include("../php/conexion_bdd.php");
    $sql="SELECT dni, nombre, apellido FROM admin";
    $query=mysqli_query($con, $sql);
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>Buffet'S - Administración</title>
</head>
<body>

    <?php include("header.php"); ?>

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">
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
                        <h1>Pedidos del dia</h1>
                    </div>
                </div>
            </div>
        </div>

       <div class="content mt-3">
            <div class="content mt-3">
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Tabla de pedidos</strong>
                                    <span class="input-group-text" id="basic-addon1" style="margin-top: 20px; margin-bottom: 20px;">Busca el usuario por el DNI</span>
                                    <input id="FiltrarContenido" type="text" class="form-control" placeholder="Buscar..." aria-label="Alumno" aria-describedby="basic-addon1">
                                </div>
                                <div class="card-body">
                                    <table class='table table-striped table-bordered'>
                                        <thead class='thead-dark'>
                                            <tr>
                                                <th>DNI</th>
                                                <th>Nombre y apellido</th>
                                            </tr>
                                            <tbody class='BusquedaRapida'>
                                            	<?php 
                                            		while ($row=mysqli_fetch_array($query)) {
                                            			$dni=$row['dni'];
                                            			$nombre_completo=$row['nombre']." ".$row['apellido'];

                                            			echo "
                                            				<tr>
                                            					<td>".$dni."</td>
                                            					<td>".$nombre_completo."</td>
                                            					<td>"; 
                                                                if ($dni==$_SESSION['documento']) {
                                                                    echo "Usted";
                                                                }else{ ?>
                                                                <?php
                                                                echo "
                                            					<button class='btn btn-primary' id='btn-eliminar' data-nombre_completo='".$nombre_completo."' data-dni='".$dni."'>
                                                                            Eliminar
                                                                        </button>";
                                            				     } echo "
                                            					</td>
                                            				</tr>
                                            			";
                                            		}
                                            	?>
                                            </tbody>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- .row -->
                </div><!-- .animated -->
            </div>
        </div>
        
    </div> <!-- .content -->
    <!-- Right Panel -->
</body>
</html>
<script>
    $(document).ready(function () {
        //buscador de datos
       (function($) {
           $('#FiltrarContenido').keyup(function () {
                var ValorBusqueda = new RegExp($(this).val(), 'i');
                $('.BusquedaRapida tr').hide();
                 $('.BusquedaRapida tr').filter(function () {
                    return ValorBusqueda.test($(this).text());
                  }).show();
                    })
          }(jQuery));
        //fin de buscador
    });
</script>
<script>
  $(document).on("click", "#btn-eliminar", function(){
    var dni = $(this).data("dni")
    var nombre_completo = $(this).data("nombre_completo");
    swal({
      title: "¿Seguro desea eliminar: "+nombre_completo+"?",
      text: "El administrador sera eliminado del sistema",
      icon: "warning",
      buttons: ["Cancelar", "Aceptar"],
    })
    .then((confirmar) => {
      if (confirmar) {
        swal("Administrador eliminado correctamente!", {
          icon: "success",
          button: true,
        })
        .then((redireccion) => {
          if (redireccion) {
            window.location.href="../php/eliminar_admin.php?dni="+dni;
          }
        });
      }
    });
  })
</script>