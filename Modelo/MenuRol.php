<?php
class MenuRol{
    private $objmenu;
    private $objrol;
    private $mensajeoperacion;
    
    public function __construct(){
        
        $this->objmenu=NULL;
        $this->objrol=NULL;
        $this->mensajeoperacion="";
        
    }
    
    public function setear($objmenu, $objRol){
        
        $this->setObjmenu($objmenu);
        $this->setObjrol($objRol);
    }
    
    // METODOS DE ACCESO GET
    
    public function getObjMenu(){
        return $this->objmenu;
    }
    
    public function getObjrol(){
        return $this->objrol;
    }
    
    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }
    
    // METODOS DE ACCESO SET
    
    public function setObjmenu($valor){
        $this->objmenu = $valor;
    }
    
    public function setObjrol($valor){
        $this->objrol = $valor;
    }
    
    
    public function setMensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM menu WHERE idmenu= ". $this->getObjMenu()->getIdmenu()." AND idrol= ". $this->getObjrol()->getIdrol();
        //echo $sql;
        
        if ($base->Iniciar()) {
            
            $res = $base->Ejecutar($sql);
            
            if($res>-1){
                if($res>0){
                    $objRol = null;
                    $objmenu = null;
                    $row = $base->Registro();
                    
                    if($row['idrol']!=null){
                        $objRol = new Rol();
                        $objRol->setIdrol($row['idrol']);
                        $objRol->cargar();
                    }
                    
                    if ($row['idmenu']!=null){
                        
                        $objmenu = new Menu();
                        $objmenu->setIdmenu($row['idmenu']);
                        $objmenu->cargar();
                    }
                    $this->setear($objmenu, $objRol) ;
                }
            }
        } else {
            $this->setMensajeoperacion("menurol->listar: ".$base->getError());
        }
        return $resp;
    }
    
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="INSERT INTO menurol(idmenu, idrol)VALUES(".$this->getObjMenu()->getIdmenu().",".$this->getObjrol()->getIdrol().");";
        //echo $sql;
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
                
            } else {
                $this->setMensajeoperacion("menurol->insertar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("menurol->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar($param){
        $resp = false;
        $base=new BaseDatos();
        $sql=" UPDATE menurol SET ";
        $sql.=" idrol = ".$param['idrolNuevo'];
        $sql.=" WHERE idmenu =".$this->getObjMenu()->getIdmenu()." AND idrol =".$this->getObjrol()->getIdrol();
        echo $sql;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
                
            } else {
                $this->setMensajeoperacion("menurol->modificar 1: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("menurol->modificar 2: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM menurol WHERE idmenu='". $this->getObjMenu()->getIdmenu()."' AND idrol='".$this->getObjrol()->getIdrol()."'";
        //echo $sql;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeoperacion("menurol->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("menurol->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM menurol INNER JOIN rol ON rol.idrol=menurol.idrol INNER JOIN menu ON menu.idmenu=menurol.idmenu  ";
        //echo $sql;
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        //echo $sql;
        
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    
                    $objmenu =null;
                    $objRol =null;
                    
                    if($row['idrol']!=null){
                        $objRol = new Rol();
                        $objRol->setIdrol($row['idrol']);
                        $objRol->cargar();
                    }
                    
                    if($row['idmenu']!=null){
                        $objmenu = new Menu();
                        $objmenu->setIdmenu($row['idmenu']);
                        $objmenu->cargar();
                    }
                    
                    $obj= new MenuRol();
                    $obj->setear($objmenu, $objRol);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            //     $this->setMensajeoperacion("menurol->listar: ".$base->getError());
        }
        return $arreglo;
    }
}