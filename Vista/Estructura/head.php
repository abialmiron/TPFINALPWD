<?php
$sesion = Session::getInstance();
$sesionActiva = $sesion->getRolActivo()!==null;
$listaMenu = [];
verEstructura($sesion);
verEstructura($sesionActiva);
if ($sesionActiva){
  $listaMenu = $sesion->getListaMenu();
  // $permiso = false;
//   foreach($listaMenu as $itemMenu){
//     if(strstr($_SERVER["REQUEST_URI"],$itemMenu->getMenuLink())!=false){ 
//       $permiso = true;
//       verEstructura($itemMenu->getMenuLink());
//       }
//   }
//   if(!$sesion->tienePermiso){
//     header("location:".BASE_URL."Vista/private/index.php?error=1");
//   }
  $tienePermiso = $sesion->tienePermiso($_SERVER["REQUEST_URI"]);
  echo'tiene permiso :';
  verEstructura($tienePermiso);
  if(!$tienePermiso){
    header("location:".BASE_URL."Vista/private/index.php?error=1");
    verEstructura($tienePermiso);
  }
} else if (strstr($_SERVER["REQUEST_URI"],"private")!=false){
  header("location:".BASE_URL."Vista/public/index.php?error=1");
}
?>


<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#000000">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toys-Sonrisas de bebé</title>
    <?php 
    include_once ("links.php");
    ?>
    <body class="">
      <header class="">
        <?php
          include_once 'menu.php';
          ?>
      </header>

  
