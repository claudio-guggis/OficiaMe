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
			<!-- <img class="logo" src="imagenes/logo redondo.png"> -->

			<div class="contenedor-logo">
				<img class="logo" src="imagenes/logo redondo.png">
			</div>
			
			<form class="form" action="controlacceso.php" method="post">

				<div class="contenedor-label">
					<label class="label-rol">Tipo de Usuario</label>
				</div>
				
				<select class="selector" name="tipo">
				  	<option value="T">Trabajador</option>
				  	<option value="C" selected>Cliente</option>
                    <option value="A">Administrador</option>
				</select>
				
				<div class="form-section">
					<input type="text" class="form-input" name="usuario" placeholder="RUT">
				</div>

				<div class="form-section">
					<input type="password" class="form-input" name="contrasena" placeholder="Contraseña"> 
				</div>

				<div class="resp-acceso">
					<p class="resp-acceso-p" id="respuesta-acceso"></p>
				</div>

				<button class="boton-inicio-sesion">Iniciar Sesión</button>

			</form>

			<div class="contenedor-flexible-inferior">
				<a href="signup.php"><button class="boton-registrate">Regístrate</button></a>
			</div>

			<div class="contenedor-contacto">
				<a href="formulariocontacto.php"><button class="btn-contacto">Contacto</button></a>
			</div>
		</div>
	</div>

</body>
</html>