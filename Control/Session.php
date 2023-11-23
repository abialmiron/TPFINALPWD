<?php

/*
    Use the static method getInstance to get the object.
    Usar el método estático getInstance para obtener el objeto.
*/

class Session
{
    const SESSION_STARTED = TRUE;
    const SESSION_NOT_STARTED = FALSE;
    
    // El estado de la sesión
    private $sessionState = self::SESSION_NOT_STARTED;
    
		// La única instancia de la clase
    private static $instance;
    
    
    private function __construct() {}
    
    
    /**
		*		Devuelve la instancia de 'Session'.
		*		La sesión se inicializa automáticamente si no lo estaba.
    *    
    *    @return    object
    **/
    
    public static function getInstance()
    {
        if ( !isset(self::$instance))
        {
            self::$instance = new self;
        }
        
        self::$instance->startSession();
        
        return self::$instance;
    }
    
    
    /**
		*		(Re)inicia la sesión.
    *    
    *    @return    bool    TRUE si la sesión ha sido inicializada, FALSE si no.
    **/
    
    public function startSession()
    {
        if ( $this->sessionState == self::SESSION_NOT_STARTED )
        {
            $this->sessionState = session_start();
        }
        
        return $this->sessionState;
    }
    
    
    /**
		*		Almacena datos en la sesión.
		*		Ejemplo: $instance->foo = 'bar';    
    *   @param    name    Nombre de los datos.	
    *   @param    value   Los datos.
    *   @return    void
    **/
    
    public function __set( $name , $value )
    {
        $_SESSION[$name] = $value;
    }
    
    
    /**
		*		Obtiene datos de la sesión.
		*		Ejemplo: echo $instance->foo;
    *    
    *		@param    name    Name of the datas to get.
    *   @return    mixed    Datas stored in session.
    **/
    
    public function __get( $name )
    {
        if ( isset($_SESSION[$name]))
        {
            return $_SESSION[$name];
        }
    }
    
    
    public function __isset( $name )
    {
        return isset($_SESSION[$name]);
    }
    
    
    public function __unset( $name )
    {
        unset( $_SESSION[$name] );
    }
    
	
    
    /**
		*		Destruye la sesión actual.
    *    
		*		@return    bool    TRUE si la sesión ha sido destruida, FALSE si no.
    **/
    
    public function destroy()
    {
        if ( $this->sessionState == self::SESSION_STARTED )
        {
            $this->sessionState = !session_destroy();
            unset( $_SESSION );
            
            return !$this->sessionState;
        }
        
        return FALSE;
    }

		// Funciones de sesión

		/**
		 * Devuelve el objeto usuario de la sesión
		 * @return object
		 */
		
		public function getObjUsuario()
		{ if(!isset($_SESSION["objUsuario"])){
			$_SESSION["objUsuario"] = null;
		}
		return $_SESSION["objUsuario"]; }

		/**
		 * Setea el objeto usuario de la sesión
		 * @param object $objUsuario
		 */
		public function setObjUsuario($objUsuario)
		{$_SESSION['objUsuario'] = $objUsuario; }

		/**
		 * Devuelve el id del usuario de la sesión
		 * @return object
		 */
		public function getIdUsuario(){
			if(!isset($_SESSION["idUsuario"])){
				$_SESSION["idUsuario"] = null;
			}
			return $_SESSION["idUsuario"]; 
		}

		/**
		 * Setea el id del usuario de la sesión
		 * @param object $idUsuario
		 */
		public function setIdUsuario($idUsuario){
			$_SESSION['idUsuario'] = $idUsuario; 
		}

		/**
		 * Devuelve el nombre del usuario de la sesión
		 * @return object
		 */
		public function getNombreUsuario(){
			if(!isset($_SESSION["nombreUsuario"])){
				$_SESSION["nombreUsuario"] = null;
			}
			return $_SESSION["nombreUsuario"]; 
		}

		/**
		 * Setea el nombre del usuario de la sesión
		 * @param object $nombreUsuario
		 */
		public function setNombreUsuario($nombreUsuario){
			$_SESSION['nombreUsuario'] = $nombreUsuario; 
		}
		
		/**
		 * Devuelve la lista de roles de la sesión
		 * @return object
		 */
		public function getListaRoles(){
			if(!isset($_SESSION["listaRoles"])){
				$_SESSION["listaRoles"] = [];
			}
			return $_SESSION["listaRoles"]; 
		}

		/**
		 * Setea la lista de roles de la sesión
		 * @param object $listaRoles
		 */
		public function setListaRoles($listaRoles){
			$_SESSION['listaRoles'] = $listaRoles;
		}

		/**
		 * Devuelve el rol activo de la sesión
		 * @return object
		 */
		public function getRolActivo(){
			if(!isset($_SESSION["rolActivo"])){
				$_SESSION["rolActivo"] = null;
			}
			return $_SESSION["rolActivo"]; 
		}

		/**
		 * Setea el rol activo de la sesión
		 * @param object $rolActivo
		 */
		public function setRolActivo($rolActivo){
			$_SESSION['rolActivo'] = $rolActivo; 
		}

		/**
		 * Devuelve la lista de menú de la sesión
		 * @return object
		 */
		public function getListaMenu(){
			if(!isset($_SESSION["listaMenu"])){
				$_SESSION["listaMenu"] = [];
			}
			return $_SESSION["listaMenu"]; 
		}

		/**
		 * Setea la lista de menú de la sesión
		 * @param object $listaMenu
		 */
		public function setListaMenu($rolActivo){
			$listaMenu = $this->construirMenu($rolActivo);
			$_SESSION['listaMenu'] = $listaMenu; 
		}


		/**
		 * Devuelve true si coincide el usuario y la contraseña con la base de datos
		 * @param array $param
		 * @return boolean
		 */
		public function validar ($param){
			$objAbmUsuario = new AbmUsuario();
			$objUsuario = $objAbmUsuario->buscar($param)[0];
			$resp = false;
			if($objUsuario != null){
					if($param["password"] == $objUsuario->getUsPass()){
							$resp = true;
							session_regenerate_id();
					}
			}
			return $resp;
		}

		/**
		 * Inicia la sesión con el usuario que se le pasa por parámetro
		 * @param array $param
		 */
		public function iniciar($param){
			$objAbmUsuario = new AbmUsuario();
			$objUsuario = $objAbmUsuario->buscar($param)[0];
			$this->setObjUsuario($objUsuario);
			$this->setIdUsuario($objUsuario->getIdUsuario());
			$param = ["idusuario"=>$this->getIdUsuario()];
			$objUsuarioRol = new AbmUsuarioRol();
			$listaUsuarioRol = $objUsuarioRol->buscar($param);
			$listaRoles = [];
			foreach($listaUsuarioRol as $usuarioRol){
				array_push($listaRoles,$usuarioRol->getObjRol());
			}
			$this->setNombreUsuario($objUsuario->getUsNombre());
			$this->setListaRoles($listaRoles);
			$this->setRolActivo($listaRoles[0]);
			$this->setListaMenu($this->getRolActivo());
		}

		/**
		 * Cambia el rol activo de la sesión
		 * @param int $idRol
		 */
		public function cambiarRol($idRol){
			$listaRoles = $_SESSION["listaRoles"];
			foreach($listaRoles as $rol){
					if($rol->getIdRol() == $idRol){
							$_SESSION["rolActivo"] = $rol;
							$this->setListaMenu($this->construirMenu($this->getRolActivo()));
					}
			}
		}

		/**
		 * Devueve el estado de la sesión
		 * @return boolean
		 */
		public function sesionActiva(){
			if(!isset($_SESSION['sesionActiva'])){
					$_SESSION['sesionActiva'] = isset($_SESSION['idUsuario']) && session_status()===PHP_SESSION_ACTIVE;
			}   
			return $_SESSION['sesionActiva'];
		}

		
		function construirMenu($rolActivo){
			$objMenuRol = new AbmMenuRol();
			$listaMenuRol = $objMenuRol->buscar(['idrol'=>$rolActivo->getIdRol()]);
			$listaMenu = [];
			foreach ($listaMenuRol as $menuRol){
					$listaMenu[] = $menuRol->getObjMenu();
			}
			$listaMenu = array_unique($listaMenu,SORT_REGULAR);
			return $listaMenu;
		}
		
		
		/**
		 * Devuelve verdadero si el rol activo tiene permiso para acceder a la url
		 * @param string $url
		 * @return boolean
		 */
		function tienePermiso($url){
			$tienePermiso = false;
			$listaMenu = $this->getListaMenu();
			foreach($listaMenu as $itemMenu){
				if(strstr($url,$itemMenu->getMenuLink())!=false){ 
					$tienePermiso = true;
				}
			}
			return $tienePermiso;
		}
	}
		

/*
class Session{
    private $objUsuario;
    private $listaRoles;
    private $mensajeoperacion;
    
    public function __construct(){
		// $resp = session_start();
    
			if(!self::sesionActiva()){
				session_start();
			} 
		
			// if($resp){
							$this->objUsuario = null;
							$this->listaRoles=[];
							$this->mensajeoperacion="";
			// 		}
			// return $resp;
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

	public function cambiarRol($idRol){
		$listaRoles = $_SESSION["roles"];
		foreach($listaRoles as $rol){
			if($rol->getIdRol() == $idRol){
				$_SESSION["rol-activo"] = $rol;
			}
		}
	}

	// Funciones de sesión
function sesionActiva(){
	if(!isset($_SESSION['sesion-activa'])){
			$_SESSION['sesion-activa'] = isset($_SESSION['idUsuario']) && session_status()===PHP_SESSION_ACTIVE;
	}   
	return $_SESSION['sesion-activa'];
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
	
	public function tienePermiso($idPermiso){
		$tienePermiso = false;
		if($this->getObjUsuario() != null){
			$objRolPermiso = new AbmRolPermiso();
			$param["idrol"] = $this->getIdRoles();
			$arrayRoles = $objRolPermiso->buscar($param);
			foreach($arrayRoles as $rolPermiso){
				if($rolPermiso->getObjPermiso()->getIdPermiso() == $idPermiso){
					$tienePermiso = true;
				}
			}
		}
		return $tienePermiso;
	}

	// Funciones para el menu
function construirMenu($rolActivo){
	$objMenuRol = new AbmMenuRol();
	$listaMenuRol = $objMenuRol->buscar(['idrol'=>$rolActivo->getIdRol()]);
	$listaMenu = [];
	foreach ($listaMenuRol as $menuRol){
			$listaMenu[] = $menuRol->getObjMenu();
	}
	$listaMenu = array_unique($listaMenu,SORT_REGULAR);
	return $listaMenu;
}

	public function cerrar(){
		session_unset();
		return session_destroy();
	}
}

*/