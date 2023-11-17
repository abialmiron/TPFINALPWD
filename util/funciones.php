<?php 
function data_submitted() {
    $_AAux= array();
    if (!empty($_POST))
        $_AAux =$_POST;
        else
            if(!empty($_GET)) {
                $_AAux =$_GET;
            }
        if (count($_AAux)){
            foreach ($_AAux as $indice => $valor) {
                if ($valor=="")
                    $_AAux[$indice] = 'null' ;
            }
        }
        return $_AAux;
        
}
function verEstructura($e){
    echo "<pre>";
    print_r($e);
    echo "</pre>"; 
}


// autoload para version 8.0
spl_autoload_register(function($class_name) {
    $directorys = array(
        $GLOBALS['ROOT'].'Modelo/',
        $GLOBALS['ROOT'].'Modelo/conector/',
        $GLOBALS['ROOT'].'Control/',
        $GLOBALS['ROOT'].'util/',
        $GLOBALS['ROOT'].'Test/',
    );
    //print_object($directorys) ;
    foreach($directorys as $directory){
        if(file_exists($directory.$class_name . '.php')){
            //  echo "se incluyo".$directory.$class_name . '.php';
            require_once($directory.$class_name . '.php');
            return;
        }
    }
}
);

// Funciones para el menu
function construirMenu($rolActivo){
    $objMenuRol = new AbmMenuRol();
    $listaMenuRol = $objMenuRol->buscar(['idrol'=>$rolActivo->getIdRol()]);
    $listaMenu = [];
    foreach ($listaMenuRol as $menuRol){
        $listaMenu[] = $menuRol->getObjMenu();
    }
    $listaMenu = array_unique($listaMenu,SORT_REGULAR);
    return $listaMenu;
}

// Funciones de sesión
function sesionActiva(){
    if(!isset($_SESSION['sesion-activa'])){
        $_SESSION['objeto'] = new Session();
        $_SESSION['sesion-activa'] = $_SESSION['objeto']->activa();
    }   
    return $_SESSION['sesion-activa'];
}

?>