<?php
include_once("../../configuracion.php");
$data = data_submitted();
$objProducto = new AbmProducto();
if ($objProducto->alta($data)) {
    echo json_encode(array('success'=>1));
} else {
    echo json_encode(array('success'=>0));
}
?>