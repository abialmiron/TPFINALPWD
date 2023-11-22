<?php
include_once("../../configuracion.php");
include_once("../Estructura/head.php");
?>
<main>
    <div class="paravideo parallax">
        <video autoplay muted loop>
            <source src="../images/nursery_-_567-converted.mp4" type="video/mp4">
        </video>
        <div class="logo-animado">
            <?php include_once("../images/logotipo_animacion.svg"); ?>
        </div>
    </div>
    <div class="col-12">
        <div class="paracontent">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>AQUÍ UN CAROUSEL CON PRODUCTOS AL AZAR</h1>
                        <h1>AQUÍ CATEGORÍAS</h1>
                        <h1>AQUÍ CONTACTO</h1>
                        <?php
                        //verEstructura(obtenerItemsMenu(2));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include_once("../estructura/footer.php");

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
                location.href = base_url+"Vista/public/index.php";
            }, 1500);
        </script>
    <?php
    }
    ?>