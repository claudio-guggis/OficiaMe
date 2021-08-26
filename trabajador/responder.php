<?php

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

        $sql = "UPDATE solicitud SET sol_estado = '$estadoNuevo', sol_fecha_res='$fechaRespuesta' WHERE sol_id = $solID";

        $query = mysqli_query($conexion, $sql);

        if($query)
        {
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