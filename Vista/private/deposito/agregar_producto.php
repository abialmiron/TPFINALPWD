<?php
include_once("../../../configuracion.php");
include_once(ROOT_PATH."Vista/Estructura/head.php");
?>

<main class='row justify-content-center align-items-center m-auto'>
<div class="container-fluid">
    <div class="card shadow col-sm-8 col-md-6 col-lg-5 col-xl-4 mx-auto">
        <div class="card-header">
            <h3>Agregar Producto</h3>
        </div>
        <div class="card-body">
            <form method="post" action="../../Accion/accionAgregarProd.php" class="d-flex flex-column needs-validation" novalidate>
                <div class="mb-3">
                    <label>Nombre </label>
                    <input type="text" name="pronombre" id="pronombre" class="form-control text mt-2" required>
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
                    <input type="numeric" class="form-control validate" name="procantstock"  id="procantstock" required>
                    <div class="invalid-feedback">
                        Ingrese una cantidad de stock.
                    </div>
                </div>
                <div class="mb-3">
                    <label>Importe </label>
                    <input type="numeric" id="proimporte" class="form-control validate" required>
                    <div class="invalid-feedback">
                        Ingrese un importe.
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
include_once(ROOT_PATH."Vista/estructura/footer.php");
?>