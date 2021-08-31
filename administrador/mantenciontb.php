<?php
    // error_reporting (E_ALL ^ E_NOTICE);
    session_start(); //siempre debe ir cuando se trabaja con variables de sesión
    
    require_once('./../database.php');

    $nombreTabla = $_GET['nomtablas'];
    $operacion = $_GET['op'];

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
            <nav class="main_nav">
            
                <button class="icon_menu" id ="btn_menu"><img  src="../iconos/btn_opciones.png"></button>
                
                <ul class="menu" id ="menu">
                    <li class ="menu_item"><a href="" class="menu_link menu_link_select">Tablas básicas</a></li>
                    <li class ="menu_item"><a href="" class="menu_link">Preferencias</a></li>
                    <li class ="menu_item"><a href="" class="menu_link">Ajustes</a></li>
                    <li class ="menu_item"><a href="./../cerrarsesion.php" class="menu_link">Cerrar sesión</a></li>
                </ul>
            </nav>
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
            $sql2 = "SELECT COUNT($prefijoId) as cantidad
            FROM $nombreTabla";

            $res = mysqli_query($conexion, $sql2);

            if($registros = mysqli_fetch_array($res))
            {
                $cantidad = $registros["cantidad"];
            }

            if (isset($_GET["page"])) {
                $inicio = $_GET["page"];
            }
            else
            {
                $inicio = 0;
            }
            $sql = "SELECT $prefijoId, $prefijoNombre FROM $nombreTabla LIMIT $inicio, 3";
            //echo $consulta;
            $query = mysqli_query($conexion, $sql);

            $impreso=0;
            while($valores = mysqli_fetch_array($query))
            {
                $impreso++;
                ?>
                <div class="contenedor-insertar">
                    <form class="form" action="actualizar.php" method="post">
                        <!-- <div class="contenedor-datos">
                            <label ><?php echo $valores[0] ?></label>
                            <input type="hidden" name="<?php echo $prefijoId ?>" value="<?php echo $prefijoId ?>">
                            <label ><?php echo $valores[1] ?></label>
                            <input type="hidden" name="<?php echo $prefijoNombre ?>" value="<?php echo $prefijoNombre ?>">
                            <label ><?php echo $nombreTabla ?></label>
                            <input type="hidden" name="<?php echo $nombreTabla ?>" value="<?php echo $nombreTabla ?>">
                            <input type="hidden" name="<?php echo $valores[0] ?>" value="<?php echo $valores[0] ?>">
                        </div> -->
                        <p>
                        <label ><?php echo $valores[0] ?></label>
                            <input type="hidden" name="<?php echo $prefijoId ?>" value="<?php echo $prefijoId ?>">
                            <label ><?php echo $valores[1] ?></label>
                            <input type="hidden" name="<?php echo $prefijoNombre ?>" value="<?php echo $prefijoNombre ?>">
                            <label ><?php echo $nombreTabla ?></label>
                            <input type="hidden" name="<?php echo $nombreTabla ?>" value="<?php echo $nombreTabla ?>">
                            <input type="hidden" name="<?php echo $valores[0] ?>" value="<?php echo $valores[0] ?>">
                        </p>
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
                </div>
                <?php
            }
            ?>
            <div class="row">
            <?php
                if($inicio == 0)
                {
                    ?>
                    <div class="col-lg-3">Anterior</div>
                    <?php
                }
                else
                {
                    if($inicio == 3)
                    {
                        ?>
                        <div class="col-lg-3">
                            <a href="mantenciontb.php?nomtablas=<?php echo $nombreTabla ?>&op=<?php echo $operacion ?>&nombre=">Anterior</a>
                        </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <div class="col-lg-3">
                            <a href="mantenciontb.php?nomtablas=<?php echo $nombreTabla ?>&op=<?php echo $operacion ?>&page=<?php echo $inicio-3 ?>">Anterior</a>
                        </div>
                        <?php
                    }
                }
            ?>
            <div class="col-lg-3">
                <?php
                    if($inicio == 0)
                    {
                        ?>
                        <a href="mantenciontb.php?nomtablas=<?php echo $nombreTabla ?>&op=<?php echo $operacion ?>&page=<?php echo $inicio+3 ?>">Siguiente</a>
                        <?php
                    }
                    else
                    {
                        if($impreso == 3)
                        {
                            ?>
                            <a href="mantenciontb.php?nomtablas=<?php echo $nombreTabla ?>&op=<?php echo $operacion ?>&page=<?php echo $inicio+3 ?>">Siguiente</a>
                            <?php
                        }

                    }
                ?>
            </div>
        </div>
                <?php
            }
        ?>
        
    

    <footer>
        
    </footer>

    <script>
        function changeFunction(selectValue)
        {
            var x = selectValue.value;
            document.getElementById("showValue").value = x;
        }
    </script>

    <script src="../assets/menu.js"></script>

</body>
</html>