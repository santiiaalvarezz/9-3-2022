<!DOCTYPE html>
<html lang="sp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
</head>
<body>
	<h1>Inicio de secion</h1>
		<table border=1>
		<tr>
			<th>ID Usuario</th>
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
				$password = $_POST['password'];
            }
				if(isset($_POST['accion']) ){
					$accion = $_POST['accion'];
                
					if ($accion == "modificar"){
						//modificar
						$idUsuario = $_POST['idUsuario']; //cedula nueva
						$sentencia = $conexion->prepare("UPDATE usuariosInicio set idUsuario = ? , password = ? , WHERE idUsuario = ?");
						$sentencia->bind_param("issss",$idUsuario,$fechaNacimiento,$nombre,$nick,$password);	
					}else {
						//eliminar
						$sentencia = $conexion->prepare("DELETE FROM usuariosInicio WHERE idUsuario = ?");
						$sentencia->bind_param("i",$idUsuario);
					}	
                }else{
                    //ingresar
                    $sentencia = $conexion->prepare("INSERT INTO usuariosInicio values (?,?)");
                    $sentencia->bind_param("is,$idUsuario,$password);
                    
                }
                $sentencia->execute();
			
			//echo "Conexion exitosa!";
			
			//Mostramos los datos ingresados			
			$resultado = $conexion->query('SELECT * FROM usuariosRegistro');
			
			while (($fila = $resultado->fetch_assoc())){
				echo "<tr>";
				echo "<td>" . $fila['idUsuario'] . "</td>";
				echo "<td>" . $fila['password'] . "</td>";
			
				echo "<td><a href='datos555.php?mod=" . $fila['idUsuario'] . "'>M</a></td>";
				echo "<td><a href='datos555.php?del=" . $fila['idUsuario'] . "'>X</a></td>";
				echo "</tr>";
			}
		?>
		</table>
		
</body>
</html>