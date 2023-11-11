<?php
class AbmCompra{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto

     /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object
     */
    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('idcompra',$param) && array_key_exists('cofecha',$param) && array_key_exists('idusuario',$param)){
            $obj = new Compra();
            $objUsuario = new Usuario();
            $objUsuario->setIdUsuario($param['idusuario']);
            $objUsuario->cargar();
            $obj->setear($param['idcompra'], $param['cofecha'],$objUsuario); 
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
            array_key_exists('cofecha', $param) &&
            array_key_exists('idusuario', $param)
        ) {
            $objusuario = new Usuario();
            $objusuario->setIdUsuario($param['idusuario']);
            $objusuario->cargar();

            $obj = new Compra();
            $obj->setCoFecha($param['cofecha']); 
            $obj->setObjUsuario($objusuario);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con el ID del OBJ compra.
     * Se utiliza para cargar un OBJ a partir de un ID.
     * @param array $param
     * @return object
     */
    private function cargarObjetoSoloID($param){
        $obj = null;
        if (isset($param['idcompra'])) {
            $obj = new Compra();
            $obj->cargar($param['idcompra']);
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
        if (isset($param['idcompra'])){
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
        $objCompra = new Compra();
        $objCompra = $this->cargarObjetoSinID($param);

        if ($objCompra!=null && $objCompra->insertar()){
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
            $objCompra = $this->cargarObjetoConClave($param);
            if ($objCompra !=null && $objCompra->eliminar()){  
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
            $objCompra = $this->cargarObjeto($param);
            if($objCompra !=null && $objCompra->modificar()){
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
            if  (isset($param['idcompra']))
            $where.=" and idcompra='".$param['idcompra']."'";
            if  (isset($param['cofecha']))
            $where.=" and cofecha ='".$param['cofecha']."'";
            if  (isset($param['idusuario']))
            $where.=" and idusuario ='".$param['idusuario']."'";
        }
        
        $arreglo = Compra::listar($where);
        
        return $arreglo;
    }

}
?>
