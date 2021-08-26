<?php
    session_start(); //siempre debe ir cuando se trabaja con variables de sesión

    require('./../database.php');

    function llenarRegiones($conexion)
    {
        //$output = '';
        $sql = "SELECT reg_id, reg_nombre FROM region";
        $query = mysqli_query($conexion, $sql);
        while($valores = mysqli_fetch_array($query))
        {
            echo '<option value="'.$valores['reg_id'].'">'.$valores['reg_nombre'].'</option>';
        }
        echo '<option value="0" selected >Seleccione...</option>';
        //return $output;
    }

    function llenarComunas($conexion)
    {
        //$output = '';
        $sql = "SELECT com_id, com_nombre FROM comuna";
        $query = mysqli_query($conexion, $sql);
        while($valores = mysqli_fetch_array($query))
        {
            echo '<option value="'.$valores['com_id'].'" >'.$valores['com_nombre'].'</option>';
        }
        echo '<option value="0" selected >Seleccione...</option>';
        //return $output;
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
    <link rel="stylesheet" type="text/css" href="../assets/cliente.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <title>Cliente</title>
</head>
<body>
    <header>
        <div class="contenedor-busqueda-trabajadores">
            <img src="../imagenes/logo redondo.png" >
            <form action="busqueda.php" method="post">

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
                    <select class="selector" id="regs" name="regs" onchange="changeFunction(this)">
                        <?php
                            echo llenarRegiones($conexion);
                        ?>
                    </select>
                </div>

                <div class="dropdown-comunas">
                    <select class="selector" id="show_comuna" name="com">
                        <?php
                            echo llenarComunas($conexion);
                        ?>
                    </select>
                </div>

                <button class="btn-buscarserv" name="search">Buscar</button>
            </form>
        </div>

        <div class="contenedor-saludo">
            <p>Hola Cliente <?php echo $_SESSION['user']; ?></p>
        </div>

        <div class="contenedor-opciones">
            <button type="button"><img src="../iconos/btn_opciones.png"></button>
        </div>
        
    </header>
    <?php
        include('mostrarservicios.php')
    ?>
    <br>
    <hr>
    <p><a href="./../cerrarsesion.php">Cerrar sesión</a></p>
</body>
</html>

<script>
    function changeFunction(selectValue)
    {
        var x = selectValue.value;
        document.getElementById("showValue").value = x;
    }
</script>

<script>
    $(document).ready(function(){
        $('#regs').change(function(){
            var reg_id = $(this).val();

            $.ajax({
                url:"../load_data.php",
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