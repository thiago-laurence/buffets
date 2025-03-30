<?php
include("conexion_bdd.php");

$precio = $_POST['precio'];
$categoria=$_POST['categoria'];
$plato = $_POST['plato'];
$estado = $_POST['estado'];
$stock = $_POST['stock'];
$descripcion = $_POST['descripcion'];

$nombre = $_FILES['imagen']['name'];
$nombrer = strtolower($nombre);
$cd=$_FILES['imagen']['tmp_name'];
$ruta = "../usuario/images/menu/" . $_FILES['imagen']['name'];
$destino = "../usuario/images/menu/".$nombrer;
$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);

if (!empty($resultado)){
	$sql="INSERT INTO menu (plato,precio,descripcion,categoria,estado,stock,url_img) VALUES ('".$plato."','".$precio."','".$descripcion."','".$categoria."','".$estado."','".$stock."','".$nombre."')";
	$query=mysqli_query($con, $sql);
	//echo $query;
	echo $query?'ok':'err';
}else{
	$sql="INSERT INTO menu (plato,precio,descripcion,categoria,estado,stock) VALUES ('".$plato."','".$precio."','".$descripcion."','".$categoria."','".$estado."','".$stock."')";
	$query=mysqli_query($con, $sql);
	echo $query?'ok':'err';
	//echo $query;
}
?>