<?php
class CompraItem{
    private $idCompraItem;
    private $objProducto;
    private $objCompra;
    private $ciCantidad;
    private $mensajeOperacion;

    public function __construct(){
        $this->idCompraItem = ''; 
        $this->objProducto = ''; 
        $this->objCompra = ''; 
        $this->ciCantidad = ''; 
        $this->mensajeOperacion = ''; 
    }

    public function setear($idCompraItem,$objProducto,$objCompra,$ciCantidad){
        $this->idCompraItem = $idCompraItem; 
        $this->objProducto = $objProducto; 
        $this->objCompra = $objCompra; 
        $this->ciCantidad = $ciCantidad; 
        $this->mensajeOperacion = ''; 
    }

    public function getIdCompraItem(){
        return $this->idCompraItem;
    }

    public function setIdCompraItem($idCompraItem){
        $this->idCompraItem = $idCompraItem;
    }

    public function getObjProducto(){
        return $this->objProducto;
    }

    public function setObjProducto($objProducto){
        $this->objProducto = $objProducto;
    }

    public function getObjCompra(){
        return $this->objCompra;
    }

    public function setObjCompra($objCompra){
        $this->objCompra = $objCompra;
    }

    public function getCiCantidad(){
        return $this->ciCantidad;
    }

    public function setCiCantidad($ciCantidad){
        $this->ciCantidad = $ciCantidad;
    }

    public function getMensajeOperacion(){
        return $this->mensajeOperacion;
    }

    public function setMensajeOperacion($mensajeOperacion){
        $this->mensajeOperacion = $mensajeOperacion;
    }

     /*******************************
     *  MÉTODOS PARA LA CONEXIÓN CON LA BD
     *******************************/

     public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM compraitem WHERE idcompraitem =". $this->getIdCompraItem();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $objCompra = new Compra();
                    $objCompra->setIdCompra($row['idcompra']);
                    $objCompra->cargar();
                    $objProducto= new Producto();
                    $objProducto->setIdproducto($row['idproducto']);
                    $objProducto->cargar();
                    $this->setear($row['idcompraitem'],$objProducto, $objCompra,$row['cicantidad']);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("compraitem->cargar: ".$base->getError());
        }
        return $resp;
    }

    public function insertar(){
		$base=new BaseDatos();
		$resp= null;
		$consultaInsertar="INSERT INTO compraitem(idproducto,idcompra,cicantidad)
				VALUES ('".$this->getObjProducto()->getIdproducto()."','".$this->getObjCompra()->getIdCompra()."','".$this->getCiCantidad()."')";
		if($base->Iniciar()){
            $id = $base->Ejecutar($consultaInsertar);
			if($id != null){
			    $resp=  $id;
				$this->setIdCompraItem($id);
			}else{
				$this->setMensajeOperacion("compraitem->insertar: ".$base->getError());
			}
		} else {
				$this->setMensajeOperacion("compraitem->insertar: ".$base->getError());
		}
		return $resp;
	}

    public function modificar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE compraitem SET
        idcompra = " . $this->getObjCompra()->getIdCompra(). ",
        idproducto = " . $this->getObjProducto()->getIdproducto(). ",
        cicantidad = " . $this->getCiCantidad(). "
        WHERE idcompraitem = " . $this->getIdCompraItem();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("compraitem->modificar: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("compraitem->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql = "DELETE FROM compraitem WHERE idcompraitem = ".$this->getIdCompraItem();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("compraitem->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("compraitem->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compraitem ";
        if ($parametro!="") {
            $sql.=' WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $obj= new CompraItem();
                    $objCompra = new Compra();
                    $objCompra->setIdCompra($row['idcompra']);
                    $objCompra->cargar();
                    $objProducto= new Producto();
                    $objProducto->setIdproducto($row['idproducto']);
                    $objProducto->cargar();
                    $obj->setear($row['idcompraitem'],$objProducto, $objCompra,$row['cicantidad']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("compraitem->listar: ".$base->getError());
        }
        return $arreglo;
    }

}
?>