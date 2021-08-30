<?php
    //session_start();
    require_once('./../database.php');

    //$sql = "SELECT ser_id, ser_titulo, usu_nombre, usu_paterno, reg_nombre, com_nombre, ser_valor, ser_descripcion, ser_fechapub FROM servicio, usuario, region, comuna WHERE com_region = reg_id AND usu_rut = ser_usu_rut AND com_id = usu_comuna ORDER BY ser_fechapub DESC";

    $rutCliente = $_SESSION['user'];

    /**
     * MOSTRAR SERVICIOS QUE EL CLIENTE NO HAYA SOLICITADO ANTERIORMENTE
     */

    $sql = "SELECT ser_id, ser_titulo, usu_nombre, usu_paterno, reg_nombre, com_nombre, ser_valor, ser_descripcion, ser_fechapub
    FROM servicio, usuario, region, comuna
    WHERE com_region = reg_id
    AND usu_rut = ser_usu_rut
    AND com_id = usu_comuna
    AND  NOT EXISTS (SELECT sol_servicio, sol_usu_rut
                     FROM solicitud
                     WHERE ser_id = sol_servicio
                     AND sol_usu_rut = '$rutCliente') ORDER BY ser_fechapub DESC";

    //echo $sql;

    $query = mysqli_query($conexion, $sql);

    if($query)
    {
        while($valores = mysqli_fetch_array($query))
        {
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
                <!-- <div class="info-sol">
                    <p>
                        <b>Titulo Servicio: </b>  <br>
                        <b>Nombre Trabajador: </b>  <br>
                        <b>Apellido: </b>  <br>
                        <b>Region: </b>  <br>
                        <b>Comuna: </b>  <br>
                        <b>Valor: </b>  <br>
                        <b>Descripcion: </b>  <br>
                        <b>Fecha: </b>  <br>

                        <form action="solicitar.php" method="post">
                            <input type="hidden" name="" value="">
                            <button class="btn-solicitame" name="request">SolicitaMe</button>
                        </form>
                    </p>
                </div> -->

    <div class="contenedor-principal-servicios">
        <div class="contenedor-btn-izquierdo">
            <div>
                <button type="button"><img src="https://image.flaticon.com/icons/png/512/20/20924.png"></button>
            </div>
        </div>

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

        <div class="contenedor-btn-derecho">
            <div>
                <button type="button"><img src="https://image.flaticon.com/icons/png/512/20/20999.png"></button>
            </div>
        </div>
    </div>
            <?php
        }
    }
?>