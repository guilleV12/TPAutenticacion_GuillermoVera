<?php
include_once 'Conector/BaseDatos.php';

class Rol extends BaseDatos{
    private $idrol;
    private $roldescripcion;

    public function __construct(){
        $this->idrol = "";
        $this->roldescripcion = "";
    }

    public function cargar($id, $roldesc){
        $this->setIdRol($id);
        $this->setRolDescripcion($roldesc);
    }
    
    public function getIdRol(){
        return $this->idrol;
    }

    public function getRolDescripcion(){
        return $this->roldescripcion;
    }

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }
    
    public function setIdRol($valor){
        $this->idrol = $valor;
    }

    public function setRolDescripcion($valor){
        $this->roldescripcion = $valor;
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
        $sql="SELECT * FROM rol WHERE idrol = '".$this->getIdRol()."'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->cargar($row['idrol'], $row['roldescripcion']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("Rol->listar: ".$base->getError());
        }
        return $resp;
    
        
    }
    

	public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM rol ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Rol();
                    $obj->cargar($row['idrol'],$row['roldescripcion']);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            $this->setMensajeoperacion("Rol->listar: ".$base->getError());
        }
 
        return $arreglo;
    }

	
	
	public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO rol(idrol,roldescripcion) 
		 VALUES('".$this->getIdRol()."','".$this->getRolDescripcion()."');";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("Rol->insertar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Rol->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE rol SET roldescripcion='".$this->getRolDescripcion()
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
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM rol WHERE idrol='".$this->getIdRol()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeoperacion("Rol->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Rol->eliminar: ".$base->getError());
        }
        return $resp;
    }

	public function __toString(){
	    return "id rol: ".$this->getIdRol()."\nDescripcion: ".$this->getRolDescripcion()."\n<<>>\n";
			
	}
}



?>