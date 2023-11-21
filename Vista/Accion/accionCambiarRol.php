<?php
include_once("../../configuracion.php");
$sesion = Session::getInstance();
$datos = data_submitted();
$objRol = new AbmRol();
$objRolActivo = $objRol->buscar($datos);
// verEstructura($objRolActivo);
if(count($objRolActivo) > 0){
    $sesion->setRolActivo ($objRolActivo[0]);
    echo json_encode(array('success'=>1));
}else{
    echo json_encode(array('success'=>0));
}
?>