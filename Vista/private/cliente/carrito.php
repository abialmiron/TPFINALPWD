<?php
// include_once("../../../configuracion.php");
// include_once(ROOT_PATH."Vista/Estructura/head.php");
// ?>
<!-- // <main>
//     <div class="container">
//         <div class="row">
//             <div class="col-12">
//                 <h1>Vista del carrito del cliente</h1>
//             </div>
//         </div>
//     </div>
// </main> -->
<?php
// include_once(ROOT_PATH."Vista/estructura/footer.php");







include_once("../../../configuracion.php");
include_once("../../Estructura/head.php");
$objAbmMenu = new AbmMenu();
$listaMenu = $objAbmMenu->buscar(null);
$objMenuRol = new AbmMenuRol();
$listaMenuRoles = $objMenuRol->buscar(null);
$objAbmCompraItem = new AbmCompraItem();
$listaCompraItem = $objAbmCompraItem->buscar(null);
$objAbmProducto = new AbmProducto();
$listaMenuRoles = $objMenuRol->buscar(null);
if (count($listaMenu) > 0) {
?>
<main class="py-5 my-5">
<div class="container text-center">
  <div class="row align-items-center">
    <div class="col text-start">
        <h1>Carrito</h1>
    </div>
    <!-- <div class="col text-end">
        <a href='' class='btn btn-success btn-sm'><i class='bi bi-plus-circle'></i></a></p>
    </div> -->
        <table class="table table-striped table-bordered">
            <thead class="table-borderer table-primary">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Stock</th>
                    <!--<th scope="col">Rol</th>
                    <th scope="col">Deshabilitado</th>-->
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listaCompraItem as $compraItem) {
                    echo "<tr>";
                    foreach($objAbmProducto->buscar(["idproducto"=>$compraItem->getObjProducto()->getIdProducto()]) as $producto){
                        echo "<td>".$producto->getPronombre();"</td>";
                        echo "<td>".$producto->getProdetalle();"</td>";
                        echo "<td>".$producto->getProimporte();"</td>";
                        echo "<td>".$producto->getProcantstock();"</td>";
                        
                    }
                    // echo "<td>".$compraItem->getMenuDescripcion()."</td>";
                    // echo "<td>".$compraItem->getMenuLink()."</td>";
                    // echo "<td>---</td>";
                    // echo "<td>---</td>";
                    // echo "<td>".$objMenuRol->buscar(["idmenu"=>$menu->getIdMenu()])->getRol()->getIdRol()."</td>";
                    // echo "<td>".$menu->getMenuDescripcion()."</td>";
                    //echo "<td>".$compraItem->getMenuDeshabilitado()."</td>";
                    echo "<td><a class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editarMenu' ><i class='bi bi-pencil-square'></i></a></td>";
                    echo "<td><a class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#eliminar'><i class='bi bi-trash3'></i></a></td>";
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
                No hay menús cargados!
            </div>
        </div>
        <?php
    }
    ?>
        </div>
    </div>
</main>

<div class="modal fade" id="editarMenu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>

<?php
include_once(ROOT_PATH."Vista/estructura/footer.php");
?>

