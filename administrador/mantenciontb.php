<?php
    session_start(); //siempre debe ir cuando se trabaja con variables de sesión
    
    require_once('./../database.php');

    $nombreTabla = $_POST['nomTablas'];
    $operacion = $_POST['op'];

    //function Insert($)
?>