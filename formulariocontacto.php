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
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Contacto</title>
</head>
<body>
    <div class="contenedor-formulario">

        <div class="contenedor-logo">
            <img src="imagenes/logo redondo.png" class="img-logo">
        </div>

        <div class="label-formulario">
            <label for="">¡Contáctate con nosotros!</label>
        </div>

        <form action="enviar.php" class="form" method="POST">

            <div class="contenedor-nombres">
                <input type="text" placeholder="Nombre y apellidos" name="name">
            </div>

            <div class="contenedor-correo">
                <input type="text" placeholder="Correo electrónico" name="email" required>
            </div>

            <div class="contenedor-telefono">
                <input type="text" placeholder="Teléfono" name="phone">
            </div>

            <div>
                <textarea name="comment" id="comentario" cols="30" rows="10" placeholder="Comentario"></textarea>
            </div>

            <button class="btn-enviar" name="send">Enviar</button>
        </form>

        <div class="contenedor-volver">
            <a href="login.php"><button class="btn-volver">Volver</button></a>
        </div>
    </div>
</body>
</html>