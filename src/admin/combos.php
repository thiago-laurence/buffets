<?php 
	require("../php/conexion_bdd.php");
    $menu=mysqli_query($con, "SELECT menu.plato, menu.id_menu, menu.categoria AS id_categoria, categoria_menu.categoria, menu.precio FROM menu INNER JOIN 
        categoria_menu ON menu.categoria=categoria_menu.id;");
    $menu2=mysqli_query($con, "SELECT menu.plato, menu.id_menu, menu.categoria AS id_categoria, categoria_menu.categoria, menu.precio FROM menu INNER JOIN 
        categoria_menu ON menu.categoria=categoria_menu.id;");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Buffet'S - Combos</title>
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
</head>
<body>
	<?php include("header.php"); ?>

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
                        <h1>Añadir, editar o eliminar combos promocionales</h1>
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
                                    <strong>Crear un nuevo combo.</strong> Complete todos los datos necesarios.
                                </div>
                                <div class="card-body card-block">
                                    <form enctype="multipart/form-data" method="POST" id="form">
                                        <div class="form-group">
                                            <label for="nf-email" class=" form-control-label">Nombre</label><input type="text" id="combo" name="combo" placeholder="Ingrese el nombre del combo" class="form-control" autocomplete="off">
                                        </div>
                                        <div >
                                            <input type="text" name="id" id="id" value="insertar" style="display: none;">
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-1">
                                                <label for="textarea-input" class=" form-control-label">Descripción</label>
                                            </div>
                                            <div class="col-12 col-md-6"><textarea name="descripcion" id="descripcion" rows="3" placeholder="Contenido..." class="form-control" autocomplete="off"></textarea></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="file-input" class=" form-control-label">Selecciona una imagen promocional (opcional)</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="file" id="imagen" name="imagen">
                                            </div>
                                        </div>
                                        <div class="row form-group" id="img-registrada">

                                        </div>
                                        
                                        <div class="card-header">
                                            <strong class="card-title">Seleccione los productos</strong>
                                        </div>
                                        <div class="card-body" id="productos">
                                            <div id="productosv2">
                                                <select data-placeholder="Productos registrados en el sistema" multiple class="standardSelect" tabindex="5" name="productos[]" id="selectProductos">
                                                    <option value=""></option>
                                                    <?php 
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
                                                            echo "<option class='producto' value='".$id_menu."' data-precio='".$precio."' data-plato='".$plato."'>".$plato."</option>";
                                                            mysqli_data_seek($menu2, $pos);
                                                            $fila_id = mysqli_fetch_row($menu2);
                                                            $id_sig=$fila_id[2];
                                                            if ($id_sig!=$id_categoria) {
                                                                echo "</optgroup>";
                                                                $vof=1;  
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="lista-precio">
                                            <label for="nf-email" class=" form-control-label">
                                                Precio de los productos elegidos:
                                                <br>
                                                <div id="factura">
                                                    
                                                    
                                                </div>
                                                Escriba el precio correspondiente a este combo.
                                            </label>
                                            <input type="number" id="precio" name="precio" placeholder="Ingrese el precio" class="form-control" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="nf-email" class=" form-control-label">
                                                Stock
                                            </label>
                                            <input type="number" id="stock" name="stock" placeholder="Ingrese el stock disponible" class="form-control" autocomplete="off">
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary btn-sm" id="btn-agregar">
                                                Aceptar <i class="fa fa-check"></i> 
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Combos registrados en el sistema.</strong> Tiene la opción de modificar o eliminar el que desee.
                                </div>
                            </div>
                        </div>
	                	<div class="row col-md-12" id="datos">
                        
                        </div>
	                </div><!-- .row -->
	            </div><!-- .animated -->
        	</div><!-- .content -->
        </div>
        
    </div><!-- /#right-panel -->
</body>
</html>
<script src="vendors/chosen/chosen.jquery.min.js"></script>
<script>  
    jQuery(document).ready(function() {  
        function obtener_datos(){
            $.ajax({
                url: "pagina_datos_combos.php",
                method: "POST",
                success: function(data){
                    $("#datos").html(data)
                }
            })
        }
        obtener_datos();

        var precio_combo=0;
        var cont = 0;
        $(document).on("change", "#selectProductos", function(){
            /*var precio = $('#producto-individual').data('precio');
            var plato = $('#producto-individual').data('plato');
            precio_combo = precio_combo+precio;
            var producto = '<p>- '+plato+': $'+precio+'</p>';
            $('#factura').append(producto);*/
            var producto = $('#selectProductos').val();
            var elemento = $('.producto').val();
            if (cont == 0) {
                console.log("id: "+producto[cont]);
                cont++;
            }else{

                if (producto[cont] != undefined) {
                    console.log("agrego producto: "+producto[cont]);
                    cont++;
                }else{
                    console.log("elimino producto: ");
                    cont--;
                }

            }
            
            //console.log(elemento);
            //alert(producto);
            //console.log(xd);
        })

        $(document).on("click", "#btn-eliminar", function(){
            var nombre = $(this).data("nombre")
            var id_combo = $(this).data("id");
            var id = $("#id").val();
            id = "borrar";
            swal({
              title: "¿Seguro desea eliminar el combo: "+nombre+" ?",
              text: "El combo sera eliminado del sistema",
              icon: "warning",
              buttons: ["Cancelar", "Aceptar"],
            })
            .then((confirmar) => {
              if (confirmar) {
                $.ajax({
                  type: "POST",
                  url: "../php/abm_combos.php?id_combo="+id_combo+"&id="+id,
                  data: id,
                  success:function(respuesta){
                      if (respuesta==1) {
                        swal({title: "Error!", icon: "warning",});
                      }else{  
                        swal("Combo eliminado correctamente!", "El combo fue elimando del sistema satisfactoriamente.", "success");
                        obtener_datos();
                      }
                  }
                });
                return false;
              }
            });
        })

        var productos_once=0;
        $(document).on("click", "#btn-editar", function(){
            var id_combo = $(this).data("id");
            var id = $("#id").val();
            var nombre = $(this).data("nombre");
            var descripcion = $(this).data("descripcion");
            var stock = $(this).data("stock");
            var precio = $(this).data("precio");
            var img = $(this).data("img");
            

            $("#id").val(id_combo);
            id = "editar";
            $.ajax({
                type: 'POST',
                url: '../php/abm_combos.php?id='+id+'&id_combo='+id_combo,
                data: id,
                success: function(data){
                    var imagen_registrada = '<div id="dentro-img"><div class="col col-md-3"><label for="file-input" class=" form-control-label">Imagen registrada:</label></div><div class="col col-md-9"><img src="../usuario/images/menu/'+img+'" width="100px" alt="SIN IMAGEN"></div></div>';
                    $('#productosv2').remove();
                    $('#productos').append(data);
                    if (productos_once==0) {
                        $('#img-registrada').append(imagen_registrada);
                        productos_once++;
                    }else{
                        $('#dentro-img').remove();
                        $('#img-registrada').append(imagen_registrada);
                    }
                    $('#combo').val(nombre);
                    $('#descripcion').val(descripcion);
                    $('#precio').val(precio);
                    $('#stock').val(stock);
                    $('#imagen').val(img);
                }
            });
        })


        $("#form").on('submit', function(e){
            e.preventDefault();
            var id = $('#id').val();

            if (id=="insertar") {
                if ($('#combo').val()=="" || $('#precio').val()=="" || $('#descripcion').val()=="" || $('#selectProductos').val()=="" || $('#stock').val()=="") {
                    swal("Datos incompletos!", "Debes completar todos los campos para agregar un nuevo combos.", "warning");
                }else{
                    $.ajax({
                        type: 'POST',
                        url: '../php/abm_combos.php?id='+id,
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData:false,
                        beforeSend: function(){
                            $('#btn-agregar').attr("disabled","disabled");
                        },
                        success: function(resultado){
                            if(resultado == 'ok'){
                                swal({title: "Error!", icon: "warning",});
                            }else{
                                swal("Nuevo combo añadido!", "El combo fue incorporado con exito al sistema", "success");
                                $('#form')[0].reset();
                                $('#selectProductos').trigger('chosen:updated');
                                $('#dentro-img').remove();
                                productos_once=0;
                                obtener_datos();
                            }
                            $("#btn-agregar").removeAttr("disabled");
                        }
                    });
                }
            }else{
                if ($('#combo').val()=="" || $('#precio').val()=="" || $('#descripcion').val()=="" || $('#selectProductos').val()=="" || $('#stock').val()=="") {
                swal("Datos incompletos!", "Debes completar todos los campos para poder efectuar los cambios.", "warning");
                }else{
                    $.ajax({
                        type: 'POST',
                        url: '../php/abm_combos.php?id='+id,
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData:false,
                        beforeSend: function(){
                            $('#btn-agregar').attr("disabled","disabled");
                        },
                        success: function(resultado){
                            if(resultado == ' '){
                                swal({title: "Error!", icon: "warning",});
                            }else{
                                swal("Combo actualizado!", "El combo fue modificado con exito en el sistema", "success");
                                $('#form')[0].reset();
                                $('#dentro-img').remove();
                                $('#productosv2').remove();
                                $('#productos').append(resultado);
                                productos_once=0;
                                obtener_datos();
                            }
                            $("#btn-agregar").removeAttr("disabled");
                        }
                    });
                }
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

        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Lo siento, no se encontro coincidencia!",
            width: "100%"
        });

    });
</script>
