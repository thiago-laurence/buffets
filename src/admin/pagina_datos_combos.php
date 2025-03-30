<?php 
	include("../php/conexion_bdd.php");

	$sql_combo="SELECT * FROM combos;";
	$sql_producto="SELECT combos_productos.id_combo, combos_productos.id_menu, combos_productos.cant_menu, 
menu.plato FROM combos_productos INNER JOIN menu ON combos_productos.id_menu=menu.id_menu;";

	$combo=mysqli_query($con, $sql_combo);
	$producto=mysqli_query($con, $sql_producto);

			$vof=1;
			$pos=0;
            $x=0;
    		while ($row=mysqli_fetch_array($combo)) {
    			$pos++;
    			$nombre=$row['nombre'];
				$id=$row['id'];
				$img=$row['img'];
				$precio=$row['precio'];
				$descripcion=$row['descripcion'];
				$stock=$row['stock']; 
				?>                         
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<aside class="profile-nav alt">
					        <section class="card">
					            <div class="card-header user-header alt bg-dark">
					                <div class="media">
					                    	<?php echo "<img class='align-self-center rounded-circle mr-3' style='width:85px; height:85px;' alt='".$nombre." Sin imagen' src='../usuario/images/menu/".$img."'>"; ?>
					                    <div class="media-body">
					                        <h2 class="text-light display-6"><?php echo $nombre; ?></h2>
					                        <p><?php echo $descripcion; ?></p>
					                    </div>
					                </div>
					            </div>
					            <ul class="list-group list-group-flush">
					                <li class="list-group-item">
					                    <i class="fa fa-money"></i><?php echo "Precio: "; ?><span class="badge badge-primary pull-right"><?php echo "$ ".$precio; ?></span>
					                </li>
					                <li class="list-group-item">
					                    <i class="fa fa-tasks"></i><?php echo "Stock: "; ?><span class="badge badge-danger pull-right"><?php echo $stock; ?></span>
					                </li>
            	<?php 
            	while ($row2=mysqli_fetch_array($producto)) {
            		if ($id==$row2['id_combo']) {
            			echo "
            			<li class='list-group-item'>
                			<i class='fa fa-cutlery'></i>Producto: <span class='badge badge-warning pull-right r-activity'>".$row2['plato']."</span>
            			</li>
            			";
            		}
            	}
            	mysqli_free_result($producto);
              	$producto=mysqli_query($con, $sql_producto);
            	?>
            	<li class="list-group-item">
	                            <button class="btn btn-primary" id="btn-editar" data-id="<?=$id;?>" data-nombre="<?=$nombre;?>" data-descripcion="<?=$descripcion;?>" data-img="<?=$img;?>" data-precio="<?=$precio;?>" data-stock="<?=$stock;?>">
	                                Editar
	                            </button>
	                        <?php echo "<button class='btn btn-danger' id='btn-eliminar' data-id='".$id."' data-nombre='".$nombre."'>
	                                Eliminar
	                            </button>"; ?>
	                        </li>
	                    </ul>
	                </section>
	            </aside>
	        </div>
<?php
        }
?>