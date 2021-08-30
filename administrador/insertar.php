<?php
    require_once('./../database.php');

    $i=0;
    foreach($_POST as $key => $value)
    {
        if($i == 0)
        {
            $prefijoId = $value;
        }
        elseif($i == 1)
        {
            $prefijoNombre = $value;
        }
        elseif($i == 2)
        {
            $nombreTabla = $value;
        }
        //echo "\$_POST[$i] => $value.\n";
        $i++;
    }

    $newId = $_POST['ident'];
    $newName = $_POST['name'];

    $sql = "INSERT INTO $nombreTabla ($prefijoId, $prefijoNombre) VALUES ('$newId', '$newName')";
    echo $sql;
    $query = mysqli_query($conexion, $sql);

    if($query)
    {
        echo "<script text='text/javascript'>
            alert('Registro añadido con éxito!');
            window.location = 'mantenertb.php';
            </script>";
    }
    else
    {
        echo "<script text='text/javascript'>
            alert('Ups! No se han podido registrar los datos');
            //window.location = 'mantenertb.php';
            </script>";
    }
?>