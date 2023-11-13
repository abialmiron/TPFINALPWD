<?php
class Session{
    private $objUsuario;
    private $listaRoles;
    private $mensajeoperacion;
    
    public function __construct(){
		$resp = session_start();
        if($resp){
            $this->setObjUsuario(new AbmUsuario());
            $this->listaRoles=[];
            $this->mensajeoperacion="";
        }
         
		return $resp;
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
		$_SESSION['idUsuario'] = $this->getObjUsuario()->getIdUsuario();
		$objRol = new AbmRol();
		$param['idrol'] = $arrayRoles[0];
		$_SESSION["rol-activo"] = $objRol->buscar($param)[0];
	}
    
	public function validar($param){
		$arrayUsuario = $this->getObjUsuario()->buscar($param);
        $resp = false;
        if($arrayUsuario != null){
            if($param["password"] == $arrayUsuario[0]->getUsPass()){
                $this->setObjUsuario($arrayUsuario[0]);
                $idRoles = $this->getIdRoles();
                $this->iniciar($param["nombreUsuario"], $idRoles);
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
			$param["idUsuario"] = $this->getObjUsuario()->getIdUsuario();
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

