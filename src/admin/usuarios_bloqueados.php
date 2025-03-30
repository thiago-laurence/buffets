<?php 
    include("../php/sesion.php");
    include("../php/conexion_bdd.php");
    include("../php/conexion_bdd_escuela.php");
    $query_buffet=mysqli_query($con, "SELECT usuario.dni, tipo_usuario.tipo_usuario, tipo_usuario.id_tipo_usuario
     FROM usuario INNER JOIN 
    tipo_usuario ON usuario.tipo_usuario=tipo_usuario.id_tipo_usuario INNER JOIN estado_usuario ON usuario.estado=estado_usuario.id_estado_usuario WHERE usuario.estado=2;");
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>Buffet'S - Usuarios bloqueados</title>
</head>
<body>
    <?php include("header.php"); ?>
    <!-- Right Panel -->
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
                        <h1>Usuarios bloqueados</h1>
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
                                                <th>Tipo de usuario</th>
                                                <th>Estado</th>
                                            </tr>
                                            <tbody class='BusquedaRapida'>
                                                <?php 
                                                    while ($row=mysqli_fetch_array($query_buffet)) {
                                                        $dni=$row['dni'];
                                                        $tipo_usuario=$row['tipo_usuario'];
                                                        $id_tipo_usuario=$row['id_tipo_usuario'];

                                                        if ($id_tipo_usuario==2) {
                                                            $sql="SELECT personal.nombre, personal.apellido FROM personal WHERE personal.dni='".$dni."';";
                                                            $query_personal=mysqli_query($con2, $sql);
                                                            $row2=mysqli_fetch_array($query_personal);
                                                        }else{
                                                            $sql="SELECT alumnos.nombre, alumnos.apellido FROM alumnos WHERE alumnos.dni='".$dni."';";
                                                            $query_alumno=mysqli_query($con2, $sql);
                                                            $row2=mysqli_fetch_array($query_alumno);
                                                        }

                                                        $nombre_completo=$row2['nombre']." ".$row2['apellido'];

                                                        echo "
                                                            <tr>
                                                                <td>".$dni."</td>
                                                                <td>".$nombre_completo."</td>
                                                                <td>".$tipo_usuario."</td>
                                                                <td>
                                                                    <button class='btn btn-primary' id='btn-desbloquear' data-dni='".$dni."' data-nombre_completo='".$nombre_completo."'>
                                                                        Desbloquear
                                                                    </button>
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
        <!-- .content -->
    </div><!-- /#right-panel -->
</body>
</html>
<!--<script src="assets/js/main.js"></script>-->
<script>
  /*function Validar(nombre_completo,dni){
     eliminar=confirm("¿Seguro desea desbloquear a: "+nombre_completo+" ?");
     if (eliminar){   
      window.location.href="../php/desbloquear_usuario.php?pdocu="+dni;
     }else{

    }
  }*/
</script>
<script>
  $(document).on("click", "#btn-desbloquear", function(){
    var nombre_completo = $(this).data("nombre_completo")
    var dni = $(this).data("dni");
    swal({
      title: "¿Seguro desea desbloquear: "+nombre_completo+"?",
      text: "El usuario sera desbloqueado del sistema",
      icon: "warning",
      buttons: ["Cancelar", "Aceptar"],
    })
    .then((confirmar) => {
      if (confirmar) {
        swal("Usuario desbloqueado correctamente!", {
          icon: "success",
          button: true,
        })
        .then((redireccion) => {
          if (redireccion) {
            window.location.href="../php/desbloquear_usuario.php?pdocu="+dni;
          }
        });
      }
    });
    
  })
</script>
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