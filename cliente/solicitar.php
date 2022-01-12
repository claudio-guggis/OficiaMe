<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require ('./../PHPMailer/Exception.php');
    require ('./../PHPMailer/PHPMailer.php');
    require ('./../PHPMailer/SMTP.php');

    session_start();

    //require_once('mostrarservicios.php');

    require_once('./../database.php');

    if(isset($_POST["request"]))
    {
        $fechaIngreso = date("Y-m-d");
        $estadoSolicitud = 'E';
        $i=0;
        foreach($_POST as $key => $value)
        {
            if($i==0)
            {
                $solServicio = $value;
            }
            //echo "\$_POST[$i] => $value.\n";
            $i++;
        }
        
        // echo 'Field '.htmlspecialchars($key).' is '.htmlspecialchars($value)."<br>";
        // $solServicio = htmlspecialchars($key);
        //echo 'Id servicio: '.$solServicio;

        $rut = $_SESSION['user'];
        $tipo = $_SESSION['type'];

        $sqlrutTrab = "SELECT ser_usu_rut FROM servicio WHERE ser_id = $solServicio";
        //echo $sqlrutTrab."\n";

        $resu = mysqli_query($conexion, $sqlrutTrab);
        $fila = mysqli_fetch_array($resu);
        $rutTrab = $fila[0];

        $sql = "INSERT INTO solicitud (sol_fecha_ing, sol_fecha_res, sol_estado, sol_servicio, sol_usu_rut, sol_usu_tipo) VALUES ('$fechaIngreso', null, '$estadoSolicitud', $solServicio, '$rut', '$tipo')";
        //echo $sql;

        $query = mysqli_query($conexion, $sql);

        if($query)
        {
            /** Datos para el correo del usuario */

            //Consultamos para obtener el correo del trabajador
            $sqlCorreo = "SELECT usu_correo FROM usuario WHERE usu_rut = '$rutTrab'";
            //echo $sqlCorreo."\n";
        
            $res = mysqli_query($conexion, $sqlCorreo);
            $row = mysqli_fetch_array($res);
            $correo = $row[0];
            //echo $correo;
            //exit();
            
            $cuerpoCorreo = "Revisa tu bandeja de solicitudes para que respondas pronto a esta solicitud";
            //Create an instance; passing `true` enables exceptions

            $sender = 'sistema.oficiame@gmail.com';
            $host = 'email-smtp.sa-east-1.amazonaws.com';
            $port = 587;
            $usernameSMTP = 'AKIAVQJY5LW27J4LNDLJ';
            $passwordSMTP = 'BF5SuGCwUdEndki5E4WN6S1MhKQpwo4URoQ92aqPdgoI';

            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = $host;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = $usernameSMTP;                     //SMTP username
                $mail->Password   = $passwordSMTP;                               //SMTP password
                $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
                $mail->Port       = $port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('sistema.oficiame@gmail.com', 'OficiaMe Mail System');
                $mail->addAddress("$correo", 'Recibe');     //Add a recipient
                // $mail->addAddress('ellen@example.com');               //Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Alguien quiere solicitar tu servicio!';
                $mail->Body    = "$cuerpoCorreo";
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                //echo 'El mensaje se envió correctamente';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            echo "<script text='text/javascript'>
                alert('Solicitud realizada con exito!');
                window.location = 'cliente.php';
                </script>";
        }
        else
        {
            echo "<script text='text/javascript'>
                alert('Ha ocurrido un error con la solicitud!');
                window.location = 'cliente.php';
                </script>";
        }
    }
?>