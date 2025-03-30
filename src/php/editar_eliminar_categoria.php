<?php 
	include("conexion_bdd.php");

	$id=$_GET['id'];
	$categoria=$_GET['categoria'];
	$accion=$_GET['accion'];

	if ($accion==1) {
		$sql="UPDATE categoria_menu SET id='".$id."', categoria='".$categoria."';";
		$query=mysqli_query($con, $query);
		header("Location: ../admin/editar_eliminar_categoria.php");	
	}else if($accion==2){
		$sql="DELETE FROM categoria_menu WHERE id='".$id."';";
		$query=mysqli_query($con, $sql);
		header("Location: ../admin/editar_eliminar_categoria.php");
	}
?>