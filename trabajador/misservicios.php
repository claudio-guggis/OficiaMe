<?php
    require_once('./../database.php');
    session_start(); //siempre debe ir cuando se trabaja con variables de sesión

    function ponNombre($conexion)
    {
        $rut = $_SESSION['user'];
        $sql = "SELECT usu_nombre FROM usuario WHERE usu_rut = '$rut'";
        $query = mysqli_query($conexion, $sql);
        $valor = mysqli_fetch_array($query);
        $row = $valor[0];
        echo $row;
    }

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
            <button class="btn-ms" type="button" onclick="location.href='misservicios.php'">Mis Servicios</button>
            <button class="btn-po" type="button" onclick="location.href='publicarservicio.php'" >Publicar Oferta</button>
            <button class="btn-sol" type="button" onclick="location.href='solicitudesmisservicios.php'">Solicitudes</button>
        </div>

        <div class="contenedor-saludo">
            <p>Hola <?php echo ponNombre($conexion); ?> </p>
        </div>

        <div class="contenedor-opciones">
            <nav class="main_nav">
                <button class="icon_menu" id ="btn_menu"><img  src="../iconos/btn_opciones.png"></button>
                    
                    <ul class="menu" id ="menu">
                        <li class ="menu_item"><a href="" class="menu_link menu_link_select">Mis servicios</a></li>
                        <li class ="menu_item"><a href="" class="menu_link">Preferencias</a></li>
                        <li class ="menu_item"><a href="" class="menu_link">Ajustes</a></li>
                        <li class ="menu_item"><a href="./../cerrarsesion.php" class="menu_link">Cerrar sesión</a></li>
                    </ul>
            </nav>
        </div>
        
    </header>

    <?php
        include('mostrarmisservicios.php');
    ?>

    <footer>
        <!-- <p><a href="./../cerrarsesion.php">Cerrar sesión</a></p> -->
    </footer>

    <script src="../assets/menu.js"></script>
    
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