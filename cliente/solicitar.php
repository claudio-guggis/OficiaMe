<?php
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

        $sql = "INSERT INTO solicitud (sol_fecha_ing, sol_fecha_res, sol_estado, sol_servicio, sol_usu_rut, sol_usu_tipo) VALUES ('$fechaIngreso', null, '$estadoSolicitud', $solServicio, '$rut', '$tipo')";
        //echo $sql;

        $query = mysqli_query($conexion, $sql);

        if($query)
        {
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