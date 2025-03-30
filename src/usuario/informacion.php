<?php 
	require("../php/conexion_bdd.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Buffet's - Bloqueado</title>
	<link rel="icon" href="images/hamburguesa_icono.png">
</head>
<body>
	<header><?php include("header.php"); ?></header>
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				
            	<div class="container">
					<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
						<div class="col-md-8 col-sm-12 text-center ftco-animate">
							<span class="subheading">Información</span>
							<h1 class="mb-4">Terminos y condiciones</h1>
							<p class="mb-4 mb-md-5">Reglamentación a la hora de utilizar la plataforma.</p>
						</div>
					</div>
        		</div>
			</div>
		</div>
	</div>
	<section class="ftco-about d-md-flex">
    	<div class="one-half img"><img src="images/informacion.jpg" width="100%"></div>
    	<div class="one-half ftco-animate">
    		<div class="overlap">
	        <div class="heading-section ftco-animate ">
	        	<span class="subheading" style="margin-bottom: 20px;">Horarios de uso de la plataforma Buffte'S</span>
	        </div>
	        <div>
				<p>
					A continuación se detallara los horarios estipulados para poder realizar el encargue de la comida, horarios para realizar la cancelación del pedido y el horario para retirar el pedido ya realizado.
				<br>
				Todo pedido que haya sido cancelado estara nuevamente disponible para su compra en el buffet.
				<br>
					<span><p style="color: #e60000;">ATENCIÓN:</p></span>
					Cabe aclarar que en caso de no retirar el pedido realizado logicamente sin haberlo cancelado anteriormente, se tomara como medida de consecuencia el bloqueo de la cuenta impidiendo la realización de un nuevo encargue hasta que el usuario afectado pague en el buffet el pedido no retirado. Una vez realizado el pago, se le desbloqueara la cuenta.
				<br>
				<?php $query=mysqli_query($con, "SELECT * FROM buffet_horas;"); $row=mysqli_fetch_array($query); ?>
					Horarios para encargar:  de <?php echo $row['hora_pedido_desde']." AM, hasta las ".$row['hora_pedido_hasta']." AM"; ?>
				<br>
					Horarios para cancelar el pedido: de <?php echo $row['tiempo_cancelacion_desde']." AM, hasta las ".$row['hora_cancelacion_hasta']." AM"; ?>
				<br>
					Horarios para retirar el pedido: de <?php echo $row['hora_retiro_desde']." AM, hasta las ".$row['hora_retiro_hasta']." PM"; ?>
				</p>

	  			</div>
  			</div>
    	</div>
    </section>
	<?php include("footer.php"); ?>
</body>
</html>