<?php
    session_start(); //siempre debe ir cuando se trabaja con variables de sesión
    
    require_once('./../database.php');

    $nombreTabla = $_POST['nomtablas'];
    $operacion = $_POST['op'];

    if ($nombreTabla == 'comuna' or $nombreTabla == 'nota' or $nombreTabla == 'region' or $nombreTabla == 'sexo') {
        $prefijo = substr($nombreTabla, 0, 3);
    }
    else
    {
        $prefijo = substr($nombreTabla, 0, 4);
    }

    $prefijoId = $prefijo."_id";
    $prefijoNombre = $prefijo."_nombre";

    //echo $prefijo;
    //echo $prefijo.$id;
    //echo $prefijo."_id";
    // echo "_id";
    //$sql = "INSERT INTO $nombreTabla ($prefijoId, $prefijoNombre) VALUES ()";
    //echo $sql;

    function ponNombre($conexion)
    {
        $rut = $_SESSION['user'];
        $sql = "SELECT usu_nombre FROM usuario WHERE usu_rut = '$rut'";
        $query = mysqli_query($conexion, $sql);
        $valor = mysqli_fetch_array($query);
        $row = $valor[0];
        echo $row;
    }

    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/nuevoregistro.css">
    <title>Administrador</title>
</head>
<body>
    <header class="contenedor-flex-header">
        <img class="flex-item-logo" src="../imagenes/logo redondo.png" >

        <div class="contenedor-subsecciones">
            <button class="btn-mtablasbasicas">Mantener tablas básicas</button>
            <button class="btn-mcuentasusuario">Mantener cuentas de usuario</button>
            <button class="btn-reportes">Reportes</button>
        </div>


        <div class="contenedor-saludo">
            <p>Hola <?php echo ponNombre($conexion); ?> </p>
        </div>

        <div class="contenedor-opciones">
            <button type="button"><img src="../iconos/btn_opciones.png"></button>
        </div>

        
    </header>

    <?php
        if($operacion == 'I')
        {
            ?>
            <div class="contenedor-insertar">
                <form class="form" action="insertar.php" method="post">
                    <input type="hidden" name="<?php echo $prefijoId ?>" value="<?php echo $prefijoId ?>">
                    <input type="hidden" name="<?php echo $prefijoNombre ?>" value="<?php echo $prefijoNombre ?>">
                    <input type="hidden" name="<?php echo $nombreTabla ?>" value="<?php echo $nombreTabla ?>">

                    <p>Nuevo registro</p>
                    <div class="contenedor-id">
                        <input type="text" name="ident" placeholder="Identificador">
                    </div>
                    <div class="contenedor-nombre">
                        <input type="text" name="name" placeholder="Nombre">
                    </div>
                    <div class="contenedor-boton">
                        <button class="btn-insert">Insertar</button>
                    </div>
                </form>
            </div>
            
            <?php
        }
        elseif ($operacion == 'U') {
            $sql = "SELECT $prefijoId, $prefijoNombre FROM $nombreTabla";
            //echo $consulta;
            $query = mysqli_query($conexion, $sql);

            while($valores = mysqli_fetch_array($query))
            {
                ?>
                <form class="form" action="actualizar.php" method="post">
                    <div class="contenedor-datos">
                        <label ><?php echo $valores[0] ?></label>
                        <input type="hidden" name="<?php echo $prefijoId ?>" value="<?php echo $prefijoId ?>">
                        <label ><?php echo $valores[1] ?></label>
                        <input type="hidden" name="<?php echo $prefijoNombre ?>" value="<?php echo $prefijoNombre ?>">
                        <label ><?php echo $nombreTabla ?></label>
                        <input type="hidden" name="<?php echo $nombreTabla ?>" value="<?php echo $nombreTabla ?>">
                        <input type="hidden" name="<?php echo $valores[0] ?>" value="<?php echo $valores[0] ?>">
                    </div>
                    <div class="contenedor-id">
                        <input type="text" name="ident" placeholder="Nuevo identificador">
                    </div>
                    <div class="contenedor-nombre">
                        <input type="text" name="name" placeholder="Nuevo nombre">
                    </div>
                    <div class="contenedor-boton">
                        <button class="btn-edit">Actualizar</button>
                    </div>
                </form>
                <?php
            }
        }
    ?>
        
    

    <script>
        function changeFunction(selectValue)
        {
            var x = selectValue.value;
            document.getElementById("showValue").value = x;
        }
    </script>

    <footer>
        <p><a href="../cerrarsesion.php">Cerrar sesión</a></p>
    </footer>

</body>
</html>