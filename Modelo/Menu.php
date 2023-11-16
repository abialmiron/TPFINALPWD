<?php
class Menu {
    private $idMenu;
    private $menuNombre;
    private $menuDescripcion;
    private $menuLink;
    private $objMenu;
    private $menuDeshabilitado;
    private $mensajeOperacion;
    

    /**
     * @return mixed
     */
    public function getIdMenu()
    {
        return $this->idMenu;
    }

    /**
     * @param mixed $idMenu
     */
    public function setIdMenu($idMenu)
    {
        $this->idMenu = $idMenu;
    }

    /**
     * @return mixed
     */
    public function getMenuNombre()
    {
        return $this->menuNombre;
    }

    /**
     * @param mixed $menuNombre
     */
    public function setMenuNombre($menuNombre)
    {
        $this->menuNombre = $menuNombre;
    }

    /**
     * @return mixed
     */
    public function getMenuDescripcion()
    {
        return $this->menuDescripcion;
    }

    /**
     * @param mixed $menuDescripcion
     */
    public function setMenuDescripcion($menuDescripcion)
    {
        $this->menuDescripcion = $menuDescripcion;
    }
    
    /**
     * @param mixed
     */
    public function getMenuLink()
    {
        return $this->menuLink;
    }

    /**
     * @param mixed $menulink
     */
    public function setMenuLink($menuLink)
    {
        $this->menuLink = $menuLink;
    }

    /**
     * @return mixed
     */
    public function getObjMenuPadre()
    {
        return $this->objMenuPadre;
    }

    /**
     * @param mixed $ObjMenuPadre
     */
    public function setObjMenuPadre($ObjMenu)
    {
        $this->objMenuPadre = $ObjMenu;
    }

    /**
     * @return mixed
     */
    public function getMenuDeshabilitado()
    {
        return $this->menuDeshabilitado;
    }

    /**
     * @param mixed $menuDeshabilitado
     */
    public function setMenuDeshabilitado($menuDeshabilitado)
    {
        $this->menuDeshabilitado = $menuDeshabilitado;
    }

    /**
     * @return string
     */
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    /**
     * @param string $mensajeOperacion
     */
    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }

	public function __construct(){
		$this->idMenu="";
		$this->menuNombre="" ;
		$this->menuDescripcion="";
		$this->menuLink="";
		$this->menuDeshabilitado = null;
		$this->mensajeOperacion ="";
	}

	public function setear($idMenu, $menuNombre,$menuDescripcion,$menulink,$objMenuPadre,$menuDeshabilitado)    {
		$this->setIdMenu($idMenu);
		$this->setMenuNombre($menuNombre);
		$this->setMenuDescripcion($menuDescripcion);
		$this->setMenuLink($menulink);
		$this->setObjMenuPadre($objMenuPadre);
		$this->setMenuDeshabilitado($menuDeshabilitado);
	}
    
	public function cargar(){
		$resp = false;
		$base=new BaseDatos();
		$sql="SELECT * FROM menu WHERE idmenu = ".$this->getIdMenu();
	//  echo $sql;
		if ($base->Iniciar()) {
				$res = $base->Ejecutar($sql);
				if($res>-1){
						if($res>0){
								$row = $base->Registro();
								$objMenuPadre =null;
								if ($row['idpadre']!=null or $row['idpadre']!='' ){
										$objMenuPadre = new Menu();
										$objMenuPadre->setIdMenu($row['idpadre']);
										$objMenuPadre->cargar();
								}
								$this->setear($row['idmenu'], $row['menombre'],$row['medescripcion'], $row['melink'],$objMenuPadre,$row['medeshabilitado']); 
								
						}
				}
		} else {
				$this->setMensajeOperacion("Menu->cargar: ".$base->getError()[2]);
		}
		return $resp;
	}
	
	public function insertar(){
			$resp = false;
			$base=new BaseDatos();
			$sql="INSERT INTO menu( menombre , medescripcion , melink,  idpadre ,  medeshabilitado)  ";
			$sql.="VALUES('".$this->getMenuNombre()."','".$this->getMenuDescripcion()."','".$this->getMenuLink()."',";
			if ($this->getObjMenu()!= null)
					$sql.=$this->getObjMenu()->getIdMenu().",";
			else
					$sql.="null,";
			if ($this->getMenuDeshabilitado()!=null)
					$sql.= "'".$this->getMenuDeshabilitado()."'";
			else 
					$sql.="null";
			$sql.= ");";
		// echo $sql;
			if ($base->Iniciar()) {
					if ($elid = $base->Ejecutar($sql)) {
							$this->setIdMenu($elid);
							$resp = true;
					} else {
							$this->setMensajeOperacion("Menu->insertar: ".$base->getError()[2]);
					}
			} else {
					$this->setMensajeOperacion("Menu->insertar: ".$base->getError()[2]);
			}
			return $resp;
	}
	
	public function modificar(){
			$resp = false;
			$base=new BaseDatos();
			$sql="UPDATE menu SET menombre='".$this->getMenuNombre()."',medescripcion='".$this->getMenuDescripcion()."',melink='".$this->getMenuLink()."'";
	
			if ($this->getObjMenu()!= null)
					$sql.=",idpadre= ".$this->getObjMenu()->getIdMenu();
				else
					$sql.=",idpadre= null";
				if ($this->getMenuDeshabilitado()!=null)
						$sql.= ",medeshabilitado='".$this->getMenuDeshabilitado()."'";
				else
						$sql.=" ,medeshabilitado=null";
			$sql.= " WHERE idmenu = ".$this->getIdMenu();
			// echo $sql;
			if ($base->Iniciar()) {
					if ($base->Ejecutar($sql)) {
							$resp = true;
							
					} else {
							$this->setMensajeOperacion("Menu->modificar 1: ".$base->getError());
					}
			} else {
					$this->setMensajeOperacion("Menu->modificar 2: ".$base->getError());
			}
			return $resp;
	}
	
	public function eliminar(){
			$resp = false;
			$base=new BaseDatos();
			$sql="DELETE FROM menu WHERE idmenu =".$this->getIdMenu();
			//echo $sql;
			if ($base->Iniciar()) {
					if ($base->Ejecutar($sql)) {
							$resp = true;
					} else {
							$this->setMensajeOperacion("Menu->eliminar: ".$base->getError());
					}
			} else {
					$this->setMensajeOperacion("Menu->eliminar: ".$base->getError());
			}
			return $resp;
	}
	
	public static  function listar($parametro=""){
			$arreglo = array();
			$base=new BaseDatos();
			$sql="SELECT * FROM menu ";
		//   echo $sql;
			if ($parametro!="") {
					$sql.='WHERE '.$parametro;
			}
			$res = $base->Ejecutar($sql);
			if($res>-1){
					if($res>0){
							
							while ($row = $base->Registro()){
									$obj = new Menu();
									$objMenuPadre =null;
									if ($row['idpadre']!=null){
											$objMenuPadre = new Menu();
											$objMenuPadre->setIdMenu($row['idpadre']);
											$objMenuPadre->cargar();
									}
									$obj->setear($row['idmenu'], $row['menombre'],$row['medescripcion'],$row['melink'],$objMenuPadre,$row['medeshabilitado']); 
									array_push($arreglo, $obj);
							}
							
					}
					
			} 
			
			return $arreglo;
	}
	}
?>