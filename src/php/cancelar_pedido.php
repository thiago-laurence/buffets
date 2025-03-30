<?php 
	include("conexion_bdd.php");
	include("sesion.php");

	$id=$_GET['id'];
	$gasto=$_GET['total_gasto'];
	$estado_pago=$_GET['estado_pago_id'];
	$saldo=$_GET['saldo'];
	$id_menu=$_GET['id_menu'];
	$reintegro=$saldo+$gasto;

	if ($estado_pago==2) {
		$sql="UPDATE usuario INNER JOIN pedido ON usuario.dni=pedido.dni SET usuario.saldo='".$reintegro."' WHERE pedido.dni='".$_SESSION['documento']."';";
		$sql2="DELETE FROM pedido WHERE id_pedido='".$id."'";
		$sql3="UPDATE menu SET stock=stock+1 WHERE id_menu='".$id_menu."';";
		$reintegro_stock=mysqli_query($con, $sql3);
		$consulta_reintegro=mysqli_query($con, $sql);
		$consulta_cancelar_pedido=mysqli_query($con, $sql2);
		header("Location: ../usuario/menu_pedido.php");
	}else if($estado_pago==1){
		$sql="DELETE FROM pedido WHERE id_pedido='".$id."';";
		$cancelar_pedido=mysqli_query($con, $sql);
		$sql2="UPDATE menu SET stock=stock+1 WHERE id_menu='".$id_menu."';";
		$reintegrar_stock=mysqli_query($con, $sql2);
		header("Location: ../usuario/menu_pedido.php");
	}else{
		echo "ERROR";
	}
?>