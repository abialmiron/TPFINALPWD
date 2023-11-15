<?php
include_once('../../configuracion.php');

$sesionCerrada=$_SESSION['objeto']->cerrar();
if($sesionCerrada){
    echo json_encode(array('success'=>1));
}else{
    echo json_encode(array('success'=>0));
}
?>