<?php 
	include("conexion_bdd.php");

	$dni=$_GET['dni'];

	if ($query=mysqli_query($con, "DELETE FROM admin WHERE dni=$dni")) {
		header("Location: ../admin/perfil_admin.php");
	}else{
		echo "ERROR";
	}
?>