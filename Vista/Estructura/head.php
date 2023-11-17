<?php
$sesionActiva = $_SESSION['sesion-activa'];
$MenuRol = new AbmMenuRol();
if (isset($_SESSION['rol-activo'])){
  $listaMenuRol = $MenuRol->buscar(["idrol"=>$_SESSION['rol-activo']->getIdRol()]);
  $url = $_SERVER["REQUEST_URI"];
  $permiso = false;
  foreach($listaMenuRol as $itemMenuRol){
    if(strstr($_SERVER["REQUEST_URI"],$itemMenuRol->getObjMenu()->getMenuLink())!=false || strstr($_SERVER["REQUEST_URI"],"private/index.php")!=false || strstr($_SERVER["REQUEST_URI"],"private/perfil.php")!=false){
        $permiso = true;
      }
  }
  if(!$permiso ){
    header("location:".BASE_URL."Vista/private/index.php?error=1");
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

  
