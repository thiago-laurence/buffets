<?php 
	require("../php/conexion_bdd.php");
	$menu=mysqli_query($con, "SELECT menu.id_menu, menu.plato, menu.precio, menu.descripcion, menu.url_img, menu.stock, categoria_menu.categoria AS nombre_cat, menu.categoria AS id_cat 
FROM menu, categoria_menu WHERE menu.categoria=categoria_menu.id ORDER BY menu.categoria asc");

    $sql_combo="SELECT * FROM combos;";
    $query_combo=mysqli_query($con, $sql_combo);
    $sql_producto="SELECT combos_productos.id_combo, combos_productos.id_menu, combos_productos.cant_menu, 
menu.plato FROM combos_productos INNER JOIN menu ON combos_productos.id_menu=menu.id_menu;";
    $query_producto=mysqli_query($con, $sql_producto);
    $cant_combos=mysqli_query($con, "SELECT count(id) AS cant_combos FROM combos;");
    $fila=mysqli_fetch_array($cant_combos);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Buffet'S - Menú</title>
    <link rel="icon" href="images/hamburguesa_icono.png">
  </head>
  <body>
  	<header>
  		<?php include("header.php"); ?>
  	</header>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				
            	<div class="container">
					<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
						<div class="col-md-8 col-sm-12 text-center ftco-animate">
							<span class="subheading">Menú</span>
							<h1 class="mb-4">Lista de productos disponibles</h1>
							<p class="mb-4 mb-md-5">Para realizar su encargue debe iniciar sesión.</p>
						</div>
					</div>
        		</div>
			</div>
		</div>
	</div>

    <section class="ftco-section" style="padding:0px; padding-top: 7em;">
    	<div class="container">
        	<div class="row">
        		<?php 
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
        					if ($indice_categoria != 0)
        					{
        						echo "</div>";
        					}
        					echo "<div class='col-md-6 mb-5 pb-3'>";
        					echo "<h3 class='mb-5 heading-pricing ftco-animate'>".$categoria."</h3>";        					
        					$indice_categoria++;
        				} ?>
        				<div class="pricing-entry d-flex ftco-animate">
	        			<?php 
	        				echo "<div class='img' style='background-image: url(images/menu/".$url_img.");'></div>";
	        			?>
	        			<div class="desc pl-3">
		        			<div class="d-flex text align-items-center">
		        				<?php 
		        					echo "<h3 style='text-transform: capitalize;'><span>".$plato."</span></h3>";
		        					echo "<span class='price'>$".$precio."</span>";
		        				?>
		        			</div>
		        			<div class="d-block">
		        				<?php 
		        					echo "<p>".$descripcion."</p>";
			        			?>
		        			</div>
	        			</div>
	        		</div>
	        	<?php } ?>
        	</div>
    	</div>
    </section>

    <section class="ftco-menu" style="padding-top: 0px;">
        <div class="container">
            <div class="row justify-content-center mb-5">
              <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Discover</span>
                <h2 class="mb-4">Our Products</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              </div>
            </div>
            <div class="row d-md-flex">
                <div class="col-lg-12 ftco-animate p-md-5">
                    <div class="row">
                        <div class="col-md-12 nav-link-wrap mb-5">
                            <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <?php 
                                    $total = ceil($fila['cant_combos']/3);
                                    for ($i=1; $i <= $total; $i++) { 
                                        if ($i == 1) {
                                        echo "<a class='nav-link active' id='v-pills-1-tab' data-toggle='pill' href='#v-pills-1' role='tab' aria-controls='v-pills-1' aria-selected='true'>Combos ".$i."</a>
                                        ";
                                        }else{
                                            echo "<a class='nav-link' id='v-pills-".$i."-tab' data-toggle='pill' href='#v-pills-".$i."' role='tab' aria-controls='v-pills-".$i."' aria-selected='false'>Combos ".$i."</a>
                                            </div>
                                            ";
                                        }
                                    } ?>
                            </div>
                        </div>
                        <?php 
                            echo "                            
                    <div class='col-md-12 d-flex align-items-center'>
                        <div class='tab-content ftco-animate' id='v-pills-tabContent'>
                            <div class='tab-pane fade show active' id='v-pills-1' role='tabpanel' aria-labelledby='v-pills-1-tab'>
                                <div class='row'>
                            ";
                            $i=0;
                            $cont=1;
                            while ($row=mysqli_fetch_array($query_combo)) {
                                $i++;
                                $id=$row['id'];
                                $nombre=$row['nombre'];
                                $descripcion=$row['descripcion'];
                                $precio=$row['precio'];
                                $img=$row['img'];
                                echo "
                                    <div class='col-md-4 text-center'>
                                        <div class='menu-wrap'>
                                            <a href='#' class='menu-img img mb-4' style='background-image: url(images/burger-1.jpg);'></a>
                                            <div class='text'>
                                                <h3><a href='#'>".$nombre."</a></h3>
                                                <p>".$descripcion.".</p>
                                                <p class='price'><span>$".$precio."</span></p>
                                                <p><a href='#' class='btn btn-primary btn-outline-primary'>Add to cart</a></p>
                                            </div>
                                        </div>
                                    </div>
                                ";
                                if ($i==3) {
                                    $i=0;
                                    $cont++;
                                    echo "
                                            </div>
                                        </div>
                                        <div class='tab-pane fade' id='v-pills-".$cont."' role='tabpanel' aria-labelledby='v-pills-".$cont."-tab'>
                                            <div class='row'>
                                    ";
                                }
                            } 
                            echo "</div></div>"; ?>

                                <!--<div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab">
                                    <div class="row">
                                    <div class="col-md-4 text-center">
                                        <div class="menu-wrap">
                                            <a href="#" class="menu-img img mb-4" style="background-image: url(images/drink-1.jpg);"></a>
                                            <div class="text">
                                                <h3><a href="#">Lemonade Juice</a></h3>
                                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
                                                <p class="price"><span>$2.90</span></p>
                                                <p><a href="#" class="btn btn-primary btn-outline-primary">Add to cart</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="menu-wrap">
                                            <a href="#" class="menu-img img mb-4" style="background-image: url(images/drink-2.jpg);"></a>
                                            <div class="text">
                                                <h3><a href="#">Pineapple Juice</a></h3>
                                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
                                                <p class="price"><span>$2.90</span></p>
                                                <p><a href="#" class="btn btn-primary btn-outline-primary">Add to cart</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="menu-wrap">
                                            <a href="#" class="menu-img img mb-4" style="background-image: url(images/drink-3.jpg);"></a>
                                            <div class="text">
                                                <h3><a href="#">Soda Drinks</a></h3>
                                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
                                                <p class="price"><span>$2.90</span></p>
                                                <p><a href="#" class="btn btn-primary btn-outline-primary">Add to cart</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include("footer.php"); ?>
  </body>
</html>