<?php
include_once("../../configuracion.php");

include_once("../Estructura/head.php");
$dir = '../../imagenes/';
$productos = new AbmProducto();
$listaProductos = $productos->buscar(null);
if (count($listaProductos) > 0) {
?>

<div class="container mt-4" >
<h1 class="mb-4" style="margin-top:5%;">Nuestros Productos</h1>
        <div class="row">

            <?php
            foreach ($listaProductos as $producto) {
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo $dir.$producto->getProimagen(); ?>" class="card-img-top rounded"  alt="">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $producto->getPronombre(); ?></h5>
                            <p class="card-text"><?php echo $producto->getProdetalle(); ?></p>
                            <p class="card-text">$<?php echo $producto->getProimporte(); ?></p>
                            <button class="btn btn-primary btn-sm" id="sumarCarrito"><i class="bi bi-cart-plus-fill"></i></button>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>
    </div>
    <?php
     } else { 
    ?>
    <div class="container p-2">
            <div class="alert alert-info" role="alert">
                No hay productos cargados!
            </div>
        </div>

<?php
 }
include_once("../estructura/footer.php");
?>