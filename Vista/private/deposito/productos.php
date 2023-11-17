<?php
include_once("../../../configuracion.php");
include_once("../../Estructura/head.php");
$objProductos = new AbmProducto();
$listaProductos = $objProductos->buscar(null);
if (count($listaProductos) > 0) {
?>
<div class="container mt-5">
        <h1 style="margin-top: 5%;">Gestión de Productos</h1>
        <a href='agregar_producto.php' class='btn btn-success btn-sm' style="float: right;margin: 8px;"><i class='bi bi-plus-circle'></i></a></p>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Importe</th>
                    <th scope="col">Stock</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listaProductos as $producto) {
                    echo "<tr>";
                    echo "<td>".$producto->getPronombre()."</td>";
                    echo "<td>".$producto->getProdetalle()."</td>";
                    echo "<td>".$producto->getProimporte()."</td>";
                    echo "<td>".$producto->getProcantstock()."</td>";
                    echo "<td><a href='actualizar_producto.php?id=".$producto->getIdproducto()."' class='btn btn-primary btn-sm'><i class='bi bi-pencil-square'></i></a></td>";
                    echo "<td><a href='eliminar_producto.php?id=".$producto->getIdproducto()."' class='btn btn-danger btn-sm'><i class='bi bi-trash3'></i></a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php } else {
    ?>
        <div class="container p-2">
            <div class="alert alert-info" role="alert">
                No hay productos cargados!
            </div>
        </div>
<?php
    }
include_once(ROOT_PATH."Vista/estructura/footer.php");
?>