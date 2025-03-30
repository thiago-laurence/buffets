<?php    
    include("../php/conexion_bdd.php");
    include("../php/conexion_bdd_escuela.php");

	$query_pedido=mysqli_query($con, "SELECT pedido.id_pedido, tipo_usuario.id_tipo_usuario, estado_pedido.id_estado_pedido, estado_pago.id, estado_pago.estado, pedido.dni, tipo_usuario.tipo_usuario, estado_pedido.estado_pedido, 
    menu.plato FROM estado_pago INNER JOIN pedido ON estado_pago.id=pedido.estado_pago INNER JOIN usuario ON usuario.dni=pedido.dni INNER JOIN tipo_usuario ON usuario.tipo_usuario=tipo_usuario.id_tipo_usuario INNER JOIN menu ON pedido.id_menu=menu.id_menu 
      INNER JOIN estado_pedido ON pedido.estado=estado_pedido.id_estado_pedido
      WHERE usuario.dni=pedido.dni AND pedido.id_menu=menu.id_menu ORDER BY estado_pago.id asc;");

    $contador = 0;

    while ($row=mysqli_fetch_array($query_pedido)) {
        $dni=$row['dni'];
        $estado_pago=$row['estado'];
        $id_pedido=$row['id_pedido'];
        $id_estado_pago=$row['id'];
        $estado_pedido=$row['estado_pedido'];
        $id_estado_pedido=$row['id_estado_pedido'];
        $tipo_usuario=$row['tipo_usuario'];
        $id_tipo_usuario=$row['id_tipo_usuario'];
        $plato=$row['plato'];
        
        $contador++;

        if ($id_tipo_usuario==2) {
            $sql="SELECT personal.nombre, personal.apellido FROM personal WHERE personal.dni='".$dni."';";
            $query_personal=mysqli_query($con2, $sql);
            $row2=mysqli_fetch_array($query_personal);
        }else{
            $sql="SELECT alumnos.nombre, alumnos.apellido FROM alumnos WHERE alumnos.dni='".$dni."';";
            $query_alumno=mysqli_query($con2, $sql);
            $row2=mysqli_fetch_array($query_alumno);
        }

        $nombre_completo=$row2['nombre']." ".$row2['apellido'];
        echo "
        <tr>
            <td>".$dni."</td>
            <td>".$nombre_completo."</td>
            <td class='plato'>".$plato."</td>
            <td>
                <select class='form-control id_estado_pedido' data-contador='".$contador."' name='estado_pedido' data-id_pedido='".$row['id_pedido']."'>
                    <option value='".$id_estado_pedido."'>"
                    .$estado_pedido.
                    "</option>";
                    $query_estado_pedido=mysqli_query($con, "SELECT id_estado_pedido AS ID, estado_pedido AS ESTADO FROM estado_pedido");
                    while ($row=mysqli_fetch_array($query_estado_pedido)) {
                        echo "<option value='".$row['ID']."'>".$row['ESTADO']."</option>";
                    }
                    echo "
                </select>
            </td>
            <td>
                <select class='form-control id_estado_pago' name='estado_pago' data-contador='".$contador."' data-id_pedido2='".$id_pedido."' >
                        <option value='".$id_estado_pago."'>"
                        .$estado_pago.
                        "</option>";
                        $query_estado_pago=mysqli_query($con, "SELECT id AS ID, estado AS ESTADO FROM estado_pago");
                        while ($row=mysqli_fetch_array($query_estado_pago)) {
                            echo "<option value='".$row['ID']."'>".$row['ESTADO']."</option>";
                        }
                    echo "
                </select>
            </td>
        </tr>
        ";
    }

?>