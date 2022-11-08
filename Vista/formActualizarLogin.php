<?php
    include_once '../configuracion.php';
    $objUsuario = new AbmUsuario();
    $datos = data_submitted();
    $usuarioMod = $objUsuario->buscar($datos);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"><script src="../Seguridad1/md5_archivos/md5.js"></script>
</head>
<body>
    <form method="post" action="Accion/actualizarLogin.php">
        <label for="nombre">ID usuario:</label>
        <input type="text" name="idusuario" id="idusuario" value="<?php echo $usuarioMod[0]->getIdUsuario() ?>" readonly><br>
        <label for="nombre">Nombre usuario:</label>
        <input type="text" name="usnombre" id="usnombre" value="<?php echo $usuarioMod[0]->getUsNombre() ?>"><br>
        <label for="pass">Contraseña usuario:</label>
        <input type="text" name="uspass" id="uspass" value="<?php echo $usuarioMod[0]->getUsPass() ?>"><br>
        <label for="mail">Mail usuario:</label>
        <input type="text" name="usmail" id="usmail" value="<?php echo $usuarioMod[0]->getUsMail() ?>"><br>
        <input type="submit" value="Enviar" >
    </form>
    <a href="listarUsuario.php">Volver</a>
    
</body>
</html>