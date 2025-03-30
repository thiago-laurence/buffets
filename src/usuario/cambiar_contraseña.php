<?php require("../php/conexion_bdd.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Buffet'S - Cambiar contraseña</title>
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<style type="text/css">
		@media(min-width: 992px){
			.container-login100{
				margin-top: 50px;
			}
		}
	</style>
</head>
<body>
	<header><?php include("header.php"); ?></header>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
				<form action="../php/cambiar_contraseña_usuario.php" class="login100-form validate-form" method="POST" id="form-pass">
					<span class="login100-form-title p-b-55" style="color: #ccc;">
						Cambiar contraseña
					</span>

					<div class="wrap-input100 validate-input m-b-16">
						<input class="input100" type="text" name="contraseña_actual" id="contraseña_actual" placeholder="Contraseña actual" autocomplete="off" required="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock" style="color: #000;"></span>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16">
						<input class="input100" type="password" name="contraseña_nueva" id="contraseña_nueva" placeholder="Contraseña nueva" autocomplete="off" required="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock" style="color: #000;"></span>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16">
						<input class="input100" type="password" name="contraseña_repetida" id="contraseña_repetida" placeholder="Repita la contraseña" autocomplete="off" required="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock" style="color: #000;"></span>
						</span>
					</div>
					<div class="wrap-input100 valifate-input m-b-16" style="margin-bottom: 0px; display: none;" id="lbl-desiguales">
						<label style="font-size: 17px;">Las contraseñas no son iguales</label>
					</div>
					<div class="wrap-input100 valifate-input m-b-16" style="margin-bottom: 0px; display: none;" id="lbl-iguales">
						<label style="font-size: 17px;">Las contraseñas son iguales</label>
					</div>
					<div class="container-login100-form-btn p-t-25">
						<button class="login100-form-btn" type="submit" style="opacity: 0.5;" disabled="" id="btn-form">
							Cambiar
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	<?php include("footer.php"); ?>
</body>
</html>
<script>
	$(document).ready(function(){
		(function($) {
           $('#contraseña_repetida').keyup(function () {
                var pass_repetida = document.getElementById('contraseña_repetida');
                var valor_nueva = $('#contraseña_nueva').val();
                var valor_repetida = $('#contraseña_repetida').val();
                var pass_actual = $('#contraseña_actual').val();
                var password = '<?php echo $_SESSION['password'];?>';
                    if (valor_repetida==valor_nueva && valor_repetida!="" && valor_nueva!="" && pass_actual==password) {
                        $(pass_repetida).css({ "background-color": "#00a65a", "color": "#fff", "border": "#008d4c 5px solid" });
                        $('#lbl-desiguales').css({"display": "none"});
                        $('#lbl-iguales').css({"display": "inline"});
                        $('#btn-form').removeAttr('disabled');
                        $('#btn-form').css({"opacity": "1"});
                    }else if (valor_repetida!=valor_nueva) {
                        $(pass_repetida).css({ "background-color": "#dd4b39", "color": "#fff", "border": "#d33724 5px solid" });
                        $('#lbl-desiguales').css({"display": "inline"});
                        $('#lbl-iguales').css({"display": "none"});
                        $('#btn-form').attr('disabled', 'disabled');
                        $('#btn-form').css({"opacity": "0.5"});
                    }else{
                        $(pass_repetida).css({ "background-color": "#e6e6e6", "color": "#000", "border": "1px solid #ced4da" });
                        $('#lbl-desiguales').css({"display": "none"});
                        $('#lbl-iguales').css({"display": "none"});
                        $('#btn-form').attr('disabled', 'disabled');
                        $('#btn-form').css({"opacity": "0.5"});
                    }
            })
           $('#contraseña_nueva').keyup(function () {
                var pass_repetida = document.getElementById('contraseña_repetida');
                var valor_nueva = $('#contraseña_nueva').val();
                var valor_repetida = $('#contraseña_repetida').val();
                var pass_actual = $('#contraseña_actual').val();
                var password = '<?php echo $_SESSION['password'];?>';
                    if (valor_repetida==valor_nueva && valor_repetida!="" && valor_nueva!="" && pass_actual==password) {
                        $(pass_repetida).css({ "background-color": "#00a65a", "color": "#fff", "border": "#008d4c 5px solid" });
                        $('#lbl-desiguales').css({"display": "none"});
                        $('#lbl-iguales').css({"display": "inline"});
                        $('#btn-form').removeAttr('disabled');
                        $('#btn-form').css({"opacity": "1"});
                    }else if (valor_repetida!=valor_nueva){
                        $(pass_repetida).css({ "background-color": "#dd4b39", "color": "#fff", "border": "#d33724 5px solid" });
                        $('#lbl-desiguales').css({"display": "inline"});
                        $('#lbl-iguales').css({"display": "none"});
                        $('#btn-form').attr('disabled', 'disabled');
                        $('#btn-form').css({"opacity": "0.5"});
                    }else{
                        $(pass_repetida).css({ "background-color": "#e6e6e6", "color": "#000", "border": "1px solid #ced4da" });
                        $('#lbl-desiguales').css({"display": "none"});
                        $('#lbl-iguales').css({"display": "none"});
                        $('#btn-form').attr('disabled', 'disabled');
                        $('#btn-form').css({"opacity": "0.5"});
                    }
            })
           $('#contraseña_actual').keyup(function () {
                var pass_repetida = document.getElementById('contraseña_repetida');
                var valor_nueva = $('#contraseña_nueva').val();
                var valor_repetida = $('#contraseña_repetida').val();
                var pass_actual = $('#contraseña_actual').val();
                var password = '<?php echo $_SESSION['password'];?>';
                    if (valor_repetida==valor_nueva && valor_repetida!="" && valor_nueva!="" && pass_actual==password) {
                        $(pass_repetida).css({ "background-color": "#00a65a", "color": "#fff", "border": "#008d4c 5px solid" });
                        $('#lbl-desiguales').css({"display": "none"});
                        $('#lbl-iguales').css({"display": "inline"});
                        $('#btn-form').removeAttr('disabled');
                        $('#btn-form').css({"opacity": "1"});
                    }else if (valor_repetida!=valor_nueva){
                        $(pass_repetida).css({ "background-color": "#dd4b39", "color": "#fff", "border": "#d33724 5px solid" });
                        $('#lbl-desiguales').css({"display": "inline"});
                        $('#lbl-iguales').css({"display": "none"});
                        $('#btn-form').attr('disabled', 'disabled');
                        $('#btn-form').css({"opacity": "0.5"});
                    }else{
                        $(pass_repetida).css({ "background-color": "#e6e6e6", "color": "#000", "border": "1px solid #ced4da" });
                        $('#lbl-desiguales').css({"display": "none"});
                        $('#lbl-iguales').css({"display": "none"});
                        $('#btn-form').attr('disabled', 'disabled');
                        $('#btn-form').css({"opacity": "0.5"});
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
            if ($('input[type="password"]').val()=="" || $('input[type="text"]').val()=="") {
                swal({title: "Error en la carga!", text: "Se deben completar todos los campos solicitados.", icon: "warning",});
            }else{
                $.ajax({
                    type: "POST",
                    url: "../php/cambiar_contraseña_usuario.php",
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
                            swal({title: "Error en la carga!", icon: "warning",});
                        }
                    }
                });
                return false;
            }
        });
    });
</script>