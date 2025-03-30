<?php 
	include("conexion_bdd.php");
	$menu=mysqli_query($con, "SELECT menu.plato, menu.id_menu, menu.categoria AS id_categoria, categoria_menu.categoria, menu.precio FROM menu INNER JOIN 
        categoria_menu ON menu.categoria=categoria_menu.id;");
    $menu2=mysqli_query($con, "SELECT menu.plato, menu.id_menu, menu.categoria AS id_categoria, categoria_menu.categoria, menu.precio FROM menu INNER JOIN 
        categoria_menu ON menu.categoria=categoria_menu.id;");

	$id=$_GET['id'];
	if ($id=="insertar") {
		$combo=$_POST['combo'];
		$descripcion=$_POST['descripcion'];
		$precio=$_POST['precio'];
		$stock=$_POST['stock'];
		$productos=$_POST['productos'];

		$nombre = $_FILES['imagen']['name'];
		$nombrer = strtolower($nombre);
		$cd=$_FILES['imagen']['tmp_name'];
		$ruta = "../usuario/images/menu/" . $_FILES['imagen']['name'];
		$destino = "../usuario/images/menu/".$nombrer;
		$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);

		if (!empty($resultado)){
			$sql="INSERT INTO combos (nombre, descripcion, precio, stock, img) VALUES ('".$combo."','".$descripcion."','".$precio."','".$stock."','".$nombre."');";
			$query=mysqli_query($con, $sql);

			$sql="SELECT max(id) AS id_combo FROM combos;";
			$query=mysqli_query($con, $sql);
			$row=mysqli_fetch_array($query);
			$id_combo=$row['id_combo'];

			for ($x=0; $x < count($productos); $x++) { 
				$sql="INSERT INTO combos_productos (id_combo, id_menu, cant_menu) VALUES ('$id_combo', '$productos[$x]', '0');";
				$query=mysqli_query($con, $sql);
			}
			//echo $query;
			echo $query?'ok':'err';
		}else{
			$sql="INSERT INTO combos (nombre, descripcion, precio, stock) VALUES ('".$combo."','".$descripcion."','".$precio."','".$stock."');";
			$query=mysqli_query($con, $sql);

			$sql="SELECT max(id) AS id_combo FROM combos;";
			$query=mysqli_query($con, $sql);
			$row=mysqli_fetch_array($query);
			$id_combo=$row['id_combo'];

			for ($x=0; $x < count($productos); $x++) { 
				$sql="INSERT INTO combos_productos (id_combo, id_menu, cant_menu) VALUES ('$id_combo', '$productos[$x]', '0');";
				$query=mysqli_query($con, $sql);
			}
			echo $query?'ok':'err';
			//echo $query;
		}
	}else if ($id=="borrar") {
		$id_combo=$_GET['id_combo'];
		$sql="DELETE FROM combos WHERE id='$id_combo';";
		$query=mysqli_query($con, $sql);
		echo $query?'ok':'err';
	}else if($id=="editar"){
		$sql="SELECT id_combo, id_menu FROM combos_productos;";
		$query=mysqli_query($con, $sql);
		$id_combo=$_GET['id_combo'];
		echo "
		<div id='productosv2'>
		<select data-placeholder='Productos registrados en el sistema' multiple class='standardSelect' tabindex='5' name='productos[]' id='selectProductos2'>
            <option value=''></option>
		";
			$pos=0;
            $vof=1;
            $selected=0;
            while ($row=mysqli_fetch_array($menu)) {
                $pos++;
                $plato=$row['plato'];
                $precio=$row['precio'];
                $id_menu=$row['id_menu'];
                $categoria=$row['categoria'];
                $id_categoria=$row['id_categoria'];
                if ($vof==1) {
                    echo "<optgroup label='".$categoria."'>";
                    $vof=0;
                }
                while ($row2=mysqli_fetch_array($query)) {
                	if ($row2['id_combo']==$id_combo && $row2['id_menu']==$id_menu) {
                		echo "<option value='".$id_menu."' data-precio='".$precio."' selected id='opciones-select'>".$plato."</option>";
                		$selected=1;
	                }
                }
                if ($selected==0) {
                	echo "<option value='".$id_menu."' data-precio='".$precio."'>".$plato."</option>";
                }else{
                	$selected=0;
                }
              	mysqli_data_seek($row2, 0);
              	$query=mysqli_query($con, $sql);

                mysqli_data_seek($menu2, $pos);
                $fila_id = mysqli_fetch_row($menu2);
                $id_sig=$fila_id[2];
                if ($id_sig!=$id_categoria) {
                    echo "</optgroup>";
                    $vof=1;  
                }
            }
		echo "</select> </div>";
	}else{
		$combo=$_POST['combo'];
		$descripcion=$_POST['descripcion'];
		$precio=$_POST['precio'];
		$stock=$_POST['stock'];
		$productos=$_POST['productos'];

		$nombre = $_FILES['imagen']['name'];
		$nombrer = strtolower($nombre);
		$cd=$_FILES['imagen']['tmp_name'];
		$ruta = "../usuario/images/menu/" . $_FILES['imagen']['name'];
		$destino = "../usuario/images/menu/".$nombrer;
		$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);

		if (!empty($resultado)){
			$sql="UPDATE combos SET nombre='".$combo."', descripcion='".$descripcion."', precio='".$precio."', stock='".$stock."', img='".$nombre."' WHERE id='".$id."';";
			$query=mysqli_query($con, $sql);

			$sql="DELETE FROM combos_productos WHERE id_combo='".$id."';";
			$query=mysqli_query($con, $sql);

			for ($x=0; $x < count($productos); $x++) { 
				$sql="INSERT INTO combos_productos (id_combo, id_menu, cant_menu) VALUES ('$id', '$productos[$x]', '0');";
				$query=mysqli_query($con, $sql);
			}
			//echo $query;
			// MUESTRO COMO 'OK' EL CARACTER 'ESPACIO' PARA QUE NO MUESTRE TEXTO 'OK' ENCIMA DEL SELECT
			echo $query?' ':'err';
		}else{
			$sql="UPDATE combos SET nombre='".$combo."', descripcion='".$descripcion."', precio='".$precio."', stock='".$stock."' WHERE id='".$id."';";
			$query=mysqli_query($con, $sql);

			$sql="DELETE FROM combos_productos WHERE id_combo='".$id."';";
			$query=mysqli_query($con, $sql);

			for ($x=0; $x < count($productos); $x++) { 
				$sql="INSERT INTO combos_productos (id_combo, id_menu, cant_menu) VALUES ('$id', '$productos[$x]', '0');";
				$query=mysqli_query($con, $sql);
			}
			// MUESTRO COMO 'OK' EL CARACTER 'ESPACIO' PARA QUE NO MUESTRE TEXTO 'OK' ENCIMA DEL SELECT
			echo $query?' ':'err';
			//echo $query;
		}
		echo "
		<div id='productosv2'>
            <select data-placeholder='Productos registrados en el sistema' multiple class='standardSelect' tabindex='5' name='productos[]' id='selectProductos'>
                <option value=''></option>";
                
                    $pos=0;
                    $vof=1;
                    while ($row=mysqli_fetch_array($menu)) {
                        $pos++;
                        $plato=$row['plato'];
                        $precio=$row['precio'];
                        $id_menu=$row['id_menu'];
                        $categoria=$row['categoria'];
                        $id_categoria=$row['id_categoria'];
                        if ($vof==1) {
                            echo "<optgroup label='".$categoria."'>";
                            $vof=0;
                        }
                        echo "<option value='".$id_menu."' data-precio='".$precio."'>".$plato."</option>";
                        mysqli_data_seek($menu2, $pos);
                        $fila_id = mysqli_fetch_row($menu2);
                        $id_sig=$fila_id[2];
                        if ($id_sig!=$id_categoria) {
                            echo "</optgroup>";
                            $vof=1;  
                        }
                    }
            echo "
            </select>
        </div> ";
	}
?>
<script src="vendors/chosen/chosen.jquery.min.js"></script>
<script>  
    jQuery(document).ready(function() {  
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Lo siento, no se encontro coincidencia!",
            width: "100%"
        });
    });
</script>