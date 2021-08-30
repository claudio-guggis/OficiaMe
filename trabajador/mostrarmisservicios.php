<?php
    //session_start();
    require_once("./../database.php");

    /**
     * Mostrar los servicios publicados por el usuario
     */
    $rut = $_SESSION['user'];

    $sql = "SELECT ser_id, ser_titulo, usu_nombre, usu_paterno, reg_nombre, com_nombre, ser_valor, ser_descripcion, ser_fechapub FROM servicio, usuario, region, comuna WHERE com_region = reg_id AND usu_rut = ser_usu_rut AND com_id = usu_comuna AND usu_rut = $rut ORDER BY ser_fechapub DESC";
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
                
            
            <div class="contenedor-principal-misservicios">
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
                                        <button class="btn-solicitame" name="request"><b>Editar</b></button>
                                        <!-- <button type="button" class="btn-solicitame" name="request"><b>SolicitaMe</b></button> -->
                                </form>
                                
                            </div>
                        </div>
                        <div class="linea-derecha"></div>
                    </div>
                    
                </div>
            </div>
            <?php
        }
    }
?>