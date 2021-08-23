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
    <title>Administrador</title>
</head>
<body>
    <header>
        <ul>
            <img src="imagenes/logo redondo.png" >
            <li>hola</li>
            <li>hola</li>
            <li>hola</li>
        </ul>
    </header>
    <h1>Bienvenido administrador</h1>
    <p>Hola <?php echo $_SESSION['user']; ?></p>
    <br>
    <hr>
    <p><a href="cerrarsesion.php">Cerrar sesión</a></p>
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