<!DOCTYPE html>
<html>
<head>
	<title>Datos de Contacto</title>
</head>
<body>
	<H1>Datos de Contacto</H1>
	<?php		
			$conexion = mysqli_connect('localhost','root','','lonig');
			if(!$conexion){
				die('Error en la conexion. ' . mysqli_connect_error());			
			}
			if (isset($_GET['mod'])){
				//Vamos a modificar
				$idUsuario = $_GET['mod'];
				$accion = "modificar";
				
			}else {
				if (isset($_GET['del'])){
					//vamos a eliminar
					$idUsuario = $_GET['del'];
					$accion = "eliminar";
				}
			}
			if(isset($telefono)){
				//Obtengo los datos del contacto a modificar o a eliminar
				$sentencia = $conexion->prepare("SELECT * FROM usuarios WHERE idUsuario =  ?");
				$sentencia->bind_param("i",$idUsuario);
				$sentencia->execute();	//ejecutar la sentencia
				$sentencia->store_result();	//almacenar el resultado
				$sentencia->bind_result($idUsuario,$fechaNacimiento,$nombre,$nick,$password); //obtener los datos de cada columna
				$sentencia->fetch();
				
	?>
	<form action="conexion1.php" method="POST">
		ID Usuarios:<input type="number" name="idUsuario" value="<?php echo  $idUsuario;	?>"><br>
		Fecha de Nacimiento: <input type="date" name="fechaNacimiento" value="<?php echo $fechaNacimiento; ?>"><br>
		Nombre: <input type="text" name="nombre" value="<?php echo $nombre; ?>"><br>
        nick: <input type="text" name="nick" value="<?php echo $nick; ?>"><br>
        password: <input type="text" name="password" value="<?php echo $password; ?>"><br>
	
							<input type="hidden" name="accion" value="<?php echo $accion; ?>">
							<input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>">
							<input type="submit" value="Enviar">
	</form>
	<?php
		}else{
			//El usuario va ingresar uno nuevo	
	?>
	<form action="conexion1.php" method="POST">
    ID Usuarios:<input type="number" name="idUsuario" value="<?php echo  $idUsuario;	?>"><br>
		Fecha de Nacimiento: <input type="date" name="fechaNacimiento" value="<?php echo $fechaNacimiento; ?>"><br>
		Nombre: <input type="text" name="nombre"    ><br>
        nick: <input type="text" name="nick" ><br>
        password: <input type="text" name="password" ><br>
							<input type="submit" value="Enviar">
	</form>
	<?php
		}	
	?>
</body>
</head>
</html>
