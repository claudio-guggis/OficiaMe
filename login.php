<?php
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
	<title>OficiaMe</title>
	<link rel="stylesheet" type="text/css" href="assets/login.css">
</head>
<body>

    <div class="contenedor-flexible-principal">
		<div class="contenedor-flexible">
			<form class="form" action="login.php" method="post">

				<div class="contenedor-label">
					<label class="label-rol">Tipo de Usuario</label>
				</div>
				
				<select class="selector">
				  	<option value="value1">Trabajador</option>
				  	<option value="value2" selected>Cliente</option>
                    <option value="value3">Administrador</option>
				</select>
				
				<div class="form-section">
					<input type="text" class="form-input" placeholder="RUT">
				</div>

				<div class="form-section">
					<input type="password" class="form-input" placeholder="Contraseña"> 
				</div>

				<button class="boton-inicio-sesion">Iniciar Sesión</button>

			</form>

			<div class="contenedor-flexible-inferior">
				<button class="boton-registrate">Regístrate</button>
			</div>
		</div>
	</div>

</body>
</html>