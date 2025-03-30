<?php 
	include("../php/sesion.php");
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>Buffet'S - Nuevo Admnistrador</title>
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
                        <h1>Nuevo administrador</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="content mt-3">
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="container">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <form action="../php/nuevo_admin.php" id="form_admin" method="POST">
                                    <div class="card">
                                        <div class="card-header"><strong>Añadir un nuevo administrador</strong></div>
                                        <div class="card-body card-block">
                                            <div class="form-group">
                                                <label for="company" class="form-control-label">DNI</label><input type="number" id="dni" placeholder="Ingrese el documento" min="0" max="" class="form-control" name="dni" required autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="vat" class=" form-control-label">Nombre</label><input type="text" id="nombre" placeholder="Ingrese su nombre" class="form-control" name="nombre" required autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="vat" class=" form-control-label">Apellido</label><input type="text" id="apellido" placeholder="Ingrese su apellido" class="form-control" name="apellido" required autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="vat" class=" form-control-label">Contraseña</label><input type="password" id="contraseña-nueva" placeholder="Ingrese su contraseña" class="form-control" name="contraseña" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="vat" class=" form-control-label">Repita la contraseña</label><input type="password" id="contraseña-repetida" placeholder="Vuelva a ingresar la contraseña" class="form-control" name="contraseña_repetida" autocomplete="off">
                                            </div>
                                            <div class="form-group" id="lbl-desiguales" style="display: none;">
                                                <label class="form-control-label" style="font-size: 17px;">Las contraseñas no son iguales</label>
                                            </div>
                                            <div class="form-group" id="lbl-iguales" style="display: none;">
                                                <label class="form-control-label" style="font-size: 17px;">Las contraseñas son iguales</label>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" value="Agregar" id="btn-enviar" name="enviar" class="btn btn-primary btn-lg" disabled>Subir</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- .row -->
                </div><!-- .animated -->
            </div><!-- .content -->
        </div>
        
    </div><!-- /#right-panel -->
</body>
</html>
<script>    
   $('#contraseña-nueva').keyup(function () {
        var nombre = $('#nombre').val();
        var apellido = $('#apellido').val();
        var dni = $('#dni').val();
        var pass_nueva = document.getElementById('contraseña-nueva');
        var valor_nueva = $('#contraseña-nueva').val();
        var valor_repetida = $('#contraseña-repetida').val();
        var pass_repetida = document.getElementById('contraseña-repetida');
            if (valor_repetida==valor_nueva && valor_nueva!="" && valor_repetida!="") {
                $(pass_repetida).css({ "background-color": "#00a65a", "color": "#fff", "border": "#008d4c 5px solid" });
                $('#lbl-desiguales').css({"display": "none"});
                $('#lbl-iguales').css({"display": "inline"});
                if (nombre!="" && apellido!="" && dni!="") {
                    $('#btn-enviar').removeAttr('disabled');
                }
            }else if (valor_repetida!=valor_nueva) {
                $(pass_repetida).css({ "background-color": "#dd4b39", "color": "#fff", "border": "#d33724 5px solid" });
                $('#lbl-desiguales').css({"display": "inline"});
                $('#lbl-iguales').css({"display": "none"});
                $('#btn-enviar').attr('disabled', 'disabled');
            }else if(valor_nueva=="" && valor_repetida==""){
                $(pass_repetida).css({ "background-color": "#e6e6e6", "color": "#000", "border": "1px solid #ced4da" });
                $('#lbl-desiguales').css({"display": "none"});
                $('#lbl-iguales').css({"display": "none"});
                $('#btn-form').attr('disabled', 'disabled');
            }
    })
   $('#contraseña-repetida').keyup(function () {
        var nombre = $('#nombre').val();
        var apellido = $('#apellido').val();
        var dni = $('#dni').val();
        var pass_nueva = document.getElementById('contraseña-nueva');
        var valor_nueva = $('#contraseña-nueva').val();
        var valor_repetida = $('#contraseña-repetida').val();
        var pass_repetida = document.getElementById('contraseña-repetida');

            if (valor_repetida==valor_nueva && valor_nueva!="" && valor_repetida!="") {
                $(pass_repetida).css({ "background-color": "#00a65a", "color": "#fff", "border": "#008d4c 5px solid" });
                $('#lbl-desiguales').css({"display": "none"});
                $('#lbl-iguales').css({"display": "inline"});
                if (nombre!="" && apellido!="" && dni!="") {
                    $('#btn-enviar').removeAttr('disabled');

                }
            }else if (valor_repetida!=valor_nueva) {
                $(pass_repetida).css({ "background-color": "#dd4b39", "color": "#fff", "border": "#d33724 5px solid" });
                $('#lbl-desiguales').css({"display": "inline"});
                $('#lbl-iguales').css({"display": "none"});
                $('#btn-enviar').attr('disabled', 'disabled');
            }else if(valor_nueva=="" && valor_repetida==""){
                $(pass_repetida).css({ "background-color": "#e6e6e6", "color": "#000", "border": "1px solid #ced4da" });
                $('#lbl-desiguales').css({"display": "none"});
                $('#lbl-iguales').css({"display": "none"});
                $('#btn-form').attr('disabled', 'disabled');
            }
    })
</script>
<script>
    $(document).ready(function(){
        $('#btn-enviar').click(function(){
            var pass_repetida = document.getElementById('contraseña-repetida');
            var datos = $('#form_admin').serialize();
            if ($('input[type="text"]').val()=="" || $('input[type="number"]').val()=="" || $('input[type="password"]').val()=="") {
                swal({title: "Error en la carga!", text: "Se deben completar todos los campos solicitados.", icon: "warning",});
            }else{
                $.ajax({
                    type: "POST",
                    url: "../php/nuevo_admin.php",
                    data: datos,
                    success:function(respuesta){
                        if (respuesta==1) {
                            swal("Administrador añadido!", "El nuevo administrador fue añadido al sistema correctamente!", "success");
                            $('input[type="text"]').val('');
                            $('input[type="number"]').val('');
                            $('input[type="password"]').val('');
                            $(pass_repetida).css({ "background-color": "#e6e6e6", "color": "#000", "border": "1px solid #ced4da" });
                            $('#lbl-desiguales').css({"display": "none"});
                            $('#lbl-iguales').css({"display": "none"});
                            $('#btn-form').attr('disabled', 'disabled');
                        }else{
                            swal("Error en la carga!", "warning");
                        }
                    }
                });
                return false;
            }
        });
    });
</script>