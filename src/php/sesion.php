<?php
ob_start();
if (session_status() == PHP_SESSION_NONE) { 
	session_name("loginbuffet");
	session_start(); 
} 
if(!isset($_SESSION["documento"]) || $_SESSION["documento"] ==""){
	$_SESSION["menu"]="menu_de_muestra.php";
	$_SESSION["logout_icono"]="icon icon-sign-in";
	$_SESSION["logout"]="iniciar_sesion.php";
	$_SESSION["cerrar_sesion"]="iniciar sesion";
	$_SESSION["nombre"]="";
	$_SESSION["apellido"]="";
	$_SESSION['cambiar_contraseña']="<li class='nav-item'><a href='informacion.php' class='nav-link'><span class='icon icon-info' style='margin-right: 5px; font-size: 20px;'></span>Información</a></li>";
	$_SESSION['carrito']="";
}else{
	if ($_SESSION["menu"]=="../usuario/bloqueado.php") {
		$_SESSION['carrito']="";
		$_SESSION["logout_icono"]="icon icon-sign-out";
		$_SESSION["logout"]="../php/logout.php";
		$_SESSION["cerrar_sesion"]="cerrar sesion";
		$_SESSION['cambiar_contraseña']="<li class='nav-item dropdown'>
			<a href='informacion.php' class='nav-link dropdown-toggle' id='dropdown04' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='icon icon-info' style='margin-right: 5px; font-size: 20px;'></span>Información</a>
			<div class='dropdown-menu' aria-labelledby='dropdown04'>
				<a class='dropdown-item' href='informacion.php'>Información</a>
				<a class='dropdown-item' href='cambiar_contraseña.php'>Cambiar contraseña</a>
			</div>
		</li>";
	}else if(!isset($_SESSION['admin'])){
		$sql="SELECT COUNT(id_pedido) AS CANTIDAD FROM pedido WHERE pedido.dni=".$_SESSION['documento'].";";
		$query=mysqli_query($con, $sql);
		$row=mysqli_fetch_array($query);
		$_SESSION['carrito']="<span class='bag d-flex justify-content-center align-items-center'><small>".$row['CANTIDAD']."</small></span>";
		$_SESSION["menu"]="menu_pedido.php";
		$_SESSION["logout"]="../php/logout.php";
		$_SESSION["logout_icono"]="icon icon-sign-out";
		$_SESSION["cerrar_sesion"]="cerrar sesion";
		$_SESSION['cambiar_contraseña']="<li class='nav-item dropdown'>
			<a href='informacion.php' class='nav-link dropdown-toggle' id='dropdown04' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='icon icon-info' style='margin-right: 5px; font-size: 20px;'></span>Información</a>
			<div class='dropdown-menu' aria-labelledby='dropdown04'>
				<a class='dropdown-item' href='informacion.php'>Información</a>
				<a class='dropdown-item' href='cambiar_contraseña.php'>Cambiar contraseña</a>
			</div>
		</li>";
	}
}
ob_end_flush();
?>