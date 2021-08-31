<?php
    require_once("./../database.php");
    session_start(); //siempre debe ir cuando se trabaja con variables de sesión
    if ($_SESSION['user']) 
    {
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/solicitudesmisservicios.css">
    
    <title>Mis Servicios</title>
</head>
    <body>
        <header class="contenedor-flex-header">
            
            <img src="../imagenes/logo redondo.png" class="flex-item-logo"> 

            <div class="contenedor-subsecciones">
                <button class="btn-ms" type="button">Mis Servicios</button>
                <button class="btn-po" type="button">Publicar Oferta</button>
                <button class="btn-sol" type="button">Solicitudes</button>
            </div>

            <div class="contenedor-saludo">
                <p>Hola <?php echo $_SESSION['user'];?> </p>
            </div>

            <div class="contenedor-opciones">
                <nav class="main_nav">
                    
             
                <button class="icon_menu" id ="btn_menu"><img  src="../iconos/btn_opciones.png"></button>
                    
                    <ul class="menu" id ="menu">
                        <li class ="menu_item"><a href="" class="menu_link menu_link_select">Solicitudes</a></li>
                        <li class ="menu_item"><a href="" class="menu_link">Cambiar usuario</a></li>
                        <li class ="menu_item"><a href="" class="menu_link">Cambiar tipo usuario</a></li>
                        <li class ="menu_item"><a href="./../cerrarsesion.php" class="menu_link">Cerrar sesión</a></li>
                    </ul>
                 </nav>
               

             </div>
            
        
    </header>
    <div  class="contenedorprincipal">
       
        <div class="contenedorformulario">
            
            <div class="contb">
                
                
            </div>
            <div class="contsol1">
                <div class="label-t1">
                    <label for="">Titulo servicio 1</label>
                </div>
            <div class="label-d1">
                    <label for="">De: Cliente 1</label>
            </div>
            <div class="label-fe1">
                    <label for="">Emitida el: 15/08/2021 </label>
            </div>
            <div class="label-or1">
                    <label for="">Region 1, Comuna 1</label>
            </div>
             
                <button class="btn-a1" name="seraceptar">Aceptar</button>
                <button class="btn-r1" name="serrechazar">Rechazar</button>
               
               

            </div>  
            <div class="es">
                
            </div>
            <div class="contsol2">
                <div class="label-titulo2">
                    <label for="">Titulo servicio 2</label>
                </div>
                <div class="label-de2">
                    <label for="">De: Cliente 2</label>
                </div>
            <div class="label-f2">
                    <label for="">Emitida el: 17/08/2021 </label>
            </div>
            <div class="label-ori2">
                    <label for="">Region 2, Comuna 2</label>
            </div>
             
                <button class="btn-a2" name="seraceptar">Aceptar</button>
                <button class="btn-r2" name="serrechazar">Rechazar</button>


                
            </div>
            <div class="contb2">
               
    </div>



        
    
        </div>

     








    </div>








    

    
    
</body>
    <footer>
        <p><a href="./../cerrarsesion.php">Cerrar sesión</a></p>
    </footer>
    <script src="../assets/menu.js"></script>

</html>
<?php
    }
    else
    {
        echo "<script text='text/javascript'>
            alert('Usted no esta logueado');
            window.location='login.php';
            </script>";
    }
?>