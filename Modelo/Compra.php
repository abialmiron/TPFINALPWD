<?php
class Compra{
    private $idcompra;
    private $cofecha;
    private $objUsuario;
    private $mensajeOperacion;

    public function __construct(){
        $this->idcompra = '';
        $this->cofecha = '';
        $this->objUsuario = '';
        $this->mensajeOperacion = '';
    }

    public function setear($idcompraSetear,$cofechaSetear,$objUsuarioSetear){
        $this->idcompra = $idcompraSetear;
        $this->cofecha = $cofechaSetear;
        $this->objUsuario = $objUsuarioSetear;
        $this->mensajeOperacion = '';
    }

    public function setIdCompra($idcompraNuevo){
        $this->idcompra = $idcompraNuevo;
    }

    public function getIdCompra(){
        return $this->idcompra;
    }

    public function setCoFecha($cofechaNuevo){
        $this->cofecha = $cofechaNuevo;
    }

    public function getCoFecha(){
        return $this->cofecha;
    }
    
    public function setObjUsuario($objUsuarioNuevo){
        $this->objUsuario = $objUsuarioNuevo;
    }

    public function getObjUsuario(){
        return $this->objUsuario;
    }

    public function setMensajeOperacion($valor){
        $this->mensajeOperacion = $valor;
        
    }
    public function getMensajeOperacion(){
        return $this->mensajeOperacion;
    }

    
    /*******************************
     *  MÉTODOS PARA LA CONEXIÓN CON LA BD
     *******************************/

     public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM compra WHERE idcompra = ".$this->getIdCompra();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $objUsuario = new Usuario();
                    $objUsuario->setIdUsuario($row['idusuario']);
                    $objUsuario->cargar();
                    $this->setear($row['idcompra'],$row['cofecha'], $objUsuario);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("compra->cargar: ".$base->getError());
        }
        return $resp;
    }

    public function insertar(){
		$base=new BaseDatos();
		$resp= null;
		$consultaInsertar="INSERT INTO compra(cofecha,idusuario)
				VALUES ('".$this->getCoFecha()."','".$this->getObjUsuario()->getIdUsuario()."')";
		if($base->Iniciar()){
            $id = $base->Ejecutar($consultaInsertar);
			if($id != null){
			    $resp=  $id;
				$this->setIdCompra($id);
			}else{
				$this->setMensajeOperacion("compra->insertar: ".$base->getError());
			}
		} else {
				$this->setMensajeOperacion("compra->insertar: ".$base->getError());
		}
		return $resp;
	}

    public function modificar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE compra SET
        cofecha = '" . $this->getCoFecha() . "',
        idusuario = '" . $this->getObjUsuario()->getIdUsuario() . "',
        WHERE idcompra = '" . $this->getIdCompra() . "'";
    
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("compra->modificar: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("compra->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql = "DELETE FROM compra WHERE idcompra = ".$this->getIdCompra();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("compra->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("compra->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compra ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $obj= new Compra();
                    $objUsuario = new Usuario();
                    $objUsuario->setIdUsuario($row['idusuario']);
                    $objUsuario->cargar();
                    $obj->setear($row['idcompra'],$row['cofecha'], $objUsuario);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("compra->listar: ".$base->getError());
        }
        return $arreglo;
    }

}

?>