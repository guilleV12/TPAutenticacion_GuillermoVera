<?php
    include_once '../configuracion.php';
    $datos = data_submitted();
    $objSession = new Session();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="post" action="Accion/validarLogin.php">
        <?php
        if (isset($datos['error'])){
            echo "<label for='usnombre'>Usuario y/o password incorrectos</label><br>";
        }
        if (isset($datos['cerrar'])){
            $objSession->cerrar();
        }
        ?>
        <input type="text" name="usnombre" id="usnombre" placeholder="Usuario"><br>
        <input type="password" name="uspass" id="uspass" placeholder="Pass"><br>
        <input type="submit" value="Iniciar sesion">
    </form>

    
</body>
</html>