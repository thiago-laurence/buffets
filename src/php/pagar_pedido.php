<?php 
	include("conexion_bdd.php");
	include("sesion.php");

	$total=$_GET['total'];
	

	if($pagar_pedido=mysqli_query($con, "UPDATE usuario INNER JOIN pedido ON usuario.dni=pedido.dni SET usuario.saldo='".$total."', 
	pedido.estado_pago=2 WHERE pedido.dni='".$_SESSION['documento']."';")){
		header("Location: ../usuario/carrito.php");
	}else
	{
	  echo "error";
	}
?>