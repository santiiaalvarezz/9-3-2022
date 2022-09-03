<!DOCTYPE html>
<html lang="sp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
</head>
<body>
	<h1>DATOS DE USUARIOS</h1>
		<table border=1>
		<tr>
			<th>ID Usuario</th>
			<th>Fecha de Nacimiento</th>
			<th>Nombre</th>
            <th>Nick</th>
            <th>Contraseña</th>
			<th>Modificar</th>
			<th>Eliminar</th>
		</tr>
		
		<?php
		
			$conexion = mysqli_connect('localhost','root','','lonig');
			if(!$conexion){
				die('Error en la conexion. ' . mysqli_connect_error());			
			}

			//Vamos a ingresar un nuevo contacto			
			if (isset($_POST['idUsuario']) ){
				$idUsuario = $_POST['idUsuario'];
				$fechaNacimiento = $_POST['fechaNacimiento'];
				$nombre = $_POST['nombre'];
                $nick = $_POST['nick'];
				$password = $_POST['password'];
            }
				if(isset($_POST['accion']) ){
					$accion = $_POST['accion'];
                
					if ($accion == "modificar"){
						//modificar
						$idUsuario = $_POST['idUsuario']; //cedula nueva
						$sentencia = $conexion->prepare("UPDATE usuarios set idUsuario = ? , fechaNacimiento = ? , nombre = ? , nick = ? , password = ? , WHERE idUsuario = ?");
						$sentencia->bind_param("issss",$idUsuario,$fechaNacimiento,$nombre,$nick,$password);	
					}else {
						//eliminar
						$sentencia = $conexion->prepare("DELETE FROM usuarios WHERE idUsuario = ?");
						$sentencia->bind_param("i",$idUsuario);
					}	
                }else{
                    //ingresar
                    $sentencia = $conexion->prepare("INSERT INTO usuarios values (?,?,?,?,?)");
                    $sentencia->bind_param("issss",$idUsuario,$fechaNacimiento,$nombre,$nick,$password);
                    
                }
                $sentencia->execute();
			
			//echo "Conexion exitosa!";
			
			//Mostramos los datos ingresados			
			$resultado = $conexion->query('SELECT * FROM usuarios');
			
			while (($fila = $resultado->fetch_assoc())){
				echo "<tr>";
				echo "<td>" . $fila['idUsuario'] . "</td>";
				echo "<td>" . $fila['fechaNacimiento'] . "</td>";
				echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['nick'] . "</td>";
				echo "<td>" . $fila['password'] . "</td>";
			
				echo "<td><a href='datos333.php?mod=" . $fila['idUsuario'] . "'>M</a></td>";
				echo "<td><a href='datos333.php?del=" . $fila['idUsuario'] . "'>X</a></td>";
				echo "</tr>";
			}
		?>
		</table>
		
</body>
</html>