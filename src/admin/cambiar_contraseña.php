<?php 
    include("../php/sesion.php");
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>Buffet'S - Cambiar contraseña</title>
    <style type="text/css">
        form{
            margin: auto;
        }
        form label{
            font-size: 20px;
        }
        .form-group input{
            padding: 5px 10px;
            margin-bottom: 20px;
            width: 100%;
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
                        <h1>Cambiar contraseña</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">
            <div class="content mt-3">
                <div class="animated fadeIn">
                    <div class="row">
                        <form action="../php/cambiar_contraseña.php" id="form-pass" method="POST" style="width: 70%;">
                            <label>Actualice su contraseña</label>
                            <br><br>
                            <div class="form-group">
                                <input type="text" name="contraseña_actual" class="form-control" id="contraseña_actual" placeholder="Contraseña actual" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="password" name="contraseña_nueva" class="form-control" id="contraseña_nueva" placeholder="Contraseña nueva" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="password" name="contraseña_repetida" class="form-control" id="contraseña_repetida" placeholder="Repita la contraseña" autocomplete="off">
                            </div>
                            <div class="form-group" id="lbl-desiguales" style="display: none;">
                                <label class="form-control-label" style="font-size: 17px;">Las contraseñas no son iguales</label>
                            </div>
                            <div class="form-group" id="lbl-iguales" style="display: none;">
                                <label class="form-control-label" style="font-size: 17px;">Las contraseñas son iguales</label>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="enviar" id="btn-form" disabled="" class="btn btn-lg btn-primary">Cambiar</button>

                            </div>
                        </form>
                    </div><!-- .row -->
                </div><!-- .animated -->
            </div><!-- .content -->
        </div>
        
    </div><!-- /#right-panel -->
</body>
</html>
<script src="assets/js/rollups/sha1.js"></script>
<script>    
    $(document).ready(function(){
        (function($) {
           $('#contraseña_repetida').keyup(function () {
                var pass_repetida = document.getElementById('contraseña_repetida');
                var valor_nueva = $('#contraseña_nueva').val();
                var valor_repetida = $('#contraseña_repetida').val();
                var pass_actual = $('#contraseña_actual').val();
                sha1 = CryptoJS.SHA1(pass_actual);
                var password = '<?php echo $_SESSION['password'];?>';

                    if (valor_repetida==valor_nueva && valor_repetida!="" && valor_nueva!="" && sha1==password) {
                        $(pass_repetida).css({ "background-color": "#00a65a", "color": "#fff", "border": "#008d4c 5px solid" });
                        $('#lbl-desiguales').css({"display": "none"});
                        $('#lbl-iguales').css({"display": "inline"});
                        $('#btn-form').removeAttr('disabled');
                    }else if (valor_repetida!=valor_nueva) {
                        $(pass_repetida).css({ "background-color": "#dd4b39", "color": "#fff", "border": "#d33724 5px solid" });
                        $('#lbl-desiguales').css({"display": "inline"});
                        $('#lbl-iguales').css({"display": "none"});
                        $('#btn-form').attr('disabled', 'disabled');
                    }else{
                        $(pass_repetida).css({ "background-color": "#e6e6e6", "color": "#000", "border": "1px solid #ced4da" });
                        $('#lbl-desiguales').css({"display": "none"});
                        $('#lbl-iguales').css({"display": "none"});
                        $('#btn-form').attr('disabled', 'disabled');
                    }
            })
           $('#contraseña_nueva').keyup(function () {
                var pass_repetida = document.getElementById('contraseña_repetida');
                var valor_nueva = $('#contraseña_nueva').val();
                var valor_repetida = $('#contraseña_repetida').val();
                var pass_actual = $('#contraseña_actual').val();
                sha1 = CryptoJS.SHA1(pass_actual);
                var password = '<?php echo $_SESSION['password'];?>';
                    if (valor_repetida==valor_nueva && valor_repetida!="" && valor_nueva!="" && sha1==password) {
                        $(pass_repetida).css({ "background-color": "#00a65a", "color": "#fff", "border": "#008d4c 5px solid" });
                        $('#lbl-desiguales').css({"display": "none"});
                        $('#lbl-iguales').css({"display": "inline"});
                        $('#btn-form').removeAttr('disabled');
                    }else if (valor_repetida!=valor_nueva){
                        $(pass_repetida).css({ "background-color": "#dd4b39", "color": "#fff", "border": "#d33724 5px solid" });
                        $('#lbl-desiguales').css({"display": "inline"});
                        $('#lbl-iguales').css({"display": "none"});
                        $('#btn-form').attr('disabled', 'disabled');
                    }else{
                        $(pass_repetida).css({ "background-color": "#e6e6e6", "color": "#000", "border": "1px solid #ced4da" });
                        $('#lbl-desiguales').css({"display": "none"});
                        $('#lbl-iguales').css({"display": "none"});
                        $('#btn-form').attr('disabled', 'disabled');
                    }
            })
           $('#contraseña_actual').keyup(function () {
                var pass_repetida = document.getElementById('contraseña_repetida');
                var valor_nueva = $('#contraseña_nueva').val();
                var valor_repetida = $('#contraseña_repetida').val();
                var pass_actual = $('#contraseña_actual').val();
                sha1 = CryptoJS.SHA1(pass_actual);
                var password = '<?php echo $_SESSION['password'];?>';
                    if (valor_repetida==valor_nueva && valor_repetida!="" && valor_nueva!="" && sha1==password) {
                        $(pass_repetida).css({ "background-color": "#00a65a", "color": "#fff", "border": "#008d4c 5px solid" });
                        $('#lbl-desiguales').css({"display": "none"});
                        $('#lbl-iguales').css({"display": "inline"});
                        $('#btn-form').removeAttr('disabled');
                    }else if (valor_repetida!=valor_nueva){
                        $(pass_repetida).css({ "background-color": "#dd4b39", "color": "#fff", "border": "#d33724 5px solid" });
                        $('#lbl-desiguales').css({"display": "inline"});
                        $('#lbl-iguales').css({"display": "none"});
                        $('#btn-form').attr('disabled', 'disabled');
                    }else{
                        $(pass_repetida).css({ "background-color": "#e6e6e6", "color": "#000", "border": "1px solid #ced4da" });
                        $('#lbl-desiguales').css({"display": "none"});
                        $('#lbl-iguales').css({"display": "none"});
                        $('#btn-form').attr('disabled', 'disabled');
                    }
            })
        }(jQuery));
    });
</script>
<script>
    $(document).ready(function(){
        $('#btn-form').click(function(){
            var pass_repetida = document.getElementById('contraseña_repetida');
            var datos = $('#form-pass').serialize();
            if ($('input[type="password"]').val()=="") {
                swal({title: "Error en la carga!", text: "Se deben completar todos los campos solicitados.", icon: "warning",});
            }else{
                $.ajax({
                    type: "POST",
                    url: "../php/cambiar_contraseña.php",
                    data: datos,
                    success:function(respuesta){
                        if (respuesta==1) {
                            swal("Contraseña actualizada!", "La contraseña fue cambiada correctamente!", "success");
                            $('input[type="password"]').val('');
                            $('input[type="text"]').val('');
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