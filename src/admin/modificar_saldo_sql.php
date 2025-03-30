<?php 
	include("../php/conexion_bdd.php");
    include("../php/conexion_bdd_escuela.php");

    $query_buffet=mysqli_query($con, "SELECT usuario.dni, tipo_usuario.id_tipo_usuario, usuario.saldo FROM usuario INNER JOIN 
    tipo_usuario ON usuario.tipo_usuario=tipo_usuario.id_tipo_usuario INNER JOIN estado_usuario ON usuario.estado=estado_usuario.id_estado_usuario;");

    while ($row=mysqli_fetch_array($query_buffet)) {
        $dni=$row['dni'];
        $saldo=$row['saldo'];
        $id_tipo_usuario=$row['id_tipo_usuario'];

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
                <td> <input type='number' id='saldo' class='form-control saldo' value='".$saldo."' data-dni='".$dni."'> 
                </td>
            </tr>
        ";
    }
?>