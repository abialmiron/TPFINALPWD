<?php
include_once("../../../configuracion.php");
include_once("../../Estructura/head.php");
$objCompra = new AbmCompra();
$listaDeCompras = $objCompra->buscar('idusuario='.$_SESSION['idUsuario']);
$objCompraEstado = new AbmCompraEstado();
$i = 0;
while($objCE<>null || $i < count($listaDeCompras)){
    $objCE = $objCompraEstado->buscar('idcompra='.$compras[$i]->getIdCompra());
    if ($objCE->getCeFechaFin()<>NULL){
        $objCE = NULL; 
        $i =$i+ 1;
    } 
}
$objCompraItem = new AbmCompraItem();
$listaComprasItem = $objCompraItem->buscar('idcompra='.$objCE->getObjCompra()->getIdCompra());
if (count($listaComprasItem) > 0) {
?>
<div class="container mt-5">
        <h1 style="margin-top: 5%;">Ver Carrito</h1>
        <a href='agregar_producto.php' class='btn btn-success btn-sm' style="float: right;margin: 8px;"><i class='bi bi-plus-circle'></i></a></p>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Importe</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listaComprasItem as $item) {
                    $i = 1;
                    echo "<tr>";
                    echo "<td>".$i."</td>";
                    echo "<td>".$item->getObjProducto()->getPronombre()."</td>";
                    echo "<td>".$item->getObjProducto()->getProimporte()."</td>";
                    echo "<td>".$item->getCiCantidad()."</td>";
                    echo "<td><a href='eliminar_usuario.php?id=".$producto->getIdproducto()."' class='btn btn-danger btn-sm'><i class='bi bi-trash3'></i></a></td>";
                    echo "</tr>";
                    $i += 1;
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php } else {
    ?>
        <div class="container p-2">
            <div class="alert alert-info" role="alert">
                No tiene carrito disponible!
            </div>
        </div>
<?php
    }
include_once(ROOT_PATH."Vista/estructura/footer.php");
?>