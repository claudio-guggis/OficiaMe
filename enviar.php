<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require ('PHPMailer/Exception.php');
    require ('PHPMailer/PHPMailer.php');
    require ('PHPMailer/SMTP.php');

    $nombres = $_POST['name'];
    $correo = $_POST['email'];
    $telefono = $_POST['phone'];
    $comentario = $_POST['comment'];

    $cuerpoCorreo = "Una persona se ha contactado con nosotros. A continuación se mencionan los detalles de su consulta: <br><br>\n\n ";
    $cuerpoCorreo .= 'Nombre: '.$nombres."<br>\n\n ";
    $cuerpoCorreo .= 'Correo: '.$correo."<br>\n\n" ;
    $cuerpoCorreo .= 'Telefono: '.$telefono."<br>\n\n ";
    $cuerpoCorreo .= 'Comentario: '.$comentario."<br>\n\n ";

    $host = 'smtp.gmail.com';
    // $host = 'email-smtp.sa-east-1.amazonaws.com';
    $port = 465;

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        //$mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $host;                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'sistema.oficiame@gmail.com';                     //SMTP username
        $mail->Password   = 'Oficiame123';                               //SMTP password
        //$mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->SMTPSecure = 'ssl'; 
        $mail->Port       = $port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom("$correo", 'Usuario');
        $mail->addAddress("sistema.oficiame@gmail.com", 'OficiaMe Mail System');     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Un cliente quiere contactarnos!';
        $mail->Body    = "$cuerpoCorreo";
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        //echo 'El mensaje se envió correctamente';

        if(isset($_SESSION['type']))
        {
            $tipo = $_SESSION['type'];

            if($tipo == 'T')
            echo "<script text='text/javascript'>
                alert('Tu mensaje se ha enviado correctamente! Te contactaremos en breve');
                window.location = 'trabajador/misservicios.php';
                </script>";

            elseif($tipo == 'C')
                echo "<script text='text/javascript'>
                alert('Tu mensaje se ha enviado correctamente! Te contactaremos en breve');
                window.location = 'cliente/cliente.php';
                </script>";
        }
        else
            echo "<script text='text/javascript'>
                alert('Tu mensaje se ha enviado correctamente! Te contactaremos en breve');
                window.location = 'login.php';
                </script>";

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>