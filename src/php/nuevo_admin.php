<?php 
	include("conexion_bdd.php");

	$dni=$_POST['dni'];
	$nombre=$_POST['nombre'];
	$apellido=$_POST['apellido'];
	$contraseña=$_POST['contraseña'];
	$contraseña_repetida=$_POST['contraseña_repetida'];

	if ($contraseña==$contraseña_repetida) {
		$contraseña=sha1($_POST['contraseña']);
		$sql="INSERT INTO admin (dni, nombre, apellido, pass) VALUES ('".$dni."', '".$nombre."', '".$apellido."', '".$contraseña."')";
		$query=mysqli_query($con, $sql);
		echo $query;
	}
?>