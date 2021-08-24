<?php
    session_start(); //siempre debe ir cuando se trabaja con variables de sesión

    require('./../database.php');

    function llenarComunas($conexion)
    {
        $output = '';
        $sql = "SELECT * FROM comuna";
        $query = mysqli_query($conexion, $sql);
        while($valores = mysqli_fetch_array($query))
        {
            $output.= '<option value="'.$valores['com_id'].'" >'.$valores['com_nombre'].'</option>';
        }
        return $output;
    }
    
    if ($_SESSION['user']) 
    {
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Cliente</title>
</head>
<body>
    <header>
        <div class="contenedor-busqueda-trabajadores">
            <img src="../imagenes/logo redondo.png" >
            <form action="" method="post">

                <div class="contenedor-busqueda">
                    <input type="text" class="form-busq" name="busq-pers" placeholder ="Búsqueda personalizada">
                </div>

                <div class="dropdown-certificado">
                    <select name="cert">
                        <option value="NC" selected>No certificado</option>
                        <option value="C">Certificado</option>
                    </select>
                </div>

                <div class="dropdown-regiones">
                    <select class="selector" id="regs" name="regs">
                        <option value="XV" selected >ARICA Y PARINACOTA</option>
                        <option value="I">TARAPACA</option>
                        <option value="II">ANTOFAGASTA</option>
                        <option value="III">ATACAMA</option>
                        <option value="IV">COQUIMBO</option>
                        <option value="V">VALPARAISO</option>
                        <option value="VI">OHIGGINS</option>
                        <option value="VII">MAULE</option>
                        <option value="XVI">NUBLE</option>
                        <option value="VIII">BIOBIO</option>
                        <option value="IX">ARAUCANIA</option>
                        <option value="XIV">LOS RIOS</option>
                        <option value="X">LOS LAGOS</option>
                        <option value="XI">AYSEN</option>
                        <option value="XII">MAGALLANES</option>
                        <option value="RM">METROPOLITANA</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="dropdown-comunas">
            <select class="selector" id="show_comuna" name="com">
                <?php
                    echo llenarComunas($conexion);
                ?>
            </select>
        </div>

        <div class="contenedor-opciones">
            <ul>
                <li>Hola Cliente <?php echo $_SESSION['user']; ?></li>
                <li><a href="">Opciones</a></li>
            </ul>
        </div>
        
    </header>
    <br>
    <hr>
    <p><a href="./../cerrarsesion.php">Cerrar sesión</a></p>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#regs').change(function(){
            var reg_id = $(this).val();

            $.ajax({
                url:"load_data.php",
                method:"POST",
                data:{reg_id:reg_id},
                success:function(data){
                    $('#show_comuna').html(data);
                }
            });

        });
    });
</script>
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