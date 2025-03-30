<?php 
    include("../php/conexion_bdd.php");
    include("../php/sesion.php");

    if (isset($_GET["id"])) {
        $id_menu=$_GET["id"];
    }else{
        header("Location: index.php");
    }

    $menu=mysqli_query($con, "SELECT estado_menu.id_estado_menu,estado_menu.estado_menu,categoria_menu.id,menu.id_menu,menu.plato,menu.precio,menu.descripcion,categoria_menu.categoria,
    menu.estado,menu.stock,menu.url_img FROM categoria_menu INNER JOIN menu ON 
    menu.categoria=categoria_menu.id INNER JOIN estado_menu ON estado_menu.id_estado_menu=menu.estado WHERE menu.id_menu=$id_menu;");
    $row=mysqli_fetch_array($menu);
    $categoria_menu=mysqli_query($con, "SELECT id,categoria FROM categoria_menu;");
    $estado_menu=mysqli_query($con, "SELECT id_estado_menu, estado_menu FROM estado_menu");
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>Buffet'S - Editar menú</title>
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
                        <h1>Editar menú</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="content mt-3">
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="container">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <form method="POST" id="form_menu" enctype="multipart/form-data">
                                    <div class="card">
                                        <div class="card-header"><strong>Editar menú existente</strong></div>
                                        <div class="card-body card-block">
                                            <div class="form-group">
                                                <label for="company" class=" form-control-label">Plato</label><input type="text" id="plato" class="form-control" name="plato" value="<?=$row['plato'];?>" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="vat" class=" form-control-label">Precio</label><input type="number" id="precio" class="form-control" name="precio" value="<?=$row['precio'];?>" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="vat" class=" form-control-label">Stock</label><input type="number" id="stock" min="0" max="" class="form-control" name="stock" value="<?=$row['stock'];?>" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <div class="card-header">
                                                    <label class="card-title">Estado</label>
                                                </div>
                                                <div class="card-body">
                                                    <select class="form-control" name="estado" id="estado">
                                                        <option value="<?=$row['id_estado_menu'];?>"><?php echo $row['estado_menu']; ?></option>
                                                        <?php while ($row2=mysqli_fetch_array($estado_menu)) {
                                                                $id=$row2['id_estado_menu'];
                                                                $estado=$row2['estado_menu'];
                                                                echo "<option value='$id' required>".$estado."</option>";
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
                                                    <select class="form-control" name="categoria" id="categoria">
                                                        <option value="<?=$row['id'];?>"><?php echo $row['categoria']; ?></option>
                                                        <?php while ($row2=mysqli_fetch_array($categoria_menu)) {
                                                                    $id=$row2['id'];
                                                                    $categoria_menu2=$row2['categoria'];
                                                                    echo "<option value='$id'>".$categoria_menu2."</option>";
                                                                }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" id="categoria" class="form-control-label">Descripción</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea id="descripcion" rows="6" class="form-control" name="descripcion"  autocomplete="off" value="<?=$row['descripcion'];?>"><?php echo $row['descripcion']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <center>
                                                <?php echo "<img src='../usuario/images/menu/".$row['url_img']."' alt='SIN IMAGEN DEL PRODUCTO' style='margin-top: 30px; width: 45%;'>"; ?>
                                                </center>
                                                <div style="clear: both;">
                                                    <label for="image" class="form-control-label" style="margin-top: 30px;">Cambie o agregue una imagen al producto (opcional)</label>
                                                <input name="imagen" id="imagen" value="<?=$row['url_img'];?>" type="file" maxlength="150">
                                                </div>
                                                <input type="number" name="id_menu" style="display: none;" value="<?=$id_menu;?>">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" id="btn-menu" class="btn btn-primary btn-lg">Subir</button>
                                            </div>
                                        </div>
                                    </div>
                            </form>
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
                swal("Datos incompletos!", "Debes completar todos los campos del menú para poder actualizarlo", "warning");
            }else{
                $.ajax({
                    type: 'POST',
                    url: '../php/editar_menu.php',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        $('#btn-menu').attr("disabled","disabled");
                    },
                    success: function(resultado){
                        if(resultado == 'ok'){
                            swal("Menú actualizado!", "El menú fue actualizado en el sistema correctamente", "success")
                            .then((confirmar) => {
                              if (confirmar) {
                                location.reload();
                              }
                            });
                        }
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