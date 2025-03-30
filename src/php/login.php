<?php 
	require("conexion_bdd.php");
	require("conexion_bdd_escuela.php");
	$usuario="";
	$password="";

	if(isset($_POST["usuario"])) {
		$usuario=$_POST["usuario"];
	} 
	if(isset($_POST["password"])) {
		$password=$_POST["password"];
	}

	if($usuario!='' || $password!=''){
		//Pregunta si es ADMIN
		$query= sprintf("SELECT COUNT(admin.dni) AS ADMIN, admin.dni, admin.nombre, admin.apellido FROM admin 
			WHERE admin.dni='%s' AND admin.pass=SHA1('%s')", 
		mysqli_real_escape_string($con,$usuario), 
		mysqli_real_escape_string($con,$password));
		$result=mysqli_query($con,$query) or die(mysqli_error());
		$row=mysqli_fetch_array($result);
		if ($row['ADMIN']==1) {
			session_name("loginbuffet");
			session_start();
			$consulta="SELECT pass FROM admin WHERE dni='".$usuario."';";
			$ejecutar_consulta=mysqli_query($con, $consulta);
			$array_consulta=mysqli_fetch_array($ejecutar_consulta);
			$_SESSION["documento"]=$row["dni"];
			$_SESSION["nombre"]=$row["nombre"];
			$_SESSION["apellido"]=$row["apellido"];
			$_SESSION["password"]=$array_consulta["pass"];
			$_SESSION['admin']="ok";
			header("Location: ../admin/index.php");
		}else{
			//PREGUNTA SI LOS DATOS EXISTEN EN LA BDD DE LA ESCUELA EN LA TABLA ALUMNOS
			$query= sprintf("SELECT COUNT(alumnos.dni) AS CANTIDAD, alumnos.dni, alumnos.nombre, alumnos.apellido FROM alumnos 
				WHERE alumnos.dni='%s' AND alumnos.clave='%s'", 
			mysqli_real_escape_string($con2,$usuario), 
			mysqli_real_escape_string($con2,$password));
			$result=mysqli_query($con2,$query) or die(mysqli_error());
			$row=mysqli_fetch_array($result);

			if ($row['CANTIDAD']==1) {
				//SI EXISTE ALGUN ALUMNO, PREGUNTA SI EXISTE EN LA BDD DEL BUFFET
				$alumno=mysqli_query($con, "SELECT tipo_usuario, estado FROM usuario WHERE dni='".$row['dni']."';");
				$alumno=mysqli_fetch_array($alumno);
				if ($alumno) {
					//echo "si alumno";
					$estado_usuario=$alumno['estado'];
					$tipo_usuario=$alumno['tipo_usuario'];

					if($estado_usuario==1){
						session_name("loginbuffet");
						session_start();
						$consulta="SELECT clave FROM alumnos WHERE dni='".$usuario."';";
						$ejecutar_consulta=mysqli_query($con2, $consulta);
						$array_consulta=mysqli_fetch_array($ejecutar_consulta);
						$_SESSION["password"]=$array_consulta["clave"];
						$_SESSION["documento"]=$row["dni"];
						$_SESSION["nombre"]=$row["nombre"];
						$_SESSION["apellido"]=$row["apellido"];
						if($tipo_usuario==3){
							$_SESSION["password"]=$array_consulta["pass"];
							header("Location: ../admin/index.php");
						}else{
							header("Location: ../usuario/menu_pedido.php");
						}
					}else if($estado_usuario==2){
						session_name("loginbuffet");
						session_start();
						$consulta="SELECT clave FROM alumnos WHERE dni='".$usuario."';";
						$ejecutar_consulta=mysqli_query($con2, $consulta);
						$array_consulta=mysqli_fetch_array($ejecutar_consulta);
						$_SESSION["password"]=$array_consulta["clave"];
						$_SESSION["documento"]=$row["dni"];
						$_SESSION["menu"]="../usuario/bloqueado.php";
						$_SESSION["nombre"]=$row["nombre"];
						$_SESSION["apellido"]=$row["apellido"];
						header("Location: ../usuario/bloqueado.php");
					}
				}else{
					//SI EXISTE EL ALUMNO EN LA ESCUELA PERO NO EN LA BDD DEL BUFFET, LO INSERTO EN ESTA
					$sql2="INSERT INTO usuario (dni, tipo_usuario, estado, saldo) VALUES ('".$row['dni']."', 1, 1, 0)";
					$new_alumno=mysqli_query($con, $sql2);
					header("Location: ../usuario/re_logueo.php");
					//echo "no alumno";
				}
				//echo "ES ALUMNO";
			}else{
				// SI NO EXISTE NINGUN ALUMNO, PREGUNTE SI LOS DATOS CORRESPONDEN A ALGUN MIEMBRO ESCOLAR EN LA TABLA PERSONAL
				$query= sprintf("SELECT COUNT(personal.dni) AS CANTIDAD, personal.dni, personal.nombre, personal.apellido FROM personal WHERE personal.dni='%s' AND pass='%s'", 
				mysqli_real_escape_string($con2,$usuario), 
				mysqli_real_escape_string($con2,$password));
				$result=mysqli_query($con2,$query) or die(mysqli_error());
				$row=mysqli_fetch_array($result);

				if ($row['CANTIDAD']==1) {
					// SI LOS DATOS CORRESPONDEN A ALGUN MIEMBRO ESCOLAR, PREGUNTA SI ESTE EXISTE EN LA BDD DEL BUFFET
					$docente=mysqli_query($con, "SELECT tipo_usuario, estado FROM usuario WHERE dni='".$row['dni']."';");
					$docente=mysqli_fetch_array($docente);
					if ($docente) {
						//echo "si docente";
						$estado_usuario=$docente['estado'];
						$tipo_usuario=$docente['tipo_usuario'];

						if($estado_usuario==1){
							session_name("loginbuffet");
							session_start();
							$consulta="SELECT pass FROM personal WHERE dni='".$usuario."';";
							$ejecutar_consulta=mysqli_query($con2, $consulta);
							$array_consulta=mysqli_fetch_array($ejecutar_consulta);
							$_SESSION["password"]=$array_consulta["pass"];
							$_SESSION["documento"]=$row["dni"];
							$_SESSION["nombre"]=$row["nombre"];
							$_SESSION["apellido"]=$row["apellido"];
							if($tipo_usuario==3){
								header("Location: ../admin/index.php");
							}else{
								header("Location: ../usuario/menu_pedido.php");
							}
						}else if($estado_usuario==2){
							session_name("loginbuffet");
							session_start();
							$consulta="SELECT pass FROM personal WHERE dni='".$usuario."';";
							$ejecutar_consulta=mysqli_query($con2, $consulta);
							$array_consulta=mysqli_fetch_array($ejecutar_consulta);
							$_SESSION["password"]=$array_consulta["pass"];
							$_SESSION["documento"]=$row["dni"];
							$_SESSION['menu']="..usuario/bloqueado.php";
							$_SESSION["nombre"]=$row["nombre"];
							$_SESSION["apellido"]=$row["apellido"];
							header("Location: ../usuario/bloqueado.php");
						}
					}else{
						//SI EXISTE EL PERSONAL EN LA ESCUELA PERO NO EN LA BDD DEL BUFFET, LO INSERTO EN ESTA
						$sql="INSERT INTO usuario (dni, tipo_usuario, estado, saldo) VALUES ('".$row['dni']."', 2, 1, 0)";
						$new_personal=mysqli_query($con, $sql);
						header("Location: ../usuario/re_logueo.php");
						//echo "no docente";
					}
					//echo "ES DOCENTE";
				}else{
					header("Location: ../usuario/iniciar_sesion.php");
				}
			}
		}	
	}
?>