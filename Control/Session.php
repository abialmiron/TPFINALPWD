<?php
class Session{
    private $objUsuario;
    private $listaRoles;
    private $mensajeoperacion;
    
    public function __construct(){
        if(session_start()){
            $this->objUsuario=null;
            $this->listaRoles=[];
            $this->mensajeoperacion="";
            return true;
        }
        else
         return false;
    }


    public function getObjUsuario()
    { return $this->objUsuario;}

    public function setObjUsuario($objUsuario)
    {$this->objUsuario = $objUsuario; }

    public function getListaRoles()
    { return $this->listaRoles; }

    public function setListaRoles($listaRoles)
    { $this->listaRoles = $listaRoles;}

    public function getMensajeoperacion()
    {return $this->mensajeoperacion;}

    public function setMensajeoperacion($mensajeoperacion)
    {$this->mensajeoperacion = $mensajeoperacion; }

    
    public function iniciar($usu,$pass){
        $resp=false;
        $abmUsuario=new AbmUsuario();
        $where =['usnombre'=>$usu,'uspass'=>$pass,'usdehabilitado'=>'null'];
        $listaUsuarios=$abmUsuario->buscar($where);
        if(count($listaUsuarios)>0){
            $_SESSION['idusuario']=$listaUsuarios[0]->getIdUsuario();
            $resp=true;
        }  
        else{ $this->cerrar();}
        return $resp;
    }
    

    
    public function validar(){
        $inicia=false;
        if(isset($_SESSION['idusuario']) && $this->activa()){
           $inicia=true;
        }
        return $inicia;
    }


    public function activa(){
        $activa=false;
        if(session_status()===PHP_SESSION_ACTIVE){
            $activa=true;
        }
        return $activa;
    }
    
    public function getUsuario(){
        if($this->validar())
        {  $abmUsuario=new AbmUsuario();
           $where =['usnombre'=>$_SESSION['nombreUsu'],'idusuario'=>$_SESSION['idusuario']];
           $listaUsuarios=$abmUsuario->buscar($where);
        if($listaUsuarios>=1){
            $usuarioLog=$listaUsuarios[0];
            $this->setObjUsuario($listaUsuarios[0]);
        }}
        return $usuarioLog;
    }
    
    public function getRol(){
        if($this->validar())
        { $abmUsuarioRol=new AbmUsuarioRol();
      //  $usuario=$this->getUsuario();
        //$idUsuario=$usuario->getIdUsuario();
        $param['idusuario']=$_SESSION['idusuario'];
        //$param=['idusuario'=>$idUsuario];
        $listaRolesUsu=$abmUsuarioRol->buscar($param);
        if($listaRolesUsu>1){
         $rol=$listaRolesUsu;}
        else{$rol=$listaRolesUsu[0];}
    }
        setListaRoles($rol);
        return $rol; 
    }
    
    public function cerrar(){
        $cerrar=true;
        session_destroy();
        return $cerrar;
    }
}

