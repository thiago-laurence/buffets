<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>Buffet'S - Modificar saldo</title>
</head>
<body>
    <?php include("header.php"); ?>
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
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
                        <h1>Modificar saldo</h1>
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
                                    <span class="input-group-text" id="basic-addon1" style="margin-top: 20px; margin-bottom: 20px;">Busca el usuario por DNI</span>
                                    <input id="FiltrarContenido" type="text" class="form-control" placeholder="Buscar..." aria-label="Alumno" aria-describedby="basic-addon1">
                                </div>
                                <div class="card-body">
                                    <table class='table table-striped table-bordered'>
                                        <thead class='thead-dark'>
                                            <tr>
                                                <th>DNI</th>
                                                <th>Nombre y apellido</th>
                                                <th>Saldo</th>
                                            </tr>
                                            <tbody class='BusquedaRapida' id="Saldo_usuarios">

                                            </tbody>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- .row -->
                </div><!-- .animated -->
            </div><!-- .content -->
        </div>
        
    </div><!-- /#right-panel -->
</body>
</html>
<script>
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
                url: "modificar_saldo_sql.php",
                method: "POST",
                success: function(data){
                    $("#Saldo_usuarios").html(data)
                }
            })
        }

        obtener_datos();

        setInterval(function(){
            if($("input").is(":focus")){ 
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
       function actualizar_datos(dni, saldo){
        $.ajax({
            url: "../php/saldo.php",
            method: "POST",
            data: {dni: dni, saldo: saldo},
            success: function(data){
                obtener_datos();
            }
        })
       }

       $(document).on("blur", ".saldo", function(){
            var dni = $(this).data("dni");
            var saldo = $(this).val();

            actualizar_datos(dni, saldo);
       })

    });
</script>