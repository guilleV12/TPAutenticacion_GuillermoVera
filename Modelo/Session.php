<?php

class Session {
	
	
	
	public function __construct() {
		session_start();
	     }
	
	public function iniciar($nombreUsuario,$psw) {
		$_SESSION['usnombre']=$nombreUsuario;
		$_SESSION['uspass']=$psw;
	}
	
	
	
	public function validar() {
		$resp=false;
		$usuario=new AbmUsuario();
		
		$listaUs = $usuario->buscar(null);
			for ($i=0; $i < count($listaUs); $i++) { 
				if ($listaUs[$i]->getUsNombre() == $_SESSION['usnombre']){
					$idusuario = $listaUs[$i]->getIdUsuario();
				}
			}
		$param['idusuario'] = $idusuario;
		$lista=$usuario->buscar($param);
		if ($lista!=null) {
			$resp=true;
		}
		return $resp;
	}
	
	public function activa() {
		$resp=false;
		if (session_status()=== PHP_SESSION_ACTIVE) {
			$resp=true;
		}
		return $resp;
	}
	
	public function getUsuario() {
		if ($this->validar() && $this->activa()) {
			$usuario=new AbmUsuario();
			$listaUs = $usuario->buscar(null);
			for ($i=0; $i < count($listaUs); $i++) { 
				if ($listaUs[$i]->getUsNombre() == $_SESSION['usnombre']){
					$idusuario = $listaUs[$i]->getIdUsuario();
				}
			}
			$param['idusuario'] = $idusuario;
			$lista=	$usuario->buscar($param);
		

		$usuarioLog=$lista[0];
			}
			return $usuarioLog;
	}
	 
	 public function getRol() {
	 	if ($this->getUsuario()!==null) {
	 		$usuarioLog=$this->getUsuario();
	 		$param['idusuario']=$usuarioLog->getIdUsuario();
	 		$objTransUsRol=new AbmUsuarioRol();
	 		$lista=$objTransUsRol->buscar($param);
	 		$param1['idrol']=$lista[0]->getIdRol()->getIdRol();
	 		$objTransRol=new AbmRol();
	 		$rol=$objTransRol->buscar($param1);
	 		$objRol=$rol[0];
	 		
	 	}
	 	return $objRol;
	 	}
	 	
	 	public function cerrar() {
	 		
	 		if ($this->activa()) {
	 			unset($_SESSION['usnombre']);
	 			unset($_SESSION['uspass']);
	 			session_destroy();
	 		}
	 	}
	 }

