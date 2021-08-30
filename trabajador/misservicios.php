<?php
    session_start(); //siempre debe ir cuando se trabaja con variables de sesión
    if ($_SESSION['user']) 
    {
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/misservicios.css">
    <title>Trabajador</title>
</head>
<body>
    <header class="contenedor-flex-header">
        <img src="../imagenes/logo redondo.png" class="flex-item-logo"> 

        <div class="contenedor-subsecciones">
            <button class="btn-ms" type="button">Mis Servicios</button>
            <button class="btn-po" type="button">Publicar Oferta</button>
            <button class="btn-sol" type="button">Solicitudes</button>
        </div>

        <div class="contenedor-saludo">
            <p>Hola <?php echo $_SESSION['user'];?> </p>
        </div>

        <div class="contenedor-opciones">
            <button type="button"><img src="../iconos/btn_opciones.png"></button>
        </div>
        
    </header>

    <?php
        include('mostrarmisservicios.php');
    ?>

    <footer>
        <p><a href="./../cerrarsesion.php">Cerrar sesión</a></p>
    </footer>
    
</body>
</html>
<?php
    }
    else
    {
        echo "<script text='text/javascript'>
            alert('Usted no esta logueado');
            window.location='login.php';
            </script>";
    }
?>