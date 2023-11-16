<?php
class Session{
    private $objUsuario;
    private $listaRoles;
    private $mensajeoperacion;
    
    public function __construct(){
		$resp = session_start();
        if($resp){
            $this->objUsuario = null;
            $this->listaRoles=[];
            $this->mensajeoperacion="";
        }
		return $resp;
    }


	public function getObjUsuario()
	{ return $this->objUsuario;}

	public function setObjUsuario($objUsuario)
	{$this->objUsuario = $objUsuario; }

	public function getListaRoles(){
		return $this->listaRoles; 
	}

	public function setListaRoles($listaRoles){
		foreach($listaRoles as $rol){
			array_push($this->listaRoles,$rol);
		} 
	}

	public function getMensajeoperacion()
	{return $this->mensajeoperacion;}

	public function setMensajeoperacion($mensajeoperacion)
	{$this->mensajeoperacion = $mensajeoperacion; }

	private function iniciar($objUsuario){
		$this->setObjUsuario($objUsuario);
		$param = ["idusuario"=>$objUsuario->getIdUsuario()];
		$objRol = new AbmRol();
		$objUsuarioRol = new AbmUsuarioRol();
		$listaRoles = [];
		$_SESSION["nombreUsuario"] = $objUsuario->getUsNombre();
		$_SESSION['idUsuario'] = $objUsuario->getIdUsuario();
		$listaUsuarioRol = $objUsuarioRol->buscar($param);
		foreach($listaUsuarioRol as $usuarioRol){
			array_push($listaRoles,$usuarioRol->getObjRol());
		}
		$this->setListaRoles($listaRoles);
		$_SESSION["roles"] = $this->getListaRoles();
		$_SESSION["rol-activo"] = $listaRoles[0];
	}
    
	public function validar($param){
		$objAbmUsuario = new AbmUsuario();
		$objUsuario = $objAbmUsuario->buscar($param)[0];
        $resp = false;
        if($objUsuario != null){
            if($param["password"] == $objUsuario->getUsPass()){
                $this->iniciar($objUsuario);
                $resp = true;
            }
        }
        return $resp;
	}

	public function activa(){
		return (isset($_SESSION['idUsuario']) && session_status()===PHP_SESSION_ACTIVE);
	}
    
	public function getUsuario(){
		if($this->validar())
		{  $abmUsuario=new AbmUsuario();
				$where =['usnombre'=>$_SESSION['nombreUsu'],'idusuario'=>$_SESSION['idUsuario']];
				$listaUsuarios=$abmUsuario->buscar($where);
		if($listaUsuarios>=1){
				$usuarioLog=$listaUsuarios[0];
				$this->setObjUsuario($listaUsuarios[0]);
		}}
		return $usuarioLog;
	}
	
	public function getIdRoles(){
		if($this->getObjUsuario() != null){
			$objUsuarioRol = new AbmUsuarioRol();
			$param["idusuario"] = $this->getObjUsuario()->getIdUsuario();
			$arrayRolesUsuario = $objUsuarioRol->buscar($param);
			$arrayRol = [];
			$idRoles=[];
			foreach($arrayRolesUsuario as $usuarioRol){
				array_push($idRoles,$usuarioRol->getObjRol()->getIdRol());
			}
		}
	return $idRoles;
	}
	
	public function cerrar(){
		$cerrar=true;
		session_destroy();
		return $cerrar;
	}
}

