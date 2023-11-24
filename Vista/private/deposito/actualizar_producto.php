<?php
include_once("../../../configuracion.php");
include_once("../../Estructura/head.php");
$datos = data_submitted();
$objProducto = new AbmProducto();
$objProducto->buscar('idproducto='.$datos['id']);
if($objProducto<>NULL){
?>
<main class='row justify-content-center align-items-center m-auto'>
<div class="container-fluid">
    <div class="card shadow col-sm-8 col-md-6 col-lg-5 col-xl-4 mx-auto">
        <div class="card-header">
            <h3>Modificar Producto</h3>
        </div>
        <div class="card-body">
            <form method="post" action="../../Accion/accionModProd.php" enctype="multipart/form-data" class="d-flex flex-column needs-validation" novalidate>
                <div class="mb-3">
                    <label>Nombre </label>
                    <input type="text" name="pronombre" id="pronombre"  class="form-control text mt-2" required>
                    <div class="invalid-feedback">
                        Ingrese un nombre válido. 
                        -No se aceptan números.
                        -Su longitud debe ser mayor a 3.
                    </div>
                </div>
                <div class="mb-3">
                    <label>Detalle </label>
                    <input type="text" name="prodetalle" id="prodetalle" class="form-control text mt-2" required>
                    <div class="invalid-feedback">
                        Ingrese una descripción.
                    </div>
                </div>
                <div class="mb-3">
                    <label>Stock </label>
                    <input type="numeric" class="form-control validate" name="procantstock"  id="procantstock"  required>
                    <div class="invalid-feedback">
                        Ingrese una cantidad de stock.
                    </div>
                </div>
                <div class="mb-3">
                    <label>Importe </label>
                    <input type="numeric" name="proimporte" id="proimporte" class="form-control validate" required>
                    <div class="invalid-feedback">
                        Ingrese un importe.
                    </div>
                </div>
                <div class="mb-3">
                    <label>Imagen </label>
                    <input type="file" name="proimagen" id="proimagen" class="form-control validate" required>
                    <div class="invalid-feedback">
                        Ingrese una imagen.
                    </div>
                </div>
                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" name="enviar" id="enviar" value="Enviar">
                </div>
                <p class="m-2 align-self-end"><a href="productos.php">Volver</a></p>
            </form>
            </div> 
            
    </div>
</div>
</main>

<?php
} else {
    ?>
    <div class="container p-2">
        <div class="alert alert-info" role="alert">
            No se encontró el producto solicitado!
        </div>
    </div>
 <?php
}
include_once(ROOT_PATH."Vista/estructura/footer.php");
?>
<script src="<?php echo BASE_URL ?>Vista/js/modProducto.js"></script>