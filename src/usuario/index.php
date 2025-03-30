<?php 
	include("../php/conexion_bdd.php");
	$cant_menu=mysqli_query($con, "SELECT COUNT(id_menu) AS cantidad_menu FROM menu;");
	$menu=mysqli_query($con, "SELECT menu.id_menu, menu.plato, menu.precio, menu.descripcion, menu.url_img, menu.stock, categoria_menu.categoria AS nombre_cat, menu.categoria AS id_cat 
	FROM menu, categoria_menu WHERE menu.categoria=categoria_menu.id ORDER BY menu.categoria asc");
	$usuarios=mysqli_query($con, "SELECT COUNT(dni) AS cantidad_usuarios FROM usuario;");
	$admin=mysqli_query($con, "SELECT COUNT(dni) AS cantidad_admin FROM admin;");
	$cat=mysqli_query($con, "SELECT id,categoria FROM categoria_menu ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Buffet'S - Inicio</title>
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
							<span class="subheading">Buffet 'S</span>
							<h1 class="mb-4">buffet escolar, institución EEST N°1 Santa teresita</h1>
							<p class="mb-4 mb-md-5">Plataforma virtual para el encargue de comida rapida y casera</p>
							<p><a href="<?php if($_SESSION['menu']=='../usuario/bloqueado.php'){echo "bloqueado.php";}else{echo"menu_pedido.php";}?>" class="btn btn-primary p-3 px-xl-4 py-xl-3">Ordena ahora</a> <a href="<?=$_SESSION['menu'];?>" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Ver menú</a></p>
						</div>
					</div>
        		</div>
			</div>
		</div>
		<!--<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>-->
	</div>


    <section class="ftco-intro">
    	<div class="container-wrap">
    		<div class="wrap d-md-flex align-items-xl-end">
	    		<div class="info" style="background-color: white;">
	    			<div class="row no-gutters">
	    				<div class="col-md-4 d-flex ftco-animate">
	    					<div class="icon"><span class="icon-phone"></span></div>
	    					<div class="text">
	    						<h3 style="color: black;">2246 - 423529</h3>
	    						<p>Administración del buffet, escuela EEST N°1</p>
	    					</div>
	    				</div>
	    				<div class="col-md-4 d-flex ftco-animate">
	    					<div class="icon"><span class="icon-my_location"></span></div>
	    					<div class="text">
	    						<h3 style="color: black;">1798, Calle 104 1700</h3>
	    						<p>1798, Calle 104 1700, Santa Teresita, Buenos Aires</p>
	    					</div>
	    				</div>
	    				<div class="col-md-4 d-flex ftco-animate">
	    					<div class="icon"><span class="icon-clock-o"></span></div>
	    					<div class="text">
	    						<h3 style="color: black;">Abierto Lunes-Viernes</h3>
	    						<p>9:00am - 19:30pm</p>
	    					</div>
	    				</div>
	    			</div>
	    		</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-about d-md-flex">
    	<div class="one-half img" style="background-image: url(images/buffet/quiosco3.jpg);"></div>
    	<div class="one-half ftco-animate">
    		<div class="overlap">
	        <div class="heading-section ftco-animate ">
	        	<span class="subheading">Descubre</span>
	          <h2 class="mb-4">Nuestra historia</h2>
	        </div>
	        <div>
	  				<p>No solo somos los dueños del buffet escolar, somos una enorme familia conformada 
	  				por Carlitos, Noe, Carolina, Silvia, los aproximados 1200 alumnos y 600 miembros del personal escolar, 
	  			integrado por docentes, preceptores, cuerpo directivo y porteros.<br>
	  				Nosotros les proporcionamos un menú muy amplio, rico y casero para todo tipo de gustos y necesidades. Desde hamburguesas y sandwiches, 
	  				hasta ensaladas, pollo, tallarines, etc. Ademas de un quiosco con una amplia variedad de golosinas, galletitas, fotocopiadora, agua caliente, té y café.
	  			</p>
	  			</div>
  			</div>
    	</div>
    </section>

    <section class="ftco-section ftco-services">
    	<div class="container">
    		<div class="row">
          <div class="col-md-4 ftco-animate">
            <div class="media d-block text-center block-6 services">
              <div class="icon d-flex justify-content-center align-items-center mb-5">
              	<span class="flaticon-choices"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Facil de encargar</h3>
                <p>Inicia sesión, elige el producto que más te guste y añadalo al carrito, para luego descontarlo del monedero, o 
                encargarlo para pagarlo más tarde.</p>
              </div>
            </div>      
          </div>
          <div class="col-md-4 ftco-animate">
            <div class="media d-block text-center block-6 services">
              <div class="icon d-flex justify-content-center align-items-center mb-5">
              	<span class="flaticon-delivery-truck"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Servicio rapido</h3>
                <p>Una vez encargado y pagado el producto, éste estará en proceso de cocinado para que una 
                vez iniciado el tiempo de retiro, el producto esté listo para su consumo.</p>
              </div>
            </div>      
          </div>
          <div class="col-md-4 ftco-animate">
            <div class="media d-block text-center block-6 services">
              <div class="icon d-flex justify-content-center align-items-center mb-5">
              	<span class="icon icon-money" style="padding-top: 20px;"></span></div>
              <div class="media-body">
                <h3 class="heading">Precios accesibles</h3>
                <p>Nosotros les proporcionamos una lista de precios accesible para cualquier tipo persona, logrando 
                que sin la necesidad de un alto presupuesto puedas alimentarte de la mejor manera.</p>
              </div>
            </div>    
          </div>
        </div>
    	</div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row align-items-center">
    			<div class="col-md-6 pr-md-5">
    				<div class="heading-section text-md-right ftco-animate">
	          	<span class="subheading">Explora</span>
	            <h2 class="mb-4">Nuestro Menú</h2>
	            <p class="mb-4">Comida casera con materia prima de primera calidad para garantizar un 
	            plato rico y nutritivo para nuestros clientes.</p>
	            <p><a href="<?=$_SESSION['menu'];?>" class="btn btn-primary btn-outline-primary px-4 py-3">Ver Menú completo</a></p>
	          </div>
    			</div>
    			<div class="col-md-6">
    				<div class="row">
    					<div class="col-md-6">
    						<div class="menu-entry">
		    					<a href="#" class="img" style="background-image: url(images/burger-1.jpg);"></a>
		    				</div>
    					</div>
    					<div class="col-md-6">
    						<div class="menu-entry mt-lg-4">
		    					<a href="#" class="img" style="background-image: url(images/dish-6.jpg);"></a>
		    				</div>
    					</div>
    					<div class="col-md-6">
    						<div class="menu-entry">
		    					<a href="#" class="img" style="background-image: url(images/image_6.jpg);"></a>
		    				</div>
    					</div>
    					<div class="col-md-6">
    						<div class="menu-entry mt-lg-4">
		    					<a href="#" class="img" style="background-image: url(images/image_1.jpg);"></a>
		    				</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-counter ftco-bg-dark img" id="section-counter" style="background-image: url(images/menu/pizza.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
      <div class="container">
        <div class="row justify-content-center">
        	<div class="col-md-10">
        		<div class="row">
		          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		              	<?php $row=mysqli_fetch_array($usuarios); ?>
		              	<div class="icon"><span class="icon icon-user" style="padding-top: 20px;"></span></div>
		              	<strong class="number" data-number="<?=$row['cantidad_usuarios'];?>">0</strong>
		              	<span>Usuarios</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		              	<?php $row=mysqli_fetch_array($cant_menu); ?>
		              	<div class="icon"><span class="icon icon-cutlery" style="padding-top: 20px;"></span></div>
		              	<strong class="number" data-number="<?=$row['cantidad_menu'];?>">0</strong>
		              	<span>Cantidad de productos</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		              	<div class="icon"><span class="icon icon-money" style="padding-top: 20px;"></span></div>
		              	<strong class="text" style="color: #c49b63;">$$$</strong>
		              	<span>Precios accesibles</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		              	<?php $row=mysqli_fetch_array($admin); ?>
		              	<div class="icon"><span class="icon icon-eye" style="padding-top: 20px;"></span></div>
		              	<strong class="number" data-number="<?=$row['cantidad_admin'];?>">0</strong>
		              	<span>Staff</span>
		              </div>
		            </div>
		          </div>
		        </div>
		      </div>
        </div>
      </div>
    </section>

    <section class="ftco-menu">
    	<div class="container">
	    		<div class="row justify-content-center mb-5">
		        	<div class="col-md-7 heading-section text-center ftco-animate">
						<span class="subheading">Descubre</span>
						<h2 class="mb-4">Nuestras categorias</h2>
						<p>Una amplia gama de tipos de comida para todos los gustos, para los que deseean 
						comer sano, o para los que les gusta los rico y sabroso.</p>
					</div>
		        </div>
    		<div class="row d-md-flex">
	    		<div class="col-lg-12 ftco-animate p-md-5">
		    		<div class="row">
		    			<?php 
		    				$indice_categoria=0;
		    				echo "
								<div class='col-md-12 nav-link-wrap mb-5'>
									<div class='nav ftco-animate nav-pills justify-content-center' id='v-pills-tab' role='tablist' aria-orientation='vertical'>
							";
							while ($row=mysqli_fetch_array($cat)) {
								$categoria_id=$row['id'];
								$categoria=$row['categoria'];
								if ($indice_categoria==0) {
									echo "
										<a class='nav-link active' id='v-pills-".$categoria_id."-tab' data-toggle='pill' href='#v-pills-".$categoria_id."' role='tab' aria-controls='v-pills-".$categoria_id."' aria-selected='true'>".$categoria."</a>
									";
								}else{
									echo "
										<a class='nav-link' id='v-pills-".$categoria_id."-tab' data-toggle='pill' href='#v-pills-".$categoria_id."' role='tab' aria-controls='v-pills-".$categoria_id."' aria-selected='false'>".$categoria."</a>
									";
								}
									$indice_categoria++;
							}
							echo "
									</div>
								</div>
								";

								$indice_categoria=0;
								echo "
									<div class='col-md-12 d-flex align-items-center'>
			            				<div class='tab-content ftco-animate' id='v-pills-tabContent'>
								";
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
											echo "
													</div>
												</div>
											";
										}
										if ($categoria_id==1) {
											echo "
												<div class='tab-pane fade show active' id='v-pills-".$categoria_id."' role='tabpanel' aria-labelledby='v-pills-".$categoria_id."-tab'>
									            	<div class='row'>
											";
										}else{
											echo "
												<div class='tab-pane fade' id='v-pills-".$categoria_id."' role='tabpanel' aria-labelledby='v-pills-".$categoria_id."-tab'>
				                					<div class='row'>
											";
										}
										$indice_categoria++;       					
									}
									echo "
									<div class='col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center'>
				              			<div class='menu-wrap'>
				              				<a href='#' class='menu-img img mb-4' style='background-image: url(images/menu/".$url_img.");'></a>
				              				<div class='text'>
				              					<h3><a href='#'>".$plato."</a></h3>
				              					<p>".$descripcion.".</p>
				              					<p class='price'><span>$".$precio."</span></p>
				              					<p><a href='";if($_SESSION['menu']=='../usuario/bloqueado.php'){echo "bloqueado.php";}else{echo"menu_pedido.php";}echo"' class='btn btn-primary btn-outline-primary'>Añadir al carrito</a></p>
				              				</div>
				              			</div>
					              	</div>
					              	";
							} 
								echo "
									</div>
								</div>
								";
							?>
		        	</div>
		      	</div>
		    </div>
    	</div>
    </section>

    <section class="ftco-gallery">
    	<div class="container-wrap">
    		<div class="row no-gutters">
					<div class="col-md-3 ftco-animate">
						<a href="#" class="gallery img d-flex align-items-center" style="background-image: url(images/buffet/mesas3.jpg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-search"></span>
    					</div>
						</a>
					</div>
					<div class="col-md-3 ftco-animate">
						<a href="#" class="gallery img d-flex align-items-center" style="background-image: url(images/buffet/quiosco2.jpg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-search"></span>
    					</div>
						</a>
					</div>
					<div class="col-md-3 ftco-animate">
						<a href="#" class="gallery img d-flex align-items-center" style="background-image: url(images/buffet/mesas2.jpg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-search"></span>
    					</div>
						</a>
					</div>
					<div class="col-md-3 ftco-animate">
						<a href="#" class="gallery img d-flex align-items-center" style="background-image: url(images/buffet/quiosco1.jpg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-search"></span>
    					</div>
						</a>
					</div>
        </div>
    	</div>
    </section>
		
	<section class="ftco-appointment">
			<div class="overlay"></div>
    		<div class="container-wrap">
    		<div class="row no-gutters d-md-flex align-items-center">
    			<div class="col-md-6 d-flex align-self-stretch">
    				<!--<div id="map"></div>--><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12823.476783143515!2d-56.70467161231692!3d-36.53314996713911!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x959c1244131bd179%3A0xb86f17ae5d6508b1!2sEEST+N%C2%B0+1!5e0!3m2!1ses!2sar!4v1560783876102!5m2!1ses!2sar" width="100%" height="100%" frameborder="0" style="border:0px; padding: 20px;" allowfullscreen class="mapa-google"></iframe>
    			</div>
	    		<div class="col-md-6 appointment ftco-animate">
	    			<h3 class="mb-3">Contactenos</h3>
	    			<form action="#" class="appointment-form">
	    				<div class="d-md-flex">
		    				<div class="form-group">
		    					<input type="text" class="form-control" placeholder="Nombre">
		    				</div>
		    				<div class="form-group ml-md-4">
		    					<input type="text" class="form-control" placeholder="Apellido">
		    				</div>
	    				</div>
	    				<div class="d-md-flex">
		    				<div class="form-group">
		    					<div class="input-wrap">
		            		<div class="icon"><span class="ion-md-calendar"></span></div>
		            		<input type="text" class="form-control appointment_date" placeholder="Fecha">
	            		</div>
		    				</div>
		    				<div class="form-group ml-md-4">
		    					<div class="input-wrap">
		            		<div class="icon"><span class="ion-ios-clock"></span></div>
		            		<input type="text" class="form-control appointment_time" placeholder="Hora">
	            		</div>
		    				</div>
		    				<div class="form-group ml-md-4">
		    					<input type="text" class="form-control" placeholder="Telefono">
		    				</div>
	    				</div>
	    				<div class="d-md-flex">
	    					<div class="form-group">
		              <textarea name="" id="" cols="30" rows="2" class="form-control" placeholder="Mensaje"></textarea>
		            </div>
		            <div class="form-group ml-md-4">
		              <input type="submit" value="Enviar" class="btn btn-primary py-3 px-4">
		            </div>
	    				</div>
	    			</form>
	    		</div>    			
    		</div>
    	</div>
    </section>

    <?php include("footer.php"); ?>
  </body>
</html>