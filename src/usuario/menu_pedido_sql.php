<?php
	include("../php/conexion_bdd.php");
	include("../php/sesion.php");
	//la cantidad de pedidos realizaos por el usuario para bloquear el boton añadir al carrito
	$pedido_realizado=mysqli_query($con, "SELECT COUNT(dni) AS CANTIDAD FROM pedido WHERE dni=".$_SESSION['documento'].";");
	$resu_pedido=mysqli_fetch_array($pedido_realizado);
	$habilitar_btn=1;
	
	/*if($resu_pedido['CANTIDAD']==1){
		$habilitar_btn=2;
	}else{
		//habilita el boton si la hora de la computadora esta situada entre las horas de pedido
		$hora_pedir=mysqli_query($con, "SELECT if(time(now()) BETWEEN hora_pedido_desde AND hora_pedido_hasta, 1, 0) AS ESTADO FROM buffet_horas;");
		$resu_hora=mysqli_fetch_array($hora_pedir);
		if($resu_hora['ESTADO']){
			$habilitar_btn=1;
		}else{
			$habilitar_btn=0;
		}
	}*/
	
	$menu=mysqli_query($con, "SELECT menu.id_menu, menu.plato, menu.precio, menu.descripcion, menu.url_img, menu.stock, categoria_menu.categoria AS nombre_cat, menu.categoria AS id_cat 
	FROM menu, categoria_menu WHERE menu.categoria=categoria_menu.id ORDER BY menu.categoria asc");

	echo "
	<section class='ftco-section'>
    	<div class='container'>
        	<div class='row'>
        	";
	$indice_categoria=0;
	while ($row=mysqli_fetch_array($menu)) {
			$precio=$row['precio'];
			$plato=$row['plato'];
			$descripcion=$row['descripcion'];
			$url_img=$row['url_img'];
			$id_menu=$row['id_menu'];
			$stock=$row['stock'];
			$categoria=$row['nombre_cat'];
			$categoria_id=$row['id_cat'];

			if ($categoria_id>$indice_categoria) {
				if ($indice_categoria != 0) {
					echo "</div>";
				}
				echo "
					<div class='col-md-6 mb-5 pb-3'>
						<h3 class='mb-5 heading-pricing '>".$categoria."</h3>
				";        					
				$indice_categoria++;
			}
			echo "
				<div class='pricing-entry d-flex '>
					<div class='img' style='background-image: url(images/menu/".$url_img.");'></div>
				<div class='desc pl-3'>
	    			<div class='d-flex text align-items-center'>
	    				<h3 style='text-transform: capitalize;'><span>".$plato."</span></h3>
	    				<span class='price'>$".$precio."</span>
	    			</div>
    			<div class='d-block'>
    				<p>".$descripcion."</p>
    		";
    				if ($stock>0 && $habilitar_btn==1) {
    					echo "
    						<p>Cantidad disponible: ".$stock."</p>
    					"; 
							echo "
								<button class='btn btn-primary btn-outline-primary' id='btn-encargar' data-id_menu='".$row['id_menu']."' data-plato='".$plato."'>
									Añadir al carrito
								</button>
								"; 
							?>
    					<?php 
        			}else if($stock==0){
        					echo "
        						<p>SIN STOCK</p>
        					";
        				}else if($stock>0 && $habilitar_btn==0){
        					echo "<p>Cantidad disponible: ".$stock."</p>
        						<p>Fuera de horario para pedir</p>
        					";
    					}else if($stock>0 && $habilitar_btn==2){
    						echo "<p>Cantidad disponible: ".$stock."</p>
        						<p>Pedido ya realizado</p>
        					";
    					}
    					echo "
    			</div>
			</div>
		</div> ";
	}
	echo "
			</div>
        </div>
    </section>
    ";



?>