<?php 
	include("conexion_bdd.php");

	$categoria=$_POST['new_categoria'];

	$sql="INSERT INTO categoria_menu (categoria) VALUES ('$categoria')";
	$consulta=mysqli_query($con, $sql);
	echo $consulta;
?>