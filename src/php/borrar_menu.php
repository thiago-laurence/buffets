<?php
include("conexion_bdd.php");
$id=$_GET['id'];


if($result=mysqli_query($con, "DELETE FROM menu where id_menu=$id;")){
	header("Location: ../admin/editar_eliminar_menu.php");
?>
	
	<script type="text/javascript" src="alerta.js"></script>

<?php


}else
{
  echo "error";
}