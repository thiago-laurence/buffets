<?php
function conectar(){
	define('SERVIDOR_MYSQL','mysql_db');
	define('USUARIO_MYSQL','user-buffets');
	define('PASSWORD_MYSQL','password');
	define('BASE_DATOS','buffets');

	$con=mysqli_connect(SERVIDOR_MYSQL,USUARIO_MYSQL,PASSWORD_MYSQL,BASE_DATOS) or die("Error en la conexion");
	mysqli_select_db($con,BASE_DATOS) or die("Problemas al selecionar la base de datos");
	return $con;
}

$con=conectar();
?>