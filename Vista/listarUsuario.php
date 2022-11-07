<?php
    include_once '../configuracion.php';
    $objUsuario = new AbmUsuario();
    $listaUsuarios = $objUsuario->buscar(null);
    $datos = data_submitted();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar usuarios</title>
</head>
<body>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Pass</th>
      <th scope="col">Mail</th>
      <th scope="col">Deshabilitado</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (count($listaUsuarios) > 0){
        foreach ($listaUsuarios as $usuario) {
            echo "<tr>";
            echo "<td>".$usuario->getIdUsuario()."</td>";
            echo "<td>".$usuario->getUsNombre()."</td>";
            echo "<td>".$usuario->getUsPass()."</td>";
            echo "<td>".$usuario->getUsMail()."</td>";
            echo "<td>".$usuario->getUsDeshabilitado()."</td>";
            echo "<td><a href='Accion/eliminarLogin.php?idusuario=".$usuario->getIdusuario()."'>eliminar</a></td>";
            echo "<td><a href='formActualizarLogin.php?idusuario=".$usuario->getIdusuario()."'>editar</a></td>";
        }
    }
    ?>
  </tbody>
</table>
    <?php
    if (isset($datos['error'])){
      if ($datos['error'] == 1) {
        echo "<br>Error no se pudo realizar la modificacion.";
      }elseif ($datos['error'] == 0) {
        echo "<br>Se ha realizado la modificacion con exito.";
      }
    }
    if (isset($datos['eliminar'])){
      if ($datos['eliminar'] == 1) {
        echo "<br>Error no se pudo eliminar";
      } elseif ($datos['eliminar'] == 0){
        echo "<br>Se ha eliminado el usuario";
      }
    }
    ?>

  <br><br>
  <a href="login.php">Logearse</a>
    
</body>
</html>