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

    function ponNombre($conexion)
    {
        $rut = $_SESSION['user'];
        $sql = "SELECT usu_nombre FROM usuario WHERE usu_rut = '$rut'";
        $query = mysqli_query($conexion, $sql);
        $valor = mysqli_fetch_array($query);
        $row = $valor[0];
        echo $row;
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
    <title>Cliente</title>
</head>
<body>
    <header class="contenedor-flex-header">
        <img src="../imagenes/logo redondo.png" class="flex-item-img">

        <div class="contenedor-busqueda-trabajadores">
            <div class="contenedor-busqueda-trabajadores-segundo">
                
                <form action="busqueda.php" method="GET">
                    

                    <div class="contenedor-busqueda">
                        <input type="text" class="form-busq" name="busq-pers" placeholder ="Búsqueda personalizada...">
                    </div>

                    <div class="contenedor-botonbuscar">
                        <button class="boton-buscar">BúscaMe</button>
                    </div>
                    
                    <div class="contenedor-filtros">

                        <div class="filtro">
                            <select class="filtro-cert" name="cert">
                                <option value="N" selected>No certificado</option>
                                <option value="S">Certificado</option>
                            </select>
                        </div>

                        <div class="filtro">
                            <select class="filtro-region" id="regs" name="regs">
                                <?php
                                    echo llenarRegiones($conexion);
                                ?>
                            </select>
                        </div>

                        <div class="filtro">
                            <select class="filtro-comuna" id="show_comuna" name="com">
                                <?php
                                    echo llenarComunas($conexion);
                                ?>
                            </select>
                        </div>

                    </div>

                </form>
            </div>
        </div>

        <div class="contenedor-saludo">
            <p>Hola <?php echo ponNombre($conexion);?> </p>
        </div>

        <div class="contenedor-opciones">
            <button type="button"><img src="../iconos/btn_opciones.png"></button>
        </div>
        
    </header>

    <?php include('mostrarservicios.php') ?>
    
    <!-- <div class="contenedor-principal-servicios">
        <div class="contenedor-btn-izquierdo">
            <div>
                <button type="button"><img src="https://image.flaticon.com/icons/png/512/20/20924.png"></button>
            </div>
        </div>

        <div class="contenedor-tarjeta">
            
            <div class="contenedor-informacion-tarjeta">
                <div class="linea-izquierda"></div>
                <div class="contenido-tarjeta">
                    <div class="info-general">
                        <p class="titulo"><b>Título del servicio</b></p>
                        <p class="valor">Valor: Sin especificar</p>
                        <p class="trabajador">Trabajador</p>
                        <p class="ubicacion">Región, comuna</p>
                        <div class="valoracion">Valoración: 
                            <div class="contenedor-estrellas">
                                <div>
                                    <img src="../iconos/estrella.png">
                                </div>
                                <div>
                                    <img src="../iconos/estrella.png">
                                </div>
                                <div>
                                    <img src="../iconos/estrella.png">
                                </div>
                                <div>
                                    <img src="../iconos/estrella.png">
                                </div>
                                <div>
                                    <img src="../iconos/estrella2.png">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="contenedor-descripcion">
                        <p class="descripcion">Descripción</p><br>
                        <textarea class="tadescripcion" name="areaDescripcion" cols="30" rows="10"></textarea>
                    </div>
                    <div class="contenedor-fecha-boton">
                        <p class="fechapub">Fecha de publicación: 08/06/2021</p>
                        <button type="button" class="btn-solicitame"><b>SolicitaMe</b></button>
                    </div>
                </div>
                <div class="linea-derecha"></div>
            </div>
            
        </div>

        <div class="contenedor-btn-derecho">
            <div>
                <button type="button"><img src="https://image.flaticon.com/icons/png/512/20/20999.png"></button>
            </div>
        </div>
    </div> -->

    <footer>
        <p><a href="./../cerrarsesion.php">Cerrar sesión</a></p>
    </footer>
    
</body>
</html>
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