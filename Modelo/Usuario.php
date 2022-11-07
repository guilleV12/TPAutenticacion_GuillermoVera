<?php
include_once 'Conector/BaseDatos.php';

class Usuario extends BaseDatos{
    private $idusuario;
    private $usnombre;
    private $uspass;
    private $usmail;
    private $usdeshabilitado;

    public function __construct(){
        $this->idusuario = "";
        $this->usnombre = "";
        $this->uspass = "";
        $this->usmail = "";
        $this->usdeshabilitado = "";
    }

    public function cargar($id, $nom, $pass, $mail, $des){
        $this->setIdUsuario($id);
        $this->setUsNombre($nom);
        $this->setUsPass($pass);
        $this->setUsMail($mail);
        $this->setUsDeshabilitado($des);
    }
    
    public function getIdUsuario(){
        return $this->idusuario;
    }

    public function getUsNombre(){
        return $this->usnombre;
    }

    public function getUsPass(){
        return $this->uspass;
    }

    public function getUsMail(){
        return $this->usmail;
    }

    public function getUsDeshabilitado(){
        return $this->usdeshabilitado;
    }

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }
    
    public function setIdUsuario($valor){
        $this->idusuario = $valor;
    }

    public function setUsNombre($valor){
        $this->usnombre = $valor;
    }

    public function setUsPass($valor){
        $this->uspass = $valor;
    }

    public function setUsMail($valor){
        $this->usmail = $valor;
    }

    public function setUsDeshabilitado($valor){
        $this->usdeshabilitado = $valor;
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
        $sql="SELECT * FROM usuario WHERE idusuario = '".$this->getIdUsuario()."'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->cargar($row['idusuario'], $row['usnombre'],$row['uspass'],$row['usmail'],$row['usdeshabilitado']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("Usuario->listar: ".$base->getError());
        }
        return $resp;
    
        
    }
    

	public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM usuario ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Usuario();
                    $obj->cargar($row['idusuario'],$row['usnombre'],$row['uspass'],$row['usmail'],$row['usdeshabilitado']);
                    array_push($arreglo, $obj);
                } 
               
            }
            
        } else {
            $this->setMensajeoperacion("Usuario->listar: ".$base->getError());
        }
 
        return $arreglo;
    }

	
	
	public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO usuario(idusuario,usnombre,uspass,usmail,usdeshabilitado) 
		 VALUES('".$this->getIdUsuario()."','".$this->getUsNombre()."','".$this->getUsPass()."','".$this->getUsPass()."','".
         $this->getUsMail()."','".$this->getUsDeshabilitado()."');";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("Usuario->insertar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Usuario->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE usuario SET usnombre='".$this->getUsNombre()."',uspass='".$this->getUsPass()
        ."', usmail='".$this->getUsMail()."', usdeshabilitado='".$this->getUsDeshabilitado()
        ."' WHERE idusuario='".$this->getIdUsuario()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("Usuario->modificar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Usuario->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM usuario WHERE idusuario='".$this->getIdUsuario()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeoperacion("Usuario->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Usuario->eliminar: ".$base->getError());
        }
        return $resp;
    }

	public function __toString(){
	    return "IdUsuario: ".$this->getIdUsuario()."\nNombre: ".$this->getUsNombre()."\nPass: ".$this->getUsPass().
        "\nMail: ".$this->getUsMail()."\nDeshabilitado: ".$this->getUsDeshabilitado()."\n<<>>\n";
			
	}
}



?>