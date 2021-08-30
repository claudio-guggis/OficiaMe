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

    <?php
        if($operacion == 'I')
        {
            ?>
            <form action="insertar.php" method="post">
                <input type="hidden" name="<?php echo $prefijoId ?>" value="<?php echo $prefijoId ?>">
                <input type="hidden" name="<?php echo $prefijoNombre ?>" value="<?php echo $prefijoNombre ?>">
                <input type="hidden" name="<?php echo $nombreTabla ?>" value="<?php echo $nombreTabla ?>">
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
            <?php
        }
        elseif ($operacion == 'U') {
            $sql = "SELECT $prefijoId, $prefijoNombre FROM $nombreTabla";
            //echo $consulta;
            $query = mysqli_query($conexion, $sql);

            while($valores = mysqli_fetch_array($query))
            {
                ?>
                <form action="actualizar.php" method="post">
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
                        <button class="btn-edit">Editar</button>
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

    

    <br>
    <hr>
    <p><a href="cerrarsesion.php">Cerrar sesión</a></p>
</body>
</html>