<?php 
	include("conexion_bdd.php");
	
	$pedir_desde=$_POST['pedir_desde'];
	$pedir_hasta=$_POST['pedir_hasta'];
	$cancelar_desde=$_POST['cancelar_desde'];
	$cancelar_hasta=$_POST['cancelar_hasta'];
	$retirar_desde=$_POST['retirar_desde'];
	$retirar_hasta=$_POST['retirar_hasta'];
	$consulta="UPDATE buffet_horas SET hora_pedido_desde='".$pedir_desde."', hora_pedido_hasta='".$pedir_hasta."', tiempo_cancelacion_desde='".$cancelar_desde."', hora_cancelacion_hasta='".$cancelar_hasta."', hora_retiro_desde='".$retirar_desde."', hora_retiro_hasta='".$retirar_hasta."';";
	$ejecutar_consulta=mysqli_query($con, $consulta);
	echo $ejecutar_consulta;
?>