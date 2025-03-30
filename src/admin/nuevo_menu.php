<?php 
    include("../php/conexion_bdd.php");

    $categoria_menu=mysqli_query($con, "SELECT id, categoria FROM categoria_menu");
    $estado_menu=mysqli_query($con, "SELECT id_estado_menu, estado_menu FROM estado_menu");
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>Buffet'S - Nuevo menú</title>
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
                        <h1>Nuevo menú</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="content mt-3">
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="container">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <form method="POST" enctype="multipart/form-data" id="form_menu">
                                    <div class="card">
                                        <div class="card-header"><strong>Añadir un nuevo menú</strong></div>
                                        <div class="card-body card-block">
                                            <div class="form-group">
                                                <label for="company" class="form-control-label">Plato</label><input type="text" id="plato" placeholder="Ingrese el nombre de su plato" class="form-control" name="plato" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="vat" class=" form-control-label">Precio</label><input type="number" id="precio" placeholder="Ingrese el precio" class="form-control" name="precio" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="vat" class=" form-control-label">Stock</label><input type="number" id="stock" placeholder="Ingrese la cantidad en stock" min="0" max="" class="form-control" name="stock" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <div class="card-header">
                                                    <label class="card-title">Estado</label>
                                                </div>
                                                <div class="card-body">
                                                    <select class="form-control" tabindex="1" name="estado" id="estado">
                                                        <option value=""></option>
                                                        <?php while ($row2=mysqli_fetch_array($estado_menu)) {
                                                            $id=$row2['id_estado_menu'];
                                                            $estado=$row2['estado_menu'];
                                                            echo "<option value='$id'>".$estado."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="card-header">
                                                    <label class="card-title">Categoria</label>
                                                </div>
                                                <div class="card-body">
                                                    <select class="form-control" tabindex="1" name="categoria" id="categoria">
                                                        <option value=""></option>
                                                        <?php while ($row=mysqli_fetch_array($categoria_menu)) {
                                                            $id=$row['id'];
                                                            $categoria=$row['categoria'];
                                                            echo "<option value='$id'>".$categoria."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" class="form-control-label">Descripción</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea id="descripcion" rows="6" placeholder="Descripcion del producto" class="form-control" name="descripcion" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="image" class="form-control-label" style="margin-top: 30px;">Suba una imagen del producto (la seleccion de una imagen es opcional)</label>
                                                <input name="imagen" id="imagen" type="file">
                                            </div>
                                            <button type="submit" value="Agregar" name="enviar" id="btn-menu" class="btn btn-primary btn-lg">Subir</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title">Nueva categoria</strong>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" id="form_categoria">
                                            <div class="form-group">
                                                <label for="company" class=" form-control-label">Nombre</label>
                                                <input type="text" placeholder="Ingrese el nombre de la nueva categoria" class="form-control" id="nueva_categoria" name="new_categoria" required autocomplete="off">
                                            </div>
                                            <button type="button" value="Agregar" name="enviar" id="btn-categoria" class="btn btn-primary btn-lg">Subir</button>
                                        </form>
                                    </div>
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
    $(document).ready(function(e){
        $("#form_menu").on('submit', function(e){
            e.preventDefault();
            if ($('input[type="text"]').val()=="" || $('input[type="number"]').val()=="" || $('#descripcion').val()=="" || $('#estado').val()=="" || $('#categoria').val()=="") {
                swal("Datos incompletos!", "Debes completar todos los campos del nuevo menú para incorporarlo", "warning");
            }else{
                $.ajax({
                    type: 'POST',
                    url: '../php/alta_menu.php',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        $('#btn-menu').attr("disabled","disabled");
                    },
                    success: function(resultado){
                        console.log("success" + resultado);
                        if(resultado == 'ok'){
                            swal("Nuevo menú añadido!", "El menú fue incorporado con exito al sistema", "success");
                            $('#form_menu')[0].reset();
                        }
                        $("#btn-menu").removeAttr("disabled");
                    },
                    error: function(xhr, status, error){
                        console.error("Error: " + error);
                        console.error("Status: " + status);
                        console.error("Response: " + xhr.responseText);
                        swal({title: "Error en la carga", icon: "warning",});
                        $("#btn-menu").removeAttr("disabled");
                    }
                });
            }
        });
    
        //Validacion del tipo de archivo que se intenta subir
        $("#imagen").change(function() {
            var file = this.files[0];
            var imagefile = file.type;
            var match= ["image/jpeg","image/png","image/jpg"];
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
                swal({title: "Archivo incorrecto!", text: "Por favor selecciona una imagen JPEG, JPG o PNG.", icon: "warning", dangerMode: true, });
                $("#imagen").val('');
                return false;
            }
        });
    });
</script>
<script>
    $(document).on('click', '#btn-categoria', function(){
        var nueva_categoria = $('#nueva_categoria').val();
        var datos = $('#form_categoria').serialize();
        if (nueva_categoria!="") {
            $.ajax({
                type: "POST",
                url: "../php/alta_categoria.php",
                data: datos,
                success:function(respuesta){
                    if (respuesta==1) {
                        swal("Nueva categoria añadida!", "La categoria de comida fue incorporada con exito al sistema", "success");
                        $('#nueva_categoria').val('');
                    }else{
                        swal({title: "Error en la carga", icon: "warning",});
                    }
                }
            });
            return false;  
        }else{
            swal("Datos incompletos!", "Debes escribir el nombre de la categoria para incluirla", "warning");
        }
    });
</script>