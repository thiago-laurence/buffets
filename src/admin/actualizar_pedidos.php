<?php 
	include("../php/conexion_bdd.php");

	$id_pedido=$_POST['id_pedido'];
	$id_estado=$_POST['id_estado'];
	$id_estado_pago=$_POST['id_estado_pago'];

	$consulta=mysqli_query($con, "UPDATE pedido SET estado='".$id_estado."', estado_pago='".$id_estado_pago."' WHERE id_pedido='".$id_pedido."'");

	if (!$consulta) {
		echo "ERROR";
	}else{
		echo "Se actualizaron los datos";
	}
?>