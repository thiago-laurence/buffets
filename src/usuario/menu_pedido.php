<?php 
  require("../php/conexion_bdd.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Buffet'S - Menú</title>
    <link rel="icon" href="images/hamburguesa_icono.png">
  </head>
  
  <body>
  	<header>
  		<?php include("header.php"); 
      if(!isset($_SESSION["documento"]) || $_SESSION["documento"] ==""){
        header("Location: iniciar_sesion.php");
      }
      ?>
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
                  <h1 class="mb-4">Realice su encargue</h1>
                  <p class="mb-4 mb-md-5">Eliga el producto que más le guste y añadalo al carrito.</p>
                </div>
              </div>
                </div>
          </div>
        </div>
    </div>

    <div id="Menu">
    </div>

    <?php include("footer.php"); ?>
  </body>
</html>
<script>
	function refrescar_datos(){
  		$("#Menu").load("menu_pedido_sql.php");
  	}
    refrescar_datos();
  	setInterval(function(){
  		refrescar_datos();
  	},1000);
</script>
<script>
  $(document).on("click", "#btn-encargar", function(){
    var plato = $(this).data("plato")
    var id_menu = $(this).data("id_menu");
    var dni = $(this).data("dni");
    swal({
      title: "¿Seguro desea encargar: "+plato+"?",
      text: "En caso de arrepentirse, el pedido puede ser cancelado",
      icon: "warning",
      buttons: ["Cancelar", "Aceptar"],
    })
    .then((confirmar) => {
      if (confirmar) {
        swal("Pedido realizado correctamente!", {
          icon: "success",
          button: true,
        })
        .then((redireccion) => {
          if (redireccion) {
            window.location.href="carrito.php?pid_menu="+id_menu;
          }
        });
      }
    });
    
  })
</script>