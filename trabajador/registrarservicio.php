<?php
    /**
     * Se trabaja con sesiones para poder usar el rut y el tipo de usuario y agregarlos a la tabla de servicio
     */
    session_start();

    /**
     * Se conecta con la base de datos
     */
    require_once("./../database.php");

    /**
     * Se pregunta si el botón de publicar se ha pulsado, o bien, si su valor está seteado
     */
    if(isset($_POST["serpublicar"]))
    {
        /**
         * Si las cadenas de texto ingresadas cumplen con las condiciones, según sea necesario. Por ejemplo, el valor no es necesario que esté lleno, ya que se ha definido que sea opcional.
         */
        if(strlen($_POST["sertitulo"])>=1 && strlen($_POST["sertipo"])>=1 && strlen($_POST["servalor"])>=0 && strlen($_POST["serdescripcion"])>=1)
        {
            /**
             * Se guardan los datos transferidos mediante método POST en variables php.
             */
            $tituloServicio = $_POST["sertitulo"];
            $tipoServicio = $_POST["sertipo"];
            $valorServicio = $_POST["servalor"];
            $descripcionServicio = $_POST["serdescripcion"];
            $fechaStr = date("Y-m-d");
            $rut = $_SESSION['user'];
            $tipo = $_SESSION["type"];

            /**
             * Como el valor del servicio es opcional ingresarlo, se debe preguntar si su campo quedó vacío para ingresar un null en la consulta que se guardará en la variable $sql de php
             */
            if(strlen($valorServicio) == 0)
            {
                $sql = "INSERT INTO servicio (ser_titulo, ser_descripcion, ser_valor, ser_fechapub, ser_tipo, ser_usu_rut, ser_usu_tipo, ser_estado) VALUES ('$tituloServicio', '$descripcionServicio', null, '$fechaStr', $tipoServicio, '$rut', '$tipo', 'D')";
            }
            /**
             * Si tiene valor, simplemente se pasa la variable con su valor respectivo en el atributo ser_valor (valor del servicio)
             */
            else
            {
                $sql = "INSERT INTO servicio (ser_titulo, ser_descripcion, ser_valor, ser_fechapub, ser_tipo, ser_usu_rut, ser_usu_tipo, ser_estado) VALUES ('$tituloServicio', '$descripcionServicio', $valorServicio, '$fechaStr', $tipoServicio, '$rut', '$tipo', 'D')";
            }

            // print_r($rut);
            // print_r($tipo);
            // print_r($fechaStr);
            // print_r($fechaPublicacion);

            //echo $sql;

            /**
             * Se ejecuta la consulta y los datos obtenidos se guardan en la variable php
             */
            $resultado = mysqli_query($conexion, $sql);

            /**
             * Si la variable php contiene datos correctos, se han insertado correctamente los datos en la tabla
             */
            if($resultado)
            {
                //header("Location: login.php");
                echo "<script text='text/javascript'>
                alert('Servicio publicado con exito!');
                window.location = 'misservicios.php';
                </script>";
            }
            /**
             * Si no hay datos correctos en la consulta, no se insertarán los datos del servicio a publicar
             */
            else
            {
                //echo $sql;
                echo "<script text='text/javascript'>
                alert('Ups! No se ha podido publicar tu servicio');
                window.location = 'publicarservicio.php';
                </script>";
            }
        }
        /**
         * No todas las cadenas de texto ingresadas cumplen con la condición inicial. Se deben completar los campos de texto requerido
         */
        else
        {
            echo "<script text='text/javascript'>
            alert('Por favor complete los campos requeridos!');
            window.location = 'publicarservicio.php';
            </script>";
        }
    }

?>