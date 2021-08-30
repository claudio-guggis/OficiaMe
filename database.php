<?php
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'prueba_ofme';

    $conexion = mysqli_connect($server, $username, $password, $database);
    mysqli_set_charset($conexion, "utf8");
?>