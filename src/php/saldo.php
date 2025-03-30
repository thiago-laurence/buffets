<?php 
	include("conexion_bdd.php");

	if(isset($_POST['dni'])){
		$dni=$_POST['dni'];
		$saldo=$_POST['saldo'];
		$consulta="UPDATE usuario SET saldo='".$saldo."' WHERE dni=".$dni."";
		$ejecutar_consulta=mysqli_query($con, $consulta);
		if($ejecutar_consulta){
			header("Location: ../admin/modificar_saldo.php");
		}else{
			echo '<script>alert("Error")</script>';
		}
	}
?>