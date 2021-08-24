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
    <title>Trabajador</title>
</head>
<body>
    <header>
        <div class="contenedor-subsecciones">
            <ul>
                <img src="../imagenes/logo redondo.png" >
                <li><a href="misservicios.php">Mis Servicios</a></li>
                <li><a href="publicarservicio.php">Publicar Oferta</a></li>
                <li><a href="">Solicitudes</a></li>
            </ul>
        </div>

        <div class="contenedor-opciones">
            <ul>
                <li>Hola Trabajador <?php echo $_SESSION['user']; ?></li>
                <li><a href="">Opciones</a></li>
            </ul>
        </div>
        
    </header>
    <?php
        //include('mostrarmisservicios.php');
    ?>
    <br>
    <hr>
    <p><a href="./../cerrarsesion.php">Cerrar sesión</a></p>
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