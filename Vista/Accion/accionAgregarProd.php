<?php
include_once("../../configuracion.php");
$data = data_submitted();
$dir = ROOT_PATH.'imagenes/';

if ($_FILES["proimagen"]["error"] <= 0) {

   
    $archivo = new Archivo($_FILES['proimagen']["tmp_name"],$_FILES['proimagen']["name"],$_FILES['proimagen']["type"],$_FILES['proimagen']["size"]);
    $archivo->subirImagen();
    if ($archivo->getError() <> NULL){
        echo $archivo->getError();
    } else {
        $data['proimagen'] = $archivo->getName();
        $objProducto = new AbmProducto();
        if ($objProducto->alta($data)) {
            echo json_encode(array('success'=>1));
        } else {
            echo json_encode(array('success'=>0));
        }
    }
}else{
    echo "ERROR: no se pudo cargar el archivo. No se pudo acceder al archivo Temporal";
}

?>