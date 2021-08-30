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
        elseif($i == 3)
        {
            $idACambiar = $value;
        }
        //echo "\$_POST[$i] => $value.\n";
        $i++;
    }

    $newId = $_POST['ident'];
    $newName = $_POST['name'];

    $sql = "UPDATE $nombreTabla SET $prefijoId = '$newId', $prefijoNombre = '$newName' WHERE $prefijoId = '$idACambiar'";
    // echo $sql;
    // exit();
    $query = mysqli_query($conexion, $sql);

    if($query)
    {
        echo "<script text='text/javascript'>
            alert('Registro actualizado con éxito!');
            window.location = 'mantenertb.php';
            </script>";
    }
    else
    {
        echo "<script text='text/javascript'>
            alert('Ups! No se han podido actualizar los datos');
            //window.location = 'mantenertb.php';
            </script>";
    }
?>