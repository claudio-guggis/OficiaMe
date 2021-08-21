<?php
    require 'database.php'

    // if (!empty($_POST['usuario']) && !empty($_POST['contrasena']))
    // {
    //     $sql = "INSERT INTO usuario(usu_rut, usu_tipo, usu_nombre, usu_paterno, usu_materno, usu_correo, usu_telefono, usu_direccion, usu_fechanac, usu_clave, usu_sexo, usu_comuna, usu_estado) VALUES ()"
    // }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="assets/login.css"> -->
    <title>Registrarse</title>
</head>
<body>
    <div class="contenedor-flexible-principal">
            <div class="contenedor-flexible">
                <form class="form" action="signup.php" method="post">

                    <div class="contenedor-label">
                        <label class="label-rol">Tipo de Usuario</label>
                    </div>
                    
                    <select class="selector">
                        <option value="value1">Trabajador</option>
                        <option value="value2" selected>Cliente</option>
                        <option value="value3">Administrador</option>
                    </select>
                    
                    <div class="form-section">
                        <input type="text" class="form-input" name="usuario" placeholder="RUT">
                    </div>

                    <div class="form-section">
                        <input type="password" class="form-input" name="contrasena" placeholder="Contraseña"> 
                    </div>

                    <button class="boton-registrate">RegistrarMe</button>

                </form>

                <div class="contenedor-flexible-inferior">
                    <a href="login.php"><button class="boton-inicio-sesion">Iniciar Sesión</button></a>
                </div>
            </div>
        </div>
</body>
</html>