<?php
    include_once '../../configuracion.php';
    $datos = data_submitted();
    $objSession = new Session();
    if ($objSession->activa()){
        $objSession->cerrar();
        $objSession = new Session();
        $objSession->iniciar($datos['usnombre'],$datos['uspass']);
        if ($objSession->validar() == true){
            $usuarioSel = $objSession->getUsuario();
            if ($usuarioSel->getUsPass() == $datos['uspass']){
                header('Location:../paginaSegura.php');
            }else{
                header('Location:../login.php?error=1');
            }
        }else{
            header('Location:../login.php?error=1');
        }
    }else{
        $objSession->iniciar($datos['usnombre'],$datos['uspass']);
        if ($objSession->validar() == true){
            $usuarioSel = $objSession->getUsuario();
            if ($usuarioSel->getUsPass() == $datos['uspass']){
                header('Location:../paginaSegura.php');
            }else{
                header('Location:../login.php?error=1');
            }
        }else{
            header('Location:../login.php?error=1');
        }
    }

?>