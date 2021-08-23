<?php
    require('database.php');

    // if($_SERVER["REQUEST_METHOD"] == "POST")
    // {
    //     if ($_POST["reg"] == 'XV') {
            
    //     }
    // }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

                    <div class="contenedor-label">
                        <label class="label-rut">Rut</label>
                    </div>
                    
                    <div class="form-section">
                        <input type="text" class="form-input" name="user" placeholder="RUT">
                    </div>

                    <div class="contenedor-label">
                        <label class="label-pass">Contraseña</label>
                    </div>

                    <div class="form-section">
                        <input type="password" class="form-input" name="pass" placeholder="Contraseña"> 
                    </div>

                    <div class="contenedor-label">
                        <label class="label-nombre">Nombre</label>
                    </div>

                    <div class="form-section">
                        <input type="text" name="nombre" placeholder="Nombre...">
                    </div>

                    <div class="contenedor-label">
                        <label class="label-paterno">Apellido paterno</label>
                    </div>

                    <div class="form-section">
                        <input type="text" name="paterno" placeholder="Su apellido paterno">
                    </div>

                    <div class="contenedor-label">
                        <label class="label-materno">Apellido materno</label>
                    </div>

                    <div class="form-section">
                        <input type="text" name="materno" placeholder="Su apellido materno">
                    </div>

                    <div class="contenedor-label">
                        <label class="label-mail">Correo electrónico</label>
                    </div>

                    <div class="form-section">
                        <input type="email" name="mail" placeholder="Su email">
                    </div>

                    <div class="contenedor-label">
                        <label class="label-numero">Número celular</label>
                    </div>

                    <div class="form-section">
                        <input type="number" name="num" placeholder="Su número de celular">
                    </div>

                    <div class="contenedor-label">
                        <label class="label-direccion">Dirección particular</label>
                    </div>

                    <div class="form-section">
                        <input type="text" name="direccion" placeholder="Su direccion">
                    </div>

                    <div class="contenedor-label">
                        <label class="label-fechanac">Fecha de nacimiento</label>
                    </div>

                    <div class="form-section">
                        <input type="date" name="fecha">
                    </div>

                    <!-- <div class="form-section">
                        <input type="text" name="fecha" placeholder="Fecha nacimiento">
                    </div> -->

                    <div class="contenedor-label">
                        <label class="label-sex">Sexo</label>
                    </div>

                    <div class="form-section">
                        <select class="selector" name="sex">
                            <?php
                                $sql = "SELECT * FROM sexo";
                                $query = mysqli_query($conexion, $sql);
                                while($valores = mysqli_fetch_array($query))
                                {
                                    echo '<option value="'.$valores['sex_id'].'" selected >'.$valores['sex_nom'].'</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <!-- <div class="form-section">
                        <form action="signup.php" name="Region">
                            <select class="selector" name="reg">
                                    
                                 <option value="0" selected>Seleccione...</option>
                                 <option value="XV">ARICA Y PARINACOTA</option>
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
                            <button class="btn-conf-region">Confirmar</button>
                        </form>
                    </div> -->

                    <div class="contenedor-label">
                        <label class="label-comuna">Comuna</label>
                    </div>

                    <div class="form-section">
                        <select class="selector" name="com">
                            <?php
                                // if(isset($_POST["reg"]))
                                // {
                                //     $region=$_POST["reg"];
                                // }
                                // $sql = "SELECT * FROM comuna WHERE com_region = '$region'";
                                $sql = "SELECT * FROM comuna";
                                $query = mysqli_query($conexion, $sql);
                                while($valores = mysqli_fetch_array($query))
                                {
                                    echo '<option value="'.$valores['com_id'].'" >'.$valores['com_nombre'].'</option>';
                                }
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
</body>
</html>