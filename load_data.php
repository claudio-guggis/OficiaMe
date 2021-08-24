<?php
    require_once("database.php");

    $output = "";

    if (isset($_POST["reg_id"]))
    {
        if($_POST["reg_id"] != '')
        {
            $region = $_POST["reg_id"];
            $sql = "SELECT * FROM comuna WHERE com_region = '$region'";
        }
        else
        {
            $sql = "SELECT * FROM comuna";
        }
        $resultado = mysqli_query($conexion, $sql);
        //echo $sql;

        while($valores = mysqli_fetch_array($resultado))
        {
            $output .= '<option value="'.$valores['com_id'].'" >'.$valores['com_nombre'].'</option>';
        }
        echo $output;
    }
?>