<?php 
	include("../php/sesion.php");
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>Buffet'S - Administración</title>
</head>
<body>

    <?php include("header.php"); ?>

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                </div>
            </div>
        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Pedidos a realizar</h1>
                    </div>
                </div>
            </div>
        </div>

       <div class="content mt-3">
            <div class="content mt-3">
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Tabla de pedidos</strong>
                                    <span class="input-group-text" id="basic-addon1" style="margin-top: 20px; margin-bottom: 20px;">Busca el pedido realizado por el DNI del cliente</span>
                                    <input id="FiltrarContenido" type="text" class="form-control" placeholder="Buscar..." aria-label="Alumno" aria-describedby="basic-addon1">
                                </div>
                                <div class="card-body">
                                    <table class='table table-striped table-bordered'>
                                        <thead class='thead-dark'>
                                            <tr>
                                                <th>DNI</th>
                                                <th>Nombre y apellido</th>
                                                <th>Producto</th>
                                                <th>Estado</th>
                                            </tr>
                                            <tbody class='BusquedaRapida' id="Pedidos">

                                            </tbody>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- .row -->
                </div><!-- .animated -->
            </div>
        </div>
        
    </div> <!-- .content -->
    <!-- Right Panel -->
</body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        //buscador de datos
       (function($) {
           $('#FiltrarContenido').keyup(function () {
                var ValorBusqueda = new RegExp($(this).val(), 'i');
                $('.BusquedaRapida tr').hide();
                 $('.BusquedaRapida tr').filter(function () {
                    return ValorBusqueda.test($(this).text());
                  }).show();
                    })
          }(jQuery));
        //fin de buscador

        //obtener los datos de la consulta
        function obtener_datos(){
            $.ajax({
                url: "pedidos_a_realizar_sql.php",
                method: "POST",
                success: function(data){
                    $("#Pedidos").html(data)
                }
            })
        }

        obtener_datos();

        setInterval(function(){
            if($("select").is(":focus")){ 
                //no hago nada xd
            }else{
                obtener_datos();
            }        
        },60000);

        /*
        setInterval(function(){
            obtener_datos();
        },5000);
        */

        //fin de la obtencion

       //actualizar datos
       function actualizar_datos(id_pedido, id_estado, id_estado_pago){
        $.ajax({
            url: "actualizar_pedidos.php",
            method: "POST",
            data: {id_pedido: id_pedido, id_estado: id_estado, id_estado_pago: id_estado_pago},
            success: function(data){
                obtener_datos();
            }
        })
       }

       $(document).on("blur", ".id_estado_pedido", function(){
            var id_pedido2 = $(this).data("id_pedido");
            var id_estado_pedido2 = $(this).val();
            var contador = $(this).data('contador');
            var id_estado_pago2;
            var elemento = $('.id_estado_pago');    

            jQuery.each(elemento, function(){
                if($(this).data('contador') == contador)
                {
                    id_estado_pago2 = $(this).val();
                }
            })
            actualizar_datos(id_pedido2, id_estado_pedido2, id_estado_pago2)
       })

       $(document).on("blur", ".id_estado_pago", function(){
            var id_pedido = $(this).data("id_pedido2");
            var contador = $(this).data('contador');
            var id_estado_pago = $(this).val();
            var id_estado_pedido;
            var elemento = $('.id_estado_pedido');  

            jQuery.each(elemento, function(){
                if($(this).data('contador') == contador)
                {
                    id_estado_pedido = $(this).val();
                }
            })
            actualizar_datos(id_pedido, id_estado_pedido, id_estado_pago)
       })
       //fin de la actualizacion
    });
</script>