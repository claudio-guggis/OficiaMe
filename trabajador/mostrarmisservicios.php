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
                <div class="info-mis-servicios">
                    <p>
                        <b>Titulo Servicio: </b> <?php echo $tituloServicio ?> <br>
                        <b>Nombre Trabajador: </b> <?php echo $nombreTrabajador ?> <br>
                        <b>Apellido: </b> <?php echo $apPaternoTrabajador ?> <br>
                        <b>Region: </b> <?php echo $nombreRegion ?> <br>
                        <b>Comuna: </b> <?php echo $nombreComuna ?> <br>
                        <b>Valor: </b> <?php echo $valorServicio ?> <br>
                        <b>Descripcion: </b> <?php echo $descServicio ?> <br>
                        <b>Fecha: </b> <?php echo $fechaPublicacion ?> <br>
                        <button class="btn-editar" name=<?php "$idServicio" ?>>Editar</button>
                    </p>
                </div>
            <?php
        }
    }
?>