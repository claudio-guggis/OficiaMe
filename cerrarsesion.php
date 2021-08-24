<?php
    session_start();
    session_unset();
    session_destroy();
    echo "<script text='text/javascript'>
        alert('Su sesion ha finalizado con éxito!');
        window.location = 'login.php';
        </script>";
    //header("Location: login.php");
?>