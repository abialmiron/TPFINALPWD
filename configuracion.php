<?php 
header('Content-Type: text/html; charset=utf-8');
header ("Cache-Control: no-cache, must-revalidate ");

/////////////////////////////
// CONFIGURACION APP//
/////////////////////////////

$directorio = '/PWD2023/MI_GRUPO/tp-final/TPFINALPWD/'; // Escribir el directorio donde se encuentra el proyecto dentro del servidor
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].$directorio);
define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].$directorio);
define('STRUCTURE_PATH', ROOT_PATH.'Vista/Estructura/');
define('CSS_PATH', BASE_URL.'Vista/css/');
define('JS_PATH', BASE_URL.'Vista/js/');
define('IMG_PATH', BASE_URL.'Vista/images/');
define('FONT_PATH', BASE_URL.'Vista/fonts/');
$GLOBALS['error'] = array(
  1 => 'No posee permisos para acceder a esta página.',
  2 => 'No se pudo realizar la acción solicitada.',
  3 => 'Hubo algún error inténte nuevamente más tarde.',
);

$ROOT = ROOT_PATH; // Agrega esta línea para definir la variable $ROOT
include_once(ROOT_PATH.'util/funciones.php');