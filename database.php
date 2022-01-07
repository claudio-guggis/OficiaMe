<?php
    // $server = $_SERVER['database-ofme-prueba2.c6pqllnanjg0.sa-east-1.rds.amazonaws.com'];
    // $username = $_SERVER['admin'];
    // $password = $_SERVER['prueba1234'];
    // $database = $_SERVER['pruebaofme'];
    // $port = $_SERVER['3306'];

    $server = 'aa19t7qwob9kich.c6pqllnanjg0.sa-east-1.rds.amazonaws.com';
    $username = 'admin';
    $password = 'prueba1234';
    $database = 'pruebaofme';
    $port = '3306';

    //$link = new mysqli($server, $username, $password, $database, $port);

    $conexion = mysqli_connect($server, $username, $password, $database, $port);
    mysqli_set_charset($conexion, "utf8");
    //mysqli_set_charset($link, "utf8"); 
?>