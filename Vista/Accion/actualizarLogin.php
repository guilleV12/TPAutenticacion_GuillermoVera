<?php
    include_once '../../configuracion.php';
    $datos = data_submitted();
    $objUsuarios = new AbmUsuario();
    $datos['usdeshabilitado'] = 0;
    
    if ($objUsuarios->modificacion($datos)){
        header('Location:../listarUsuario.php?error=0');
    }else{
       header('Location:../listarUsuario.php?error=1');
    }

?>