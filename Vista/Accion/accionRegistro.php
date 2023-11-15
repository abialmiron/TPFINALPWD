<?php
include_once("../../configuracion.php");
$data = data_submitted();
if ($_SESSION['objeto']->alta($data)) {
    echo json_encode(array('success'=>1));
} else {
    echo json_encode(array('success'=>0));
}

?>