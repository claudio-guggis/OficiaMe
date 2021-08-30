<?php
    require_once("./../database.php");
    session_start(); //siempre debe ir cuando se trabaja con variables de sesión

    function llenarNomTablas($conexion)
    {
        $sql = "SHOW TABLES FROM prueba_ofme WHERE Tables_in_prueba_ofme = 'comuna' OR Tables_in_prueba_ofme = 'eservicio' OR Tables_in_prueba_ofme = 'esolicitud' OR Tables_in_prueba_ofme = 'eusuario' OR Tables_in_prueba_ofme = 'nota' OR Tables_in_prueba_ofme = 'region' OR Tables_in_prueba_ofme = 'sexo' OR Tables_in_prueba_ofme = 'tcertificacion' OR Tables_in_prueba_ofme = 'tservicio' OR Tables_in_prueba_ofme = 'tusuario'";

        $query = mysqli_query($conexion, $sql);

        while($valores = mysqli_fetch_array($query))
        {
            echo '<option value="'.$valores['Tables_in_prueba_ofme'].'" selected >'.$valores['Tables_in_prueba_ofme'].'</option>';
        }
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
    <title>Administrador</title>
</head>
<body>
    <header>
        <div class="contenedor-subsecciones">
            <ul>
                <img src="../imagenes/logo redondo.png" >
                <li><a href="mantenertb.php">Mantener tablas básicas</a></li>
                <li><a href="">Mantener cuentas de usuario</a></li>
                <li><a href="">Reportes</a></li>
            </ul>
        </div>

        <div class="contenedor-opciones">
            <ul>
                <li>Administrador <?php echo $_SESSION['user']; ?></li>
                <li><a href="">Opciones</a></li>
            </ul>
        </div>
        
    </header> 


    <h1>Mantenedor de tablas básicas</h1>

    <div class = "contenedor-principal">

        <form class="form" action="mantenciontb.php" method="post">
            <div class="contenedor-label">
                <label class="label-nomtabla">Mantención de tablas</label>
            </div>

            <div class="contenedor-nombre-tablas">
                <select class="selector-tb" name="nomtablas" onchange="changeFunction(this)" >
                    <!-- <option value="region" selected>Region</option>
                    <option value="comuna">Comuna</option>
                    <option value="sexo">Sexo</option>
                    <option value="tusuario">Tusuario</option>
                    <option value="eusuario">Eusuario</option>
                    <option value="tcertificacion">Tcertificacion</option>
                    <option value="nota">Nota</option>
                    <option value="esolicitud">Esolicitud</option>
                    <option value="tservicio">Tservicio</option>
                    <option value="eservicio">Eservicio</option> -->
                    <?php
                    echo llenarNomTablas($conexion);
                    ?>
                </select>
            </div>

            <div class="contenedor-test">
                <label for="">Tabla seleccionada:</label>
                <input type="text" name="selectInput" id="showValue" value="">
            </div>

            <div class="contenedor-label">
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

            <button class="btn-seleccion">Confirmar</button>
        </form>
        
    </div>

    <script>
        function changeFunction(selectValue)
        {
            var x = selectValue.value;
            document.getElementById("showValue").value = x;
        }
    </script>

    

    <br>
    <hr>
    <p><a href="../cerrarsesion.php">Cerrar sesión</a></p>
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