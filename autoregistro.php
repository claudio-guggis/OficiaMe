<?php

    //session_start();
    require_once('database.php');

    if(isset($_POST['register']))
    {
        if(strlen($_POST["type"])>=1 && strlen($_POST["user"])>=1 && strlen($_POST["pass"])>=1 && strlen($_POST["nombre"])>=1 && strlen($_POST["paterno"])>=1 && strlen($_POST["materno"])>=1 && strlen($_POST["mail"])>=1 && strlen($_POST["num"]) >=1 && strlen($_POST["direccion"])>=1 && strlen($_POST["fecha"])>=1 && strlen($_POST["sex"])>=1 && strlen($_POST["com"])>=1)
        {
            $rut = $_POST["user"];
            $tipo = $_POST["type"];
            $clave = $_POST["pass"];
            $nombre = $_POST["nombre"];
            $apPaterno = $_POST["paterno"];
            $apMaterno = $_POST["materno"];
            $correo = $_POST["mail"];
            $numCelular = $_POST["num"];
            $direccion = $_POST["direccion"];
            $fechanac = $_POST["fecha"];
            $date = date("Y-m-d", strtotime($fechanac));
            $sexo = $_POST["sex"];
            $comuna = $_POST["com"];

            $sql = "INSERT INTO usuario (usu_rut, usu_tipo, usu_nombre, usu_paterno, usu_materno, usu_correo, usu_telefono, usu_direccion, usu_fechanac, usu_clave, usu_sexo, usu_comuna, usu_estado) VALUES ('$rut', '$tipo', '$nombre', '$apPaterno', '$apMaterno', '$correo', '$numCelular', '$direccion', '$date', '$clave', '$sexo', $comuna, 'D')";

            //echo $sql;

            $query = mysqli_query($conexion, $sql);

            if($query)
            {
                //header("Location: login.php");
                echo "<script text='text/javascript'>
                alert('Usuario registrado con exito!');
                window.location = 'login.php';
                </script>";
            }
            else
            {
                echo "<script text='text/javascript'>
                alert('Ups! Algo paso');
                window.location = 'signup.php';
                </script>";
            }
        }
        else
        {
            echo "<script text='text/javascript'>
            alert('Por favor complete los campos!');
            window.location = 'signup.php';
            </script>";
        }
    }
    
?>