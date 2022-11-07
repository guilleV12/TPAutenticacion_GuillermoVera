<?php
    include_once '../../configuracion.php';
    $datos = data_submitted();
    $objUsuarios = new AbmUsuario();
    $usuarioEliminar = $objUsuarios->buscar($datos);
    $objUsuarioRol = new AbmUsuarioRol();
    $idUsuRol['idusuario'] = $datos['idusuario'];
    $usuarioRolElim = $objUsuarioRol->buscar($idUsuRol);
    $usRE[0] = ['idusuario'=>$usuarioRolElim[0]->getIdUsuario()->getIdUsuario(), 'idrol'=>$usuarioRolElim[0]->getIdRol()->getIdRol()];
    $usE[0] = ['idusuario'=>$usuarioEliminar[0]->getIdUsuario(), 'usnombre'=>$usuarioEliminar[0]->getUsNombre(),
                'uspass'=>$usuarioEliminar[0]->getUsPass(),'usmail'=>$usuarioEliminar[0],
                'usdeshabilitado'=>$usuarioEliminar[0]->getUsDeshabilitado()];
    print_r($usRE[0]);
    if ($objUsuarioRol->baja($usRE[0])){
        if ($objUsuarios->baja($usE[0])){
            header('Location:../listarUsuario.php?eliminar=0');
        }
    }else{
           header('Location:../listarUsuario.php?eliminar=1');

    }

?>