<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require ('./../PHPMailer/Exception.php');
    require ('./../PHPMailer/PHPMailer.php');
    require ('./../PHPMailer/SMTP.php');

    session_start();

    require_once('./../database.php');

    if(isset($_POST['response-accepted']))
    {
        $fechaRespuesta = date("Y-m-d");
        $estadoNuevo = 'A';

        $i = 0;
        foreach($_POST as $key => $value)
        {
            if($i==0)
            {
                $solID = $value;
            }
            //echo "\$_POST[$i] => $value.\n";
            $i++;
        }

        $rutTrab = $_SESSION['user'];

        //Sacamos el rut del cliente de la tabla solicitud para enviarle correo
        $sqlrutCli = "SELECT sol_usu_rut, sol_servicio FROM solicitud WHERE sol_id = $solID";
        $resu = mysqli_query($conexion, $sqlrutCli);
        $fila = mysqli_fetch_array($resu);
        $rutCli = $fila[0];
        $idSer = $fila[1];
        //echo $rutCli;
        //exit();

        //Extraemos su correo
        $sqlCorreo = "SELECT usu_correo FROM usuario WHERE usu_rut = '19892760'";
        $res = mysqli_query($conexion, $sqlCorreo);
        $row = mysqli_fetch_array($res);
        $correoCli = $row[0];
        //echo "$correoCli\n";

        //Consultamos los datos del servicio para mostrar en el correo
        $sqlServicio = "SELECT ser_titulo FROM servicio WHERE ser_id = $idSer";
        $result = mysqli_query($conexion, $sqlServicio);
        $registro = mysqli_fetch_array($result);
        $nombreServicio = $registro[0];
        // echo $nombreServicio;
        // exit();

        $sql = "UPDATE solicitud SET sol_estado = '$estadoNuevo', sol_fecha_res='$fechaRespuesta' WHERE sol_id = $solID";

        $query = mysqli_query($conexion, $sql);

        if($query)
        {
            //Extraemos los datos del trabajador para enviarlos en el correo
            $sqlDatosTrab = "SELECT usu_correo, usu_telefono, usu_nombre, usu_paterno FROM usuario WHERE usu_rut = '$rutTrab'";
            $res = mysqli_query($conexion, $sqlDatosTrab);
            $reg = mysqli_fetch_array($res);
            $correoTrab = $reg[0];
            $telefonoTrab = $reg[1];
            $nombreTrab = $reg[2];
            $apellidoPaternoTrab = $reg[3];

            // echo "$correoTrab\n";
            // echo "$telefonoTrab\n";
            // exit();

            $cuerpoCorreo = "Tu solicitud para el servicio '$nombreServicio' ha sido aceptada! Los datos de tu trabajador son:\n";
            $cuerpoCorreo .= "Nombre: $nombreTrab".'\n';
            $cuerpoCorreo .= "Apellido: $apellidoPaternoTrab\n";
            $cuerpoCorreo .= "Correo: $correoTrab\n";
            $cuerpoCorreo .= "Telefono: $telefonoTrab\n";

            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'sistema.oficiame@gmail.com';                     //SMTP username
                $mail->Password   = 'Oficiame123';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('sistema.oficiame@gmail.com', 'OficiaMe Mail System');
                $mail->addAddress("$correoCli", 'Recibe');     //Add a recipient
                // $mail->addAddress('ellen@example.com');               //Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Han aceptado tu solicitud!';
                $mail->Body    = "$cuerpoCorreo";
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                //echo 'El mensaje se envió correctamente';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            echo "<script text='text/javascript'>
                alert('Has aceptado una solicitud!');
                window.location = 'misservicios.php';
                </script>";
        }
        else
        {
            echo "<script text='text/javascript'>
                alert('Ha ocurrido un error!');
                window.location = 'solicitudesmisservicios.php';
                </script>";
        }
    }

    elseif(isset($_POST['response-rejected']))
    {
        $fechaRespuesta = date("Y-m-d");
        $estadoNuevo = 'R';

        $i = 0;
        foreach($_POST as $key => $value)
        {
            if($i==0)
            {
                $solID = $value;
            }
            //echo "\$_POST[$i] => $value.\n";
            $i++;
        }

        $sql = "UPDATE solicitud SET sol_estado = '$estadoNuevo', sol_fecha_res='$fechaRespuesta' WHERE sol_id = $solID";

        $query = mysqli_query($conexion, $sql);

        if($query)
        {
            echo "<script text='text/javascript'>
                alert('Has rechazado una solicitud!');
                window.location = 'misservicios.php';
                </script>";
        }
        else
        {
            echo "<script text='text/javascript'>
                alert('Ha ocurrido un error!');
                window.location = 'solicitudesmisservicios.php';
                </script>";
        }
    }
?>