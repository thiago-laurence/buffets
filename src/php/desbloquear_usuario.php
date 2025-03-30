<?php  
	include("conexion_bdd.php");


	if(isset($_GET['pdocu'])){
		$dni=$_GET['pdocu'];

		$consulta="UPDATE usuario SET estado=1 WHERE dni=".$dni."";
		$ejecutar_consulta=mysqli_query($con, $consulta);
		if($ejecutar_consulta){
			header("Location: ../admin/usuarios_bloqueados.php");
		}else{
			echo '<script>alert("Error")</script>';
		}
	}
?>