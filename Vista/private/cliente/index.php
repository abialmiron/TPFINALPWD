<?php
include_once("../../configuracion.php");
if (!$_SESSION['sesion-activa']){
  header("location:".BASE_URL."Vista/public/?error=1");
  exit();
}
include_once("../Estructura/head.php");
if (isset ($_GET['error'])){
    echo '<script language="javascript">alert("'.$GLOBALS['error'][$_GET['error']].'","danger");</script>';
    }

?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Home de la vista privada del cliente</h1>
            </div>
        </div>
    </div>
</main>