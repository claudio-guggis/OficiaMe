<?php
    session_start(); //siempre debe ir cuando se trabaja con variables de sesión

    require('./../database.php');

    $bpersonalizada = $_GET['busq-pers'];
    $certificacion = $_GET['cert'];
    $region = $_GET['regs'];
    $comuna = $_GET['com'];
    $rutCliente = $_SESSION['user'];

    // if($region == '0')
    // {
    //     $region = "reg_id";
    // }
    // else
    // {
    //     $region = "'".$region."'";
    // }

    if($comuna == '0')
    {
        $comuna = "com_id";
    }
    // else
    // {
    //     $comuna = $comuna;
    // }

    if($certificacion == 'S')
    {
        $sql2 = "SELECT COUNT(ser_id) as cantidad
            FROM servicio, usuario, region, comuna
            WHERE com_region = reg_id
            AND usu_rut = ser_usu_rut
            AND com_id = usu_comuna
            AND ser_usu_rut IN (SELECT cer_usu_rut FROM certificacion)
            AND (usu_nombre LIKE '%$bpersonalizada%' OR ser_titulo LIKE '%$bpersonalizada%' OR ser_descripcion LIKE '%$bpersonalizada%')
            AND reg_id = '$region'
            AND com_id = $comuna
            AND  NOT EXISTS (SELECT sol_servicio, sol_usu_rut
                            FROM solicitud
                            WHERE ser_id = sol_servicio
                            AND sol_usu_rut = '$rutCliente') ORDER BY ser_fechapub DESC";

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

        $sql = "SELECT ser_id, ser_titulo, usu_nombre, usu_paterno, reg_nombre, com_nombre, ser_valor, ser_descripcion, ser_fechapub
            FROM servicio, usuario, region, comuna
            WHERE com_region = reg_id
            AND usu_rut = ser_usu_rut
            AND com_id = usu_comuna
            AND ser_usu_rut IN (SELECT cer_usu_rut FROM certificacion)
            AND (usu_nombre LIKE '%$bpersonalizada%' OR ser_titulo LIKE '%$bpersonalizada%' OR ser_descripcion LIKE '%$bpersonalizada%')
            AND reg_id = '$region'
            AND com_id = $comuna
            AND  NOT EXISTS (SELECT sol_servicio, sol_usu_rut
                            FROM solicitud
                            WHERE ser_id = sol_servicio
                            AND sol_usu_rut = '$rutCliente') ORDER BY ser_fechapub DESC
                            LIMIT $inicio, 3";
    }
    else
    {
        $sql2 = "SELECT COUNT(ser_id) as cantidad
            FROM servicio, usuario, region, comuna
            WHERE com_region = reg_id
            AND usu_rut = ser_usu_rut
            AND com_id = usu_comuna
            AND ser_usu_rut NOT IN (SELECT cer_usu_rut FROM certificacion)
            AND (usu_nombre LIKE '%$bpersonalizada%' OR ser_titulo LIKE '%$bpersonalizada%' OR ser_descripcion LIKE '%$bpersonalizada%')
            AND reg_id = '$region'
            AND com_id = $comuna
            AND  NOT EXISTS (SELECT sol_servicio, sol_usu_rut
                            FROM solicitud
                            WHERE ser_id = sol_servicio
                            AND sol_usu_rut = '$rutCliente') ORDER BY ser_fechapub DESC";

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

        $sql = "SELECT ser_id, ser_titulo, usu_nombre, usu_paterno, reg_nombre, com_nombre, ser_valor, ser_descripcion, ser_fechapub
            FROM servicio, usuario, region, comuna
            WHERE com_region = reg_id
            AND usu_rut = ser_usu_rut
            AND com_id = usu_comuna
            AND ser_usu_rut NOT IN (SELECT cer_usu_rut FROM certificacion)
            AND (usu_nombre LIKE '%$bpersonalizada%' OR ser_titulo LIKE '%$bpersonalizada%' OR ser_descripcion LIKE '%$bpersonalizada%')
            AND reg_id = '$region'
            AND com_id = $comuna
            AND  NOT EXISTS (SELECT sol_servicio, sol_usu_rut
                            FROM solicitud
                            WHERE ser_id = sol_servicio
                            AND sol_usu_rut = '$rutCliente') ORDER BY ser_fechapub DESC
                            LIMIT $inicio, 3";
    }
    

        // echo $sql;
        // exit();

        $query = mysqli_query($conexion, $sql);

    /**
     * FUNCIONES
     */

    function llenarRegiones($conexion)
    {
        //$output = '';
        $sql = "SELECT reg_id, reg_nombre FROM region";
        $query = mysqli_query($conexion, $sql);
        while($valores = mysqli_fetch_array($query))
        {
            echo '<option value="'.$valores['reg_id'].'">'.$valores['reg_nombre'].'</option>';
        }
        // echo '<option value="0" selected >Seleccione...</option>';
        //return $output;
    }

    function llenarComunas($conexion)
    {
        //$output = '';
        $sql = "SELECT com_id, com_nombre FROM comuna";
        $query = mysqli_query($conexion, $sql);
        while($valores = mysqli_fetch_array($query))
        {
            echo '<option value="'.$valores['com_id'].'" >'.$valores['com_nombre'].'</option>';
        }
        echo '<option value="0" selected >Seleccione...</option>';
        //return $output;
    }

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/cliente.css">
    <title>Busqueda</title>
</head>
<body>
<header class="contenedor-flex-header">
        <img src="../imagenes/logo redondo.png" class="flex-item-img">

        <div class="contenedor-busqueda-trabajadores">
            <div class="contenedor-busqueda-trabajadores-segundo">
                
                <form action="busqueda.php" method="GET">
                    

                    <div class="contenedor-busqueda">
                        <input type="text" class="form-busq" name="busq-pers" placeholder ="Búsqueda personalizada...">
                    </div>

                    <div class="contenedor-botonbuscar">
                        <button class="boton-buscar">BúscaMe</button>
                    </div>
                    
                    <div class="contenedor-filtros">

                        <div class="filtro">
                            <select class="filtro-cert" name="cert">
                                <option value="N" selected>No certificado</option>
                                <option value="S">Certificado</option>
                            </select>
                        </div>

                        <div class="filtro">
                            <select class="filtro-region" id="regs" name="regs">
                                <?php
                                    echo llenarRegiones($conexion);
                                ?>
                            </select>
                        </div>

                        <div class="filtro">
                            <select class="filtro-comuna" id="show_comuna" name="com">
                                <?php
                                    echo llenarComunas($conexion);
                                ?>
                            </select>
                        </div>

                    </div>

                </form>
            </div>
        </div>

        <div class="contenedor-saludo">
            <p>Hola <?php echo ponNombre($conexion);?> </p>
        </div>

        <div class="contenedor-opciones">
            <nav class="main_nav">
            
                <button class="icon_menu" id ="btn_menu"><img  src="../iconos/btn_opciones.png"></button>
                
                <ul class="menu" id ="menu">
                    <li class ="menu_item"><a href="" class="menu_link menu_link_select">Búsqueda</a></li>
                    <li class ="menu_item"><a href="" class="menu_link">Preferencias</a></li>
                    <li class ="menu_item"><a href="" class="menu_link">Ajustes</a></li>
                    <li class ="menu_item"><a href="./../cerrarsesion.php" class="menu_link">Cerrar sesión</a></li>
                </ul>
            </nav>
        </div>
        
    </header>

    

    <?php

        if($query)
        {
            $impreso = 0;
            while($valores = mysqli_fetch_array($query))
            {
                $impreso++;
                $idServicio = $valores['ser_id'];
                $tituloServicio = $valores['ser_titulo'];
                $nombreTrabajador = $valores['usu_nombre'];
                $apPaternoTrabajador = $valores['usu_paterno'];
                $nombreRegion = $valores['reg_nombre'];
                $nombreComuna = $valores['com_nombre'];

                if($valores['ser_valor'] == '')
                {
                    $valorServicio = 'Sin especificar';
                }
                else
                {
                    $valorServicio = $valores['ser_valor'];
                }

                $descServicio = $valores['ser_descripcion'];
                $fechaPublicacion = $valores['ser_fechapub'];

        ?>
                <div class="contenedor-principal-servicios">
                    <!-- <div class="contenedor-btn-izquierdo">
                        <div>
                            <button type="button"><img src="https://image.flaticon.com/icons/png/512/20/20924.png"></button>
                        </div>
                    </div> -->

                    <div class="contenedor-tarjeta">
                        
                        <div class="contenedor-informacion-tarjeta">
                            <div class="linea-izquierda"></div>
                            <div class="contenido-tarjeta">
                                <div class="info-general">
                                    <p class="titulo"><b><?php echo $tituloServicio ?></b></p>
                                    <p class="valor">Valor: <?php echo $valorServicio ?></p>
                                    <p class="trabajador"><?php echo $nombreTrabajador?> <?php $apPaternoTrabajador?></p>
                                    <p class="ubicacion"><?php echo $nombreRegion ?>, <?php echo $nombreComuna ?></p>
                                    <div class="valoracion">Valoración: 
                                        <div class="contenedor-estrellas">
                                            <div>
                                                <img src="../iconos/estrella.png">
                                            </div>
                                            <div>
                                                <img src="../iconos/estrella.png">
                                            </div>
                                            <div>
                                                <img src="../iconos/estrella.png">
                                            </div>
                                            <div>
                                                <img src="../iconos/estrella.png">
                                            </div>
                                            <div>
                                                <img src="../iconos/estrella2.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="contenedor-descripcion">
                                    <p class="descripcion">Descripción</p><br>
                                    <!-- <textarea class="tadescripcion" name="areaDescripcion" cols="30" rows="10">  </textarea> -->
                                    <div class="tadescripcion">
                                        <?php echo $descServicio ?>
                                    </div>
                                </div>
                                <div class="contenedor-fecha-boton">
                                    <p class="fechapub"><?php echo $fechaPublicacion ?></p>
                                    <form action="solicitar.php" method="post">
                                        <input type="hidden" name="<?php echo $idServicio; ?>" value="<?php echo $idServicio; ?>">
                                            <button class="btn-solicitame" name="request"><b>SolicitaMe</b></button>
                                            <!-- <button type="button" class="btn-solicitame" name="request"><b>SolicitaMe</b></button> -->
                                    </form>
                                    
                                </div>
                            </div>
                            <div class="linea-derecha"></div>
                        </div>
                        
                    </div>
                    <!-- <div class="contenedor-btn-derecho">
                        <div>
                            <button type="button"><img src="https://image.flaticon.com/icons/png/512/20/20999.png"></button>
                        </div>
                    </div>  -->
                </div>
        <?php
            }
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
                        <a href="busqueda.php?busq-pers=<?php echo $bpersonalizada ?>&cert=<?php echo $certificacion ?>&regs=<?php echo $region ?>&com=<?php echo $comuna ?>">Anterior</a>
                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <div class="col-lg-3">
                        <a href="busqueda.php?busq-pers=<?php echo $bpersonalizada ?>&cert=<?php echo $certificacion ?>&regs=<?php echo $region ?>&com=<?php echo $comuna ?>&page=<?php echo $inicio-3 ?>">Anterior</a>
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
                    <a href="busqueda.php?busq-pers=<?php echo $bpersonalizada ?>&cert=<?php echo $certificacion ?>&regs=<?php echo $region ?>&com=<?php echo $comuna ?>&page=<?php echo $inicio+3 ?>">Siguiente</a>
                    <?php
                }
                else
                {
                    if($impreso == 3)
                    {
                        ?>
                        <a href="busqueda.php?busq-pers=<?php echo $bpersonalizada ?>&cert=<?php echo $certificacion ?>&regs=<?php echo $region ?>&com=<?php echo $comuna ?>&page=<?php echo $inicio+3 ?>">Siguiente</a>
                        <?php
                    }

                }
            ?>
        </div>
    </div>
    
    <footer>
        
    </footer>
    <script src="../assets/menu.js"></script>
</body>

</html>

<script>
    $(document).ready(function(){
        $('#regs').change(function(){
            var reg_id = $(this).val();

            $.ajax({
                url:"../load_data.php",
                method:"POST",
                data:{reg_id:reg_id},
                success:function(data){
                    $('#show_comuna').html(data);
                }
            });

        });
    });
</script>
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