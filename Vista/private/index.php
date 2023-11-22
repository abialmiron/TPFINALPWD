<?php
include_once("../../configuracion.php");
include_once("../Estructura/head.php");
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

if (isset ($_GET['error'])){
    ?>
        <script language="javascript">
            Swal.fire({
                icon: "success",
                title: "<?php echo $GLOBALS['error'][$_GET['error']];?>",
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout(function () {
                location.href = base_url+"Vista/private/index.php";
            }, 1500);
        </script>
    <?php
    }
    ?>