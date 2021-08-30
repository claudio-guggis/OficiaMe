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
    <link rel="stylesheet" type="text/css" href="../assets/publicaroferta.css">
    <title>Publicar Servicio</title>
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
            <button type="button"><img src="../iconos/btn_opciones.png"></button>
        </div>
        
    </header>

    <div class="contenedor-publicar">
        
        <div class="contenedor-formulario">

            <div class="label-datos">
                <label for="">Datos del servicio</label>
            </div>

            <form action="registrarservicio.php" class="form" method="post">

                <div class="form-section-titulo">
                    <input type="text" name="sertitulo" placeholder="Ingrese título...">
                </div>

                <div class="form-section-selector">
                    <select class="selector" name="sertipo">
                        <!-- <option value="T">Trabajador</option>
                        <option value="C" selected>Cliente</option> -->
                        
                        <!-- <option value="0">Seleccione...</option> -->
                        <?php
                            $sql = "SELECT * FROM tservicio";
                            $query = mysqli_query($conexion, $sql);
                            while($valores = mysqli_fetch_array($query))
                            {
                                echo '<option value="'.$valores['tser_id'].'" selected >'.$valores['tser_nombre'].'</option>';
                            }
                        ?>

                    </select>
                </div>

                <div class="form-section-valor">
                    <input type="text" name="servalor" placeholder="Valor (opcional)">
                </div>

                <div class="form-section-descripcion">
                    <textarea name="serdescripcion" placeholder="Descripción..."></textarea>
                </div>

                <button class="btn-publicar" name="serpublicar">Publicar</button>

            </form>
        </div>
    </div>

    <footer>
        <p><a href="./../cerrarsesion.php">Cerrar sesión</a></p>
    </footer>
</body>
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