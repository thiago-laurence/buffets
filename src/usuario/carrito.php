<?php 
    require("../php/conexion_bdd.php");
    session_name("loginbuffet");
    session_start();
    if(!isset($_SESSION['documento'])){
        header("Location: iniciar_sesion.php");
    }
    //trae el id del plato encargado para guardarlo y luego realizar el pedido
    if(isset($_GET['pid_menu'])){
        $id=$_GET['pid_menu'];
        $nuevo_pedido="CALL insertar_pedido(".$id.",".$_SESSION['documento'].");";
        $insertar_pedido=mysqli_query($con, $nuevo_pedido);
    }
    
    //una vez insertado el pedido en la BDD llamo al procedimiento para mostrarlo
    $carrito="SELECT pedido.id_menu, pedido.id_pedido, estado_pago.estado, pedido.estado_pago,usuario.saldo,menu.precio,menu.url_img,menu.descripcion, menu.plato, estado_pedido.estado_pedido 
    FROM estado_pago INNER JOIN pedido ON pedido.estado_pago=estado_pago.id INNER JOIN 
usuario ON pedido.dni=usuario.dni INNER JOIN menu ON pedido.id_menu=menu.id_menu INNER JOIN estado_pedido 
ON pedido.estado=estado_pedido.id_estado_pedido WHERE '".$_SESSION['documento']."'= pedido.dni;";
    $mostrar_pedido=mysqli_query($con, $carrito);

    $sql="SELECT saldo FROM usuario WHERE dni='".$_SESSION['documento']."'";
    $consulta=mysqli_query($con, $sql);
    $vec=mysqli_fetch_row($consulta);

    /*$hora_cancelar=mysqli_query($con, "SELECT if(time(now()) BETWEEN tiempo_cancelacion_desde AND hora_cancelacion_hasta, 1, 0) AS ESTADO FROM buffet_horas;");
    $resu_hora=mysqli_fetch_array($hora_cancelar);
    if($resu_hora['ESTADO']){
        $habilitar_btn=1;
    }else{
        $habilitar_btn=0;
    }*/
    $habilitar_btn=1;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Buffet'S - Carrito</title>
    <link rel="icon" href="images/hamburguesa_icono.png">
  </head>
  <body>
  	<header>
    <?php 
        include("header.php"); 
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
                            <span class="subheading">Carrito</span>
                            <h1 class="mb-4">Lista de los pedidos realizados</h1>
                            <p class="mb-4 mb-md-5">Administre el encargue, costo y saldo total de su cuenta.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
		
	<section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                	<div class="cart-list">
                		<table class="table">
                		    <thead class="thead-primary">
                		      <tr class="text-center">
                                <?php if($habilitar_btn){ ?>
                		        <th>Cancelar pedido</th>
                                <?php } ?>
                                <th>&nbsp;</th>
                		        <th>Producto</th>
                		        <th>Precio</th>
                		        <th>Estado del pedido</th>
                                <th>Estado del pago</th>
                		      </tr>
                		    </thead>
                		    <tbody>
                                <?php
                                    $total_gasto=0;
                                    $precio=0;
                                    $saldo=0;
                                    $estado_pago_id=0;
                                    while($row=mysqli_fetch_array($mostrar_pedido)){
                                        $plato=$row['plato'];
                                        $estado_pago=$row['estado'];
                                        $estado_pago_id=$row['estado_pago'];
                                        $precio=$row['precio'];
                                        $estado_pedido=$row['estado_pedido'];
                                        $url_img=$row['url_img'];
                                        $saldo=$row['saldo'];
                                        $descripcion=$row['descripcion'];
                                        $total_gasto=$total_gasto+$precio;
                                ?>
                                <tr class="text-center">
                                    <?php if($habilitar_btn){ 
                                    echo "<td class='product-remove'><a href='#' id='btn-cancelar' data-id='".$row[1]."' data-total_gasto='".$total_gasto."' data-estado_pago='".$estado_pago_id."' data-saldo='".$saldo."' data-id_menu='".$row[0]."'><span class='icon-close'></span></a></td>";
                                    } ?>
                                    <?php 
                                        echo "<td class='image-prod'><div class='img' style='background-image:url(images/menu/".$url_img.");'></div></td>";
                                    ?>
                                    <td class="product-name">
                                        <?php 
                                            echo "<h3>".$plato."</h3>";
                                            echo "<p>".$descripcion."</p>";
                                        ?>
                                    </td>
                                    <td class="price"><?php echo "$".$precio; ?></td>
                                    <td class="total"><?php echo $estado_pedido; ?></td>
                                    <td class="total"><?php echo $estado_pago; ?></td>
                                </tr>
                                <?php } ?>
                		    </tbody>
                	   </table>
                	</div>
                </div>
            </div>
            <div class="col-md-6 heading-section ftco-animate" style="margin-top: 50px;">
				<h2 class="mb-4">Nota: </h2>
				<p>En el caso de no tener saldo suficiente para realizar el pago del pedido, o se desee pagar el pedido sin descontar del saldo disponible (teniendo lo suficiente como para pagarlo) se debera abonar el total del pedido en el
				buffet antes de las 11:00 AM para que este completamente hecho, sino se eliminara el mismo.</p>
			</div>
            <div class="row justify-content-end">
            	<div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Carrito</h3>
                        <p class="d-flex">
                            <span>Monedero actual</span>
                            <span><?php echo "$".$vec[0]; ?></span>
                        </p>
                    <?php if ($estado_pago_id==1 && $saldo>$total_gasto) { ?>
                        <p class="d-flex">
                            <span>Encargue</span>
                            <span><?php echo "$".$precio; ?></span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span><?php $total=$saldo-$total_gasto; echo "$".$total_gasto; ?></span>
                        </p>
                    </div>
                        <p class="text-center"><a href="#" class="btn btn-primary py-3 px-4" id="btn-pagar" data-costo="<?=$total;?>">Pagar</a></p>
                    </div>
                    <?php }else if($estado_pago_id==1 && $saldo<$total_gasto){ ?>
                        <p class="d-flex">
                            <span>Encargue</span>
                            <span><?php echo "$".$precio; ?></span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span><?php $total=$saldo-$total_gasto; echo "$".$total_gasto; ?></span>
                        </p>
                    </div>
                    </div>
                    <?php }else{ ?>
                    </div>
                	</div>
                    <?php } ?>
                </div>
            </div>
        </div>
	</section>

    <?php include("footer.php"); ?>
  </body>
</html>
<script>
  $(document).on("click", "#btn-cancelar", function(){
    var id = $(this).data("id");
    var total_gasto = $(this).data("total_gasto");
    var estado_pago_id = $(this).data("estado_pago");
    var id_menu = $(this).data("id_menu");
    var saldo = $(this).data("saldo");
    swal({
      title: "¿Seguro desea cancelar el pedido?",
      text: "",
      icon: "warning",
      buttons: ["Cancelar", "Aceptar"],
    })
    .then((confirmar) => {
      if (confirmar) {
        swal("Pedido cancelado correctamente!", {
          icon: "success",
          button: true,
        })
        .then((redireccion) => {
          if (redireccion) {
            window.location.href="../php/cancelar_pedido.php?id="+id+"&total_gasto="+total_gasto+"&estado_pago_id="+estado_pago_id+"&saldo="+saldo+"&id_menu="+id_menu;
          }
        });
      }
    });
    
  })
  $(document).on("click", "#btn-pagar", function(){
    var costo = $(this).data("costo");
    swal({
      title: "Confirme el págo del pedido",
      text: "",
      icon: "warning",
      buttons: ["Cancelar", "Aceptar"],
    })
    .then((confirmar) => {
      if (confirmar) {
        swal("Pedido abonado correctamente!", {
          icon: "success",
          button: true,
        })
        .then((redireccion) => {
          if (redireccion) {
            window.location.href="../php/pagar_pedido.php?total="+costo;;
          }
        });
      }
    });
    
  })
</script>