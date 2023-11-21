<?php
include_once('../../configuracion.php');
$sesion = Session::getInstance();
$sesionCerrada=$sesion->destroy();
if($sesionCerrada){
    echo json_encode(array('success'=>1));
}else{
    echo json_encode(array('success'=>0));
}
?>