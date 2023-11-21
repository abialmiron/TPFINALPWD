<?php
include_once("../../configuracion.php");
$datos = data_submitted();
$sesion = Session::getInstance();
    if ($sesion->validar($datos)) {
        $sesion->iniciar($datos);
        $sesion->tienePermiso = true;
        // $sesion->rolActivo = $sesion->getRolActivo();
        echo json_encode(array('success'=>1));
    } else {
        echo json_encode(array('success'=>0));
    }
?>
