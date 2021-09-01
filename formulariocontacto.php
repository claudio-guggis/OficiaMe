<?php
    session_start();

    //$tipo = $_SESSION['type'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/formulariocontacto.css">
    <title>Contacto</title>
</head>
<body>
    <div class="contenedor-principal">

        <div class="contenedor-izquierdo">
            <div class="contenedor-logo">
                <img src="imagenes/logo redondo.png" class="img-logo">
            </div>
        </div>

        <div class="contenedor-derecho">

            <div class="contenedor-formulario">
                <form action="enviar.php" class="form" method="POST">

                    <div class="label-formulario">
                        <label for="">¡Contáctate con nosotros!</label>
                    </div>

                    <div class="contenedor-nombres">
                        <input class="input-nombres" type="text" placeholder="Nombre y apellidos" name="name">
                    </div>

                    <div class="contenedor-correo">
                        <input class="input-correo" type="text" placeholder="Correo electrónico" name="email" required>
                    </div>

                    <div class="contenedor-telefono">
                        <input class="input-telefono" type="text" placeholder="Teléfono" name="phone">
                    </div>

                    <div class="contenedor-areatexto">
                        <textarea class="tacomentario" name="comment" id="comentario" cols="30" rows="10" placeholder="Comentario"></textarea>
                    </div>

                    <div class="contenedor-btn-enviar">
                        <button class="btn-enviar" name="send">Enviar</button>
                    </div>
                
                </form>

                <div class="contenedor-volver">
                    <button class="btn-volver" onclick="location.href='login.php'">Volver</button>
                    <!-- <a href="login.php"><button class="btn-volver">Volver</button></a> -->
                </div>
                
            </div>
            
        </div>
        
    </div>
</body>
</html>