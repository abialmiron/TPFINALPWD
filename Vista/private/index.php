<?php
include_once("../../configuracion.php");
include_once("../Estructura/head.php");
if (isset ($_GET['error'])){
    echo '<script language="javascript">alert("'.$GLOBALS['error'][$_GET['error']].'","danger");</script>';
    }
?>
<main>
<div class="container text-center">
  <div class="row align-items-center">
        <div class="col text-start w-75 py-5 my-5"><h1><?php echo $sesion->getNombreUsuario().' | '.$sesion->getRolActivo()->getRolDescripcion();?></h1></div>
        <div class="col-4">
            <div class="logo-animado">
                <?php include_once("../images/logotipo_animacion.svg"); ?>
            </div>
        </div>
        <div class="col"></div>
    </div>    
    </div>    
            
</main>

<?php
include_once(ROOT_PATH."Vista/estructura/footer.php");
?>