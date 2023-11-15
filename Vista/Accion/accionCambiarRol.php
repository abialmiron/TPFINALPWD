<?php
include_once("../../configuracion.php");

$datos = data_submitted();
$objRol = new AbmRol();
$objRolActivo = $objRol->buscar($datos);
if(count($objRolActivo) > 0){
    $_SESSION["rol-activo"] = $objRolActivo[0];
    echo json_encode(array('success'=>1));
}else{
    echo json_encode(array('success'=>0));
}
?>