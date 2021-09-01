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
            $idABorrar = $value;
        }
        //echo "\$_POST[$i] => $value.\n";
        $i++;
    }

    if(!is_numeric($idABorrar))
    {
        $idABorrar = "'".$idABorrar."'";
    }

    $sql = "DELETE FROM $nombreTabla WHERE $prefijoId = $idABorrar";
    // echo $sql;
    // echo is_numeric($idABorrar);
    // exit();
    $query = mysqli_query($conexion, $sql);

    if($query)
    {
        echo "<script text='text/javascript'>
            alert('Registro eliminado con éxito!');
            window.location = 'admin.php';
            </script>";
    }
    else
    {
        echo "<script text='text/javascript'>
            alert('Ups! No se ha podido eliminar el registro');
            //window.location = 'admin.php';
            </script>";
    }
?>