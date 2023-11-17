<?php
include_once("../../configuracion.php");
$data = data_submitted();
$objCompraItem = new CompraItem();
if ($objCompraItem->baja($data)) {
    echo json_encode(array('success'=>1));
} else {
    echo json_encode(array('success'=>0));
}

?>