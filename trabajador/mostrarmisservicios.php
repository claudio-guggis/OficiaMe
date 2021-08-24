<?php
    require_once('database.php');

    $sql = "SELECT ser_titulo, usu_nombre, usu_paterno, reg_nombre, com_nombre, ser_valor, ser_descripcion, ser_fechapub FROM servicio, usuario, region, comuna WHERE com_region = reg_id AND usu_rut = ser_usu_rut AND com_id = usu_comuna";
    $query = mysqli_query($conexion, $sql);

    if($query)
    {
        while($valores = mysqli_fetch_array($valores))
        {
            $tituloServicio = $valores['ser_titulo'];
            $nombreTrabajador = $valores['ser_titulo'];
            $apPaternoTrabajador = $valores['ser_titulo'];
            $nombreRegion = $valores['ser_titulo'];
            $nombreComuna = $valores['ser_titulo'];
            $valorServicio = $valores['ser_titulo'];
            $descServicio = $valores['ser_titulo'];
            $fechaPublicacion = $valores['ser_titulo'];
            ?>
                <div>
                    <h2></h2>
                    <div>
                        <p>
                            <b>Titulo Servicio: </b> <?php echo $tituloServicio ?> <br>
                            <b>Nombre Trabajador: </b> <?php echo $nombreTrabajador ?> <br>
                            <b>Apellido: </b> <?php echo $apPaternoTrabajador ?> <br>
                            <b>Region: </b> <?php echo $nombreRegion ?> <br>
                            <b>Comuna: </b> <?php echo $nombreComuna ?> <br>
                            <b>Valor: </b> <?php echo $valorServicio ?> <br>
                            <b>Descripcion: </b> <?php echo $descServicio ?> <br>
                            <b>Fecha: </b> <?php echo $fechaPublicacion ?> <br>
                        </p>
                    </div>
                </div>
            <?php
        }
    }
?>