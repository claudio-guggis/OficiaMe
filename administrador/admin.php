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
    <link rel="stylesheet" type="text/css" href="../assets/mantenertb.css">
    <title>Administrador</title>
</head>
<body>
    <header class="contenedor-flex-header">
        <img src="../imagenes/logo redondo.png" class="flex-item-logo"> 

        <div class="contenedor-subsecciones">
            <button class="btn-mtablasbasicas">Mantener tablas básicas</button>
            <button class="btn-mcuentasusuario">Mantener cuentas de usuario</button>
            <button class="btn-reportes">Reportes</button>
        </div>

        <div class="contenedor-saludo">
            <p>Hola <?php echo $_SESSION['user'];?> </p>
        </div>

        <div class="contenedor-opciones">
            <button type="button"><img src="../iconos/btn_opciones.png"></button>
        </div>
        
    </header>

    <div class="contenedor-principal-mantenciontb">
        <form class="form" action="mantenciontb.php" method="post">
                <div class="contenedor-label-mantencion">
                    <label class="label-mentencion">Mantención de tablas</label>
                </div>

                <div class="contenedor-test">
                    <label for="">Tabla seleccionada</label>
                </div>

                <div class="contenedor-nombre-tablas">
                    <select class="selector-tb" name="nomtablas" onchange="changeFunction(this)" >
                        <option value="region" selected>Region</option>
                        <option value="comuna">Comuna</option>
                        <option value="sexo">Sexo</option>
                        <option value="tusuario">Tusuario</option>
                        <option value="eusuario">Eusuario</option>
                        <option value="tcertificacion">Tcertificacion</option>
                        <option value="nota">Nota</option>
                        <option value="esolicitud">Esolicitud</option>
                        <option value="tservicio">Tservicio</option>
                        <option value="eservicio">Eservicio</option>
                    </select>
                </div>

                <br>

                <div class="contenedor-label-operacion">
                    <label class="label-operacion">Operación tabla básica</label>
                </div>

                <div class="contenedor-nombre-tablas">
                    <select class="selector-tb" name="op" >
                        <option value="I">Insertar</option>
                        <option value="U">Actualizar</option>
                        <option value="D">Eliminar</option>
                    </select>
                </div>

                <div class="contenedor-campo-texto" name="registro">
                    <label class="label-nombre-cambiar" hidden="true">Nombre a cambiar</label>
                    <input type="text" class="form-input" name="nombre" placeholder="nombre" hidden="true">
                </div>

                <br>

                <button class="btn-seleccion">Confirmar</button>
            </form>
    </div>
    
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