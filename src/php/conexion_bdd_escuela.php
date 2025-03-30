<?php
function conectar2(){
	define('SERVIDOR_MYSQL2','mysql_db');
	define('USUARIO_MYSQL2','user-escuela');
	define('PASSWORD_MYSQL2','password');
	define('BASE_DATOS2','escuela');

	$con2=mysqli_connect(SERVIDOR_MYSQL2,USUARIO_MYSQL2,PASSWORD_MYSQL2,BASE_DATOS2) or die("Error en la conexion");
	mysqli_select_db($con2,BASE_DATOS2) or die("Problemas al selecionar la base de datos");
	return $con2;
}

$con2=conectar2();
?>