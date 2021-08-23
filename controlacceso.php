<?php

	/*session_start siempre debe ir primero*/
	session_start();

	/*llamamos a la base de datos*/
	require_once('database.php');

	/* Se guardan los datos ingresados en los campos de texto mediante los arrays asociativos, a través del método _POST, definido en el campo de texto
	$variable = $_METODO["name"] */
	$usuario = $_POST["usuario"];
	$contrasena = $_POST["contrasena"];
    $tipo = $_POST["tipo"];
    //print_r($_POST);

	/**
	 * Guardamos la consulta correspondiente, definida en la especificación de módulos y la guardamos en una variable, en este caso, $sql */
	$sql = "SELECT * FROM usuario WHERE usu_rut = '$usuario'";

	/**
	 * Se ejecuta la consulta. Se accede a la base mediante conexion y se ingresa la consulta en sql
	 */
	$result = mysqli_query($conexion, $sql);

	if(mysqli_num_rows($result) == 0) //si el numero de filas es igual a cero (no se encontraron resulados en la tabla)
	{
		echo "<script text='text/javascript'>
		alert('El usuario ".$usuario." no se encuentra registrado en el sistema');
        //window.location = 'login.php';
		</script>";
	}
	else
	{
		//preguntar si los datos del usuario coinciden con los de la base de datos
		$sql = "SELECT usu_rut, usu_clave, usu_tipo FROM usuario WHERE usu_rut = '$usuario' AND usu_clave = '$contrasena' AND usu_tipo = '$tipo'";
		$res = mysqli_query($conexion, $sql);

		if (mysqli_num_rows($res) == 0) {
			echo "<script text='text/javascript'>
			alert('El usuario y el password no coinciden');
			window.location = 'login.php';
			</script>";
		}
		//dar acceso a cada usuario según corresponda
		else
		{
			$_SESSION['user'] = $usuario;
			$_SESSION['typeofuser'] = $tipo;

			if ($tipo == 'C') {
				//header("Location: admin.php");
			}
			elseif ($tipo == 'T') {
				# code...
			}
			else
			{
				header("Location: admin.php");
			}
		}
	}
?>