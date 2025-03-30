<?php
include("conexion_bdd.php");

$precio = $_POST['precio'];
$categoria=$_POST['categoria'];
$plato = $_POST['plato'];
$estado = $_POST['estado'];
$stock = $_POST['stock'];
$descripcion = $_POST['descripcion'];
$id=$_POST['id_menu'];

$nombre = $_FILES['imagen']['name'];
$nombrer = strtolower($nombre);
$cd=$_FILES['imagen']['tmp_name'];
$ruta = "../usuario/images/menu/" . $_FILES['imagen']['name'];
$destino = "../usuario/images/menu/".$nombrer;
$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);

if (!empty($resultado)){
	$sql="UPDATE menu SET plato='".$plato."', precio='".$precio."', descripcion='".$descripcion."', categoria='".$categoria."', estado='".$estado."', stock='".$stock."', url_img='".$nombre."' WHERE id_menu='".$id."';";
	$query=mysqli_query($con, $sql); 
	//echo $query;
	echo $query?'ok':'err';
}else{
	$sql="UPDATE menu SET plato='".$plato."', precio='".$precio."', descripcion='".$descripcion."', categoria='".$categoria."', estado='".$estado."', stock='".$stock."' WHERE id_menu='".$id."';";
    $query=mysqli_query($con, $sql); 
	//echo $query;
	echo $query?'ok':'err';
}
?>