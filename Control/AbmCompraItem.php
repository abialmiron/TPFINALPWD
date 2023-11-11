<?php
class AbmCompraItem{
     /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object
     */
    private function cargarObjeto($param){
        $obj = null;
        if (array_key_exists('idcompraitem', $param) and 
            array_key_exists('idproducto', $param) and
            array_key_exists('idcompra', $param) and 
            array_key_exists('cicantidad', $param)) {
            $objProducto = new Producto();
            $objProducto->setear($param['idproducto'],null,null,null,null,null);
            $objProducto->cargar();
            $objCompra = new Compra();
            $objCompra->setear($param['idcompra'],null,null,null);
            $objCompra->cargar();
            $obj = new CompraItem();
            $obj->setear($param['idcompraitem'], $objProducto, $objCompra, $param['cicantidad']);
        }
        return $obj;
    }

     /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return object
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idcompraitem']) ){
            $obj = new CompraItem();
            $obj->setear($param['idcompraitem'], null,null,null);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto,
     * aunque en este caso no espera un ID. Puede ser utilizado para inserción.
     * @param array $param
     * @return object
     */
    private function cargarObjetoSinID($param){
        $obj = null;
        if (
            array_key_exists('idproducto', $param) and
            array_key_exists('idcompra', $param) and 
            array_key_exists('cicantidad', $param)
        ) {
            $objProducto = new Producto();
            $objProducto->setear($param['idproducto'],null,null,null,null,null);
            $objProducto->cargar();
            $objCompra = new Compra();
            $objCompra->setear($param['idcompra'],null,null,null);
            $objCompra->cargar();
            $obj = new CompraItem();
            $obj->setear(null, $objProducto, $objCompra, $param['cicantidad']);
        }
        return $obj;
    }

     /**
     * Corrobora que dentro del arreglo asociativo se encuentren los campos claves
     * @param array $param
     * @return boolean
     */
    
     private function seteadosCamposClaves($param){
        
        $resp = false;
        if (isset($param['idcompraitem'])){
            $resp = true;
        } 
        return $resp;
    }

    /**
     * Realizamos la inserción de un registro
     * @param array $param
     */
    public function alta($param){
        
        $resp = false;
        $objCompraItem = new CompraItem();
        $objCompraItem = $this->cargarObjetoSinID($param);

        if ($objCompraItem!=null && $objCompraItem->insertar()){
            $resp = true;
        }
        
        return $resp;
    }

        /**
     * Realiza la eliminación de una compra.
     * @param array $param
     * @return boolean
     */
    
     public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objCompraItem = $this->cargarObjetoConClave($param);
            if ($objCompraItem !=null && $objCompraItem->eliminar()){  
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Realiza la modificación de un objeto.
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objCompraItem = $this->cargarObjeto($param);
            if($objCompraItem !=null && $objCompraItem->modificar()){
                $resp = true;
                
            }
        }
        return $resp;
    }

     /**
     * Realiza la busqueda de un objeto
     * @param array $param
     * @return boolean
     */
    
     public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idcompraitem']))
            $where.=" and idcompraitem='".$param['idcompraitem']."'";
            if  (isset($param['idproducto']))
            $where.=" and idproducto ='".$param['idproducto']."'";
            if  (isset($param['idcompra']))
            $where.=" and idcompra ='".$param['idcompra']."'";
            if  (isset($param['cicantidad']))
            $where.=" and cicantidad ='".$param['cicantidad']."'";
        }
        
        $arreglo = CompraItem::listar($where);
        
        return $arreglo;
    }
}



?>