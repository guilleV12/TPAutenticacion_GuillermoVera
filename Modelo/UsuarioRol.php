<?php
include_once 'Conector/BaseDatos.php';
include_once 'Usuario.php';
include_once 'Rol.php';

class UsuarioRol extends BaseDatos{
    private $idusuario;
    private $idrol;

    public function __construct(){
        $this->idusuario = "";
        $this->idrol = "";
    }

    public function cargar($idusu, $idr){
        $this->setIdUsuario($idusu);
        $this->setIdRol($idr);
    }
    
    public function getIdUsuario(){
        return $this->idusuario;
    }

    public function getIdRol(){
        return $this->idrol;
    }

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }
    
    public function setIdUsuario($valor){
        $this->idusuario = $valor;
    }

    public function setIdRol($valor){
        $this->idrol = $valor;
    }

    public function setMensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }

    /**
	 * Recupera los datos de un auto por patente
	 * @param int $patente
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
	public function Buscar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM usuariorol WHERE idusuario = '".$this->getIdUsuario()."'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $usuario = new Usuario();
                    $rol = new Rol();
                    $usuario->setIdUsuario($row['idusuario']);
                    $rol->setIdRol($row['idrol']);
                    $this->cargar($usuario, $rol);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("UsuarioRol->listar: ".$base->getError());
        }
        return $resp;
    
        
    }
    

	public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM usuariorol ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $usuariorol = new UsuarioRol();
                    $usuario = new Usuario();
                    $rol = new Rol();
                    $usuario->setIdUsuario($row['idusuario']);
                    $rol->setIdRol($row['idrol']);
                    $usuario->Buscar();
                    $rol->Buscar();
                    $usuariorol->cargar($usuario,$rol);

                    array_push($arreglo, $usuariorol);
                }
               
            }
            
        } else {
            $this->setMensajeoperacion("UsuarioRol->listar: ".$base->getError());
        }
 
        return $arreglo;
    }

	
	
	public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO usuariorol(idusuario,idrol) 
		 VALUES('".$this->getIdUsuario()."','".$this->getIdRol()."');";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("UsuarioRol->insertar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("UsuarioRol->insertar: ".$base->getError());
        }
        return $resp;
    }
    
   /* public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE usuariorol SET roldescripcion='".$this->getRolDescripcion()
        ."' WHERE idrol='".$this->getIdRol()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("Rol->modificar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Rol->modificar: ".$base->getError());
        }
        return $resp;
    }*/
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM usuariorol WHERE idusuario='".$this->getIdUsuario()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeoperacion("UsuarioRol->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("UsuarioRol->eliminar: ".$base->getError());
        }
        return $resp;
    }

	public function __toString(){
	    return "id usuario: ".$this->getIdUsuario()."\nid rol: ".$this->getIdRol()."\n<<>>\n";
			
	}
}



?>