<?php
    include_once '../configuracion.php';
    $objSession = new Session();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Segura</title>
</head>
<body>
        <h3>Bienvenido <?php echo $objSession->getRol()->getRolDescripcion().": ".$objSession->getUsuario()->getUsNombre() ?>!!</h3>
        <a href="login.php?cerrar=si">Cerrar Sesion</a>
        <a href="listarUsuario.php">Lista Usuarios</a>
</body>
</html>