<?php 
	require("conexion_bdd.php");
	include("sesion.php");
	$pass_old=sha1($_POST['contraseña_actual']);
	$pass_new=$_POST['contraseña_nueva'];
	$pass_new_repe=$_POST['contraseña_repetida'];	
	if($pass_old==$_SESSION["password"] && $pass_new==$pass_new_repe){
		$consulta="UPDATE admin SET pass=SHA1('".$pass_new."') WHERE dni='".$_SESSION['documento']."';";
		$ejecutar_consulta=mysqli_query($con, $consulta);
		$_SESSION["password"]=sha1($pass_new);
		echo $ejecutar_consulta;
		//header("Location: ../admin/index.php");
	}else{
		header("Location: ../admin/cambiar_contraseña.php");
	}
?>