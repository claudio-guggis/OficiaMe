<?php

    require_once('./../database.php');

    $rutTrabajador = $_SESSION['user'];

    $sql2 = "SELECT COUNT(sol_id) as cantidad
    FROM solicitud, servicio, usuario, region, comuna
    WHERE usu_comuna = com_id
    AND com_region = reg_id
    AND sol_servicio = ser_id
    AND sol_usu_rut = usu_rut
    AND ser_usu_rut = '$rutTrabajador'
    AND sol_estado = 'E' ORDER BY sol_fecha_ing DESC";

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

    $sql = "SELECT sol_id, ser_titulo, usu_nombre, usu_paterno, usu_materno, reg_nombre, com_nombre, sol_fecha_ing
    FROM solicitud, servicio, usuario, region, comuna
    WHERE usu_comuna = com_id
    AND com_region = reg_id
    AND sol_servicio = ser_id
    AND sol_usu_rut = usu_rut
    AND ser_usu_rut = '$rutTrabajador'
    AND sol_estado = 'E' ORDER BY sol_fecha_ing DESC LIMIT $inicio, 4";

    $query = mysqli_query($conexion, $sql);

    if($query)
    {
        $impreso = 0;
        while($valores = mysqli_fetch_array($query))
        {
            $impreso++;
            $idSolicitud = $valores['sol_id'];
            $tituloServicio = $valores['ser_titulo'];
            $nombreSolicitante = $valores['usu_nombre'];
            $apPaternoSolicitante = $valores['usu_paterno'];
            $apMaternoSolicitante = $valores['usu_materno'];
            $nombreRegion = $valores['reg_nombre'];
            $nombreComuna = $valores['com_nombre'];
            $fechaEmision = $valores['sol_fecha_ing'];

            ?>
            <div  class="contenedorprincipal">

                <div class="contenedorformulario">
                    
                    <div class="contsol1">
                        <div class="label-t1">
                            <label for=""><?php echo $tituloServicio ?></label>
                        </div>

                        <div class="label-d1">
                            <label for=""><?php echo $nombreSolicitante ?> <?php echo $apPaternoSolicitante ?> <?php echo $apMaternoSolicitante ?></label>
                        </div>

                        <div class="label-fe1">
                            <label for="">Emitida el: <?php echo $fechaEmision ?> </label>
                        </div>

                        <div class="label-or1">
                            <label for=""><?php echo $nombreRegion ?>, <?php echo $nombreComuna ?></label>
                        </div>
                        
                        <form action="responder.php" method="post">
                            <button class="btn-a1" name="response-accepted">Aceptar</button>
                            <button class="btn-r1" name="response-rejected">Rechazar</button>
                        </form>
                    </div>

                        <?php
                            // $impreso++;
                            // $valores = mysqli_fetch_array($query);
                            // $idSolicitud = $valores['sol_id'];
                            // $tituloServicio = $valores['ser_titulo'];
                            // $nombreSolicitante = $valores['usu_nombre'];
                            // $apPaternoSolicitante = $valores['usu_paterno'];
                            // $apMaternoSolicitante = $valores['usu_materno'];
                            // $nombreRegion = $valores['reg_nombre'];
                            // $nombreComuna = $valores['com_nombre'];
                            // $fechaEmision = $valores['sol_fecha_ing'];
                        ?>   
 
                    <!-- <div class="es">
                        
                    </div>

                    <div class="contsol2">
                        <div class="label-t2">
                            <label for=""><?php //echo $tituloServicio ?></label>
                        </div>

                        <div class="label-d2">
                            <label for=""><?php //echo $nombreSolicitante ?> <?php //echo $apPaternoSolicitante ?> <?php //echo $apMaternoSolicitante ?></label>
                        </div>

                        <div class="label-fe2">
                            <label for="">Emitida el: <?php //echo $fechaEmision ?> </label>
                        </div>

                        <div class="label-or2">
                            <label for=""><?php //echo $nombreRegion ?>, <?php //echo $nombreComuna ?></label>
                        </div>
                        
                        <form action="responder.php" method="post">
                            <button class="btn-a2" name="response-accepted">Aceptar</button>
                            <button class="btn-r2" name="response-rejected">Rechazar</button>
                        </form>
                    </div> -->
            
                </div>

            </div>
            <!-- <div class="info-mis-servicios">
                <p>
                    <b>Titulo Servicio: </b> <?php //echo $tituloServicio ?> <br>
                    <b>Nombre Solicitante: </b> <?php //echo $nombreSolicitante ?> <br>
                    <b>Apellido Paterno: </b> <?php //echo $apPaternoSolicitante ?> <br>
                    <b>Apellido Materno: </b> <?php //echo $apMaternoSolicitante ?> <br>
                    <b>Region: </b> <?php //echo $nombreRegion ?> <br>
                    <b>Comuna: </b> <?php //echo $nombreComuna ?> <br>
                    <b>Fecha: </b> <?php //echo $fechaEmision ?> <br> -->

                    <!-- FORMULARIO PARA ENVIAR RESPUESTA -->
                    <!-- <form action="responder.php" method="post">
                        <input type="hidden" name="<?php //echo $idSolicitud; ?>" value="<?php //echo $idSolicitud; ?>">
                        <button class="btn-aceptar" name="response-accepted"><b>Aceptar</b></button>
                        <button class="btn-rechazar" name="response-rejected"><b>Rechazar</b></button>
                    </form> -->
                    
                <!-- </p>
            </div> -->
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
                if($inicio == 4)
                {
                    ?>
                    <div class="col-lg-3">
                        <a href="solicitudessolmisservicios.php">Anterior</a>
                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <div class="col-lg-3">
                        <a href="solicitudessolmisservicios.php?page=<?php echo $inicio-4 ?>">Anterior</a>
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
                    <a href="solicitudessolmisservicios.php?page=<?php echo $inicio+4 ?>">Siguiente</a>
                    <?php
                }
                else
                {
                    if($impreso == 4)
                    {
                        ?>
                        <a href="solicitudessolmisservicios.php?page=<?php echo $inicio+4 ?>">Siguiente</a>
                        <?php
                    }

                }
            ?>
        </div>
    </div>