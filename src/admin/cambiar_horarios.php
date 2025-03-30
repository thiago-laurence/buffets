<?php 
    include("../php/sesion.php");
    include("../php/conexion_bdd.php");

    $consulta=mysqli_query($con, "SELECT * FROM buffet_horas;");
    while($row=mysqli_fetch_array($consulta)){
        $pedir_desde=$row['hora_pedido_desde'];
        $pedir_hasta=$row['hora_pedido_hasta'];
        $cancelar_desde=$row['tiempo_cancelacion_desde'];
        $cancelar_hasta=$row['hora_cancelacion_hasta'];
        $retirar_desde=$row['hora_retiro_desde'];
        $retirar_hasta=$row['hora_retiro_hasta'];
    }
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>Buffet'S - Cambiar horarios</title>
    <style type="text/css">
        form input{
            padding: 5px 10px;
            font-size: 20px;
            margin: 10px;
        }
        @media(max-width: 992px){
            form div{
                padding: 20px;
                margin: 10px;
            }
        }
    </style>
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
                        <h1>Cambiar horarios</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="content mt-3">
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="container">
                            <form action="../php/cambiar_horarios.php" id="form-horarios" method="POST" style="padding-bottom: 50px;">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <h4>
                                    Horario para encargar desde: 
                                </h4>
                                <input type="time" name="pedir_desde" value="<?php echo $pedir_desde;?>">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <h4>
                                    Horario para encargar hasta: 
                                </h4>
                                <input type="time" name="pedir_hasta" value="<?php echo $pedir_hasta;?>">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <h4>
                                    Horario para cancelar encargue desde: 
                                </h4>
                                <input type="time" name="cancelar_desde" value="<?php echo $cancelar_desde;?>">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <h4>
                                    Horario para cancelar encargue hasta: 
                                </h4>
                                <input type="time" name="cancelar_hasta" value="<?php echo $cancelar_hasta;?>">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <h4>
                                    Horario para retirar encargue desde: 
                                </h4>
                                <input type="time" name="retirar_desde" value="<?php echo $retirar_desde;?>">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <h4>
                                    Horario para retirar encargue hasta: 
                                </h4>
                                <input type="time" name="retirar_hasta" value="<?php echo $retirar_hasta;?>">
                                <br><br><br>
                            </div>
                            <center>
                                <button type="submit" id="btn-cambiar" name="enviar" class="btn btn-lg btn-primary">
                                    Cambiar
                                </button>
                            </center>
                        </form>
                        </div>
                    </div><!-- .row -->
                </div><!-- .animated -->
            </div><!-- .content -->
        </div>
        
    </div><!-- /#right-panel -->
</body>
</html>
<script>
    $(document).on('click', '#btn-cambiar', function(){
        var datos = $('#form-horarios').serialize();
        $.ajax({
            type: "POST",
            url: "../php/cambiar_horarios.php",
            data: datos,
            success:function(resultado){
                if (resultado==1) {
                    swal("Horarios actualizados!", "Los horarios fueron actualizados correctamente en el sistema", "success");
                }else{
                    swal({title: "Error en la carga", icon: "warning",});
                }
            }
        });
        return false; 
    })
</script>