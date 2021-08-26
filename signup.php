<?php
    require('database.php');

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
        echo '<option value="0" selected>Seleccione...</option>';
        //return $output;
    }

    function llenarSexo($conexion)
    {
        //$output = '';
        $sql = "SELECT sex_id, sex_nom FROM sexo";
        $query = mysqli_query($conexion, $sql);
        while($valores = mysqli_fetch_array($query))
        {
            echo '<option value="'.$valores['sex_id'].'" selected >'.$valores['sex_nom'].'</option>';
        }
        //return $output;
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/signup.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="assets/login.css"> -->
    <title>Registrarse</title>
</head>
<body>
    <div class="contenedor-flexible-principal">
            <div class="contenedor-flexible">
                
                <div class="contenedor-logo">
                    <img class="logo" src="imagenes/logo redondo.png">
                </div>

                <form action="autoregistro.php" class="form" method="post">

                    <div class="contenedor-label">
                        <label class="label-rol">Tipo de Usuario</label>
                    </div>
                    
                    <select class="selector" name="type">
                        <!-- <option value="T">Trabajador</option>
                        <option value="C" selected>Cliente</option> -->
                        
                        <!-- <option value="0">Seleccione...</option> -->
                        <?php
                            $sql = "SELECT * FROM tusuario WHERE tusu_id = 'C' OR  tusu_id = 'T'";
                            $query = mysqli_query($conexion, $sql);
                            while($valores = mysqli_fetch_array($query))
                            {
                                echo '<option value="'.$valores['tusu_id'].'" selected >'.$valores['tusu_nombre'].'</option>';
                            }
                        ?>

                    </select>

                
                    
                


                    <div class="form-section">
                        <input type="text" class="form-input" name="nombre" placeholder="Nombre"> 
                    </div>

                    <div class="form-section">
                        <input type="text" class="form-input" name="rut" placeholder="Rut"> 
                    </div>

                    <div class="form-section">
                        <input type="password" class="form-input" name="pass" placeholder="Contraseña"> 
                    </div>

                    <div class="form-section">
                        <input type="text" class="form-input" name="apaterno" placeholder="Apellido parterno"> 
                    </div>

                    <div class="form-section">
                        <input type="text" class="form-input" name="amaterno" placeholder="Apellido materno"> 
                    </div>

                    <div class="form-section">
                        <input type="text" class="form-input" name="celectronico" placeholder="Correo electronico"> 
                    </div>

                    <div class="form-section">
                        <input type="text" class="form-input" name="ncelular" placeholder="Numero celular"> 
                    </div>

                    <div class="form-section">
                        <input type="text" class="form-input" name="nombre" placeholder="Dirección particular"> 
                    </div>

                    <div class="form-section">
                        <input type="date" class="form-input" name="nombre" placeholder="Fecha de nacimiento"> 
                    </div>


                

                    <!-- <div class="form-section">
                        <input type="text" name="fecha" placeholder="Fecha nacimiento">
                    </div> -->

                    <div class="contenedor-label">
                        <label class="label-sex">Sexo</label>
                    </div>

                    <div class="form-section">
                        <select class="selectorsex" name="sex">
                            <?php
                                echo llenarSexo($conexion);
                            ?>
                        </select>
                    </div>

                    <div class="contenedor-label">
                        <label class="label-reg">Región</label>
                    </div>

                    <div class="form-section">
                        <select class="selectorreg" id="regs" name="regs" onchange="changeFunction(this)">
                            <?php
                                // $sql = "SELECT reg_id, reg_nombre FROM region";
                                // $query = mysqli_query($conexion, $sql);
                                // while($valores = mysqli_fetch_array($query))
                                // {
                                //     echo '<option value="'.$valores['reg_id'].'"selected>'.$valores['reg_nombre'].'</option>';
                                // }
                                /**
                                 * Se llama a la función que llena las regiones
                                 */
                                echo llenarRegiones($conexion);
                            ?>
                        </select>
                    </div>

                    <div class="contenedor-label">
                        <label class="label-comuna">Comuna</label>
                    </div>

                    <div class="form-section">
                        <!-- <input type="hidden" name="selectInput" id="showValue" value=""> -->
                        <select class="selectorcom" id="show_comuna" name="com">
                            <?php
                                // $sql = "SELECT com_id, com_nombre FROM comuna";
                                // $query = mysqli_query($conexion, $sql);
                                // while($valores = mysqli_fetch_array($query))
                                // {
                                //     echo '<option value="'.$valores['com_id'].'" >'.$valores['com_nombre'].'</option>';
                                // }
                                /**
                                 * Se llama a la función que llena el select con las comunas
                                 */
                                echo llenarComunas($conexion);
                            ?>
                        </select>
                    </div>

                    <button class="boton-registrate" name="register">RegistrarMe</button>

                </form>

                <div class="contenedor-flexible-inferior">
                    <a href="login.php"><button class="boton-inicio-sesion">Iniciar Sesión</button></a>
                </div>
            </div>
        </div>

        <script>
            function changeFunction(selectValue)
            {
                var x = selectValue.value;
                document.getElementById("showValue").value = x;
            }
        </script>

        <!-- 
            script necesario para facilitar la consulta de mostrar las comunas por región
         -->
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
</body>
</html>