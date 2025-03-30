<?php 
	require("conexion_bdd.php");
	require("conexion_bdd_escuela.php");
	include("sesion.php");

	$sql="SELECT tipo_usuario FROM usuario WHERE dni='".$_SESSION['documento']."';";
	$query=mysqli_query($con, $sql);
	$row=mysqli_fetch_array($query);
	$tipo_usuario=$row['tipo_usuario'];

	$pass_old=$_POST['contraseña_actual'];
	$pass_new=$_POST['contraseña_nueva'];
	$pass_new_repe=$_POST['contraseña_repetida'];	

	if ($tipo_usuario==1) {
		if($pass_old==$_SESSION["password"] && $pass_new==$pass_new_repe){
			$consulta="UPDATE alumnos SET clave='".$pass_new."' WHERE dni='".$_SESSION['documento']."';";
			$ejecutar_consulta=mysqli_query($con2, $consulta);
			$_SESSION["password"]=$pass_new;
			echo $ejecutar_consulta;
		}
	}else if($tipo_usuario==2){
		if($pass_old==$_SESSION["password"] && $pass_new==$pass_new_repe){
			$consulta="UPDATE personal SET pass='".$pass_new."' WHERE dni='".$_SESSION['documento']."';";
			$ejecutar_consulta=mysqli_query($con2, $consulta);
			$_SESSION["password"]=$pass_new;
			echo $ejecutar_consulta;
		}
	}
?>