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

    
	private function iniciar($nombreUsuario, $arrayRoles){
		$_SESSION["nombreUsuario"] = $nombreUsuario;
		$_SESSION["roles"] = $arrayRoles;
		$objRol = new AbmRol();
		$param = [2];
		$_SESSION["rol-activo"] = $objRol->obtenerObj($param)[0];
}
    
	public function validar($param){
		$arrayUsuario = $this->getObjUsuario()->buscar($param);
        $resp = false;
        if($arrayUsuario != null){
            if($param["password"] == $arrayUsuario[0]->getUsPass()){
                $this->setObjUsuario($arrayUsuario[0]);
                $idRoles = $this->getRol();
                $this->iniciar($param["nombreUsuario"], $idRoles);
                $resp = true;
            }
        }
        return $resp;
	}

	public function activa(){
		return (isset($_SESSION['idusuario']) && session_status()===PHP_SESSION_ACTIVE);
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

