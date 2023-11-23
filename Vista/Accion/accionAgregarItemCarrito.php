<?php

include_once("../../configuracion.php");

/*       MAIN       */
$datos = data_submitted();// Recibe idproducto, idusuario, cicantidad
$objCompraEstadoCarrito = null;
$arrayCompras = null;
$objAbmCompraEstado = new AbmCompraEstado();

$arrayCompras = buscarComprasUsuario($datos);
if ($arrayCompras != null) {
    $objCompraEstadoCarrito = $objAbmCompraEstado->buscarObjCompraEstadoCarrito($arrayCompras);
    
    if ($objCompraEstadoCarrito != null) {
        cargarProducto($objCompraEstadoCarrito, $datos);
    }
}
if (($arrayCompras == null) || ($objCompraEstadoCarrito == null)) {
    $objCompraEstadoCarrito = crearCompra($idUsuario);
    cargarProducto($objCompraEstadoCarrito, $datos);
}

/*       MODULOS        */

/* Busca con el id usuario todos las compras que realizo */
function buscarComprasUsuario($datos)
{
    $objAbmCompra = new AbmCompra();
    $arrayCompra = $objAbmCompra->buscar($datos);
    return $arrayCompra;
}

/* Lo que realiza es cargarle el producto deseado */
function cargarProducto($objCompraEstadoCarrito, $datos)
{
    $datos["idcompra"] = $objCompraEstadoCarrito->getIdCompra();
    $idCompraItem = ["idcompra"=>$datos["idcompra"], "idproducto"=>$datos["idproducto"]];
    $objAbmCompraItem = new AbmCompraItem();
    $arrayCompraItem = $objAbmCompraItem->buscar($idCompraItem);

    $objCompraItemRepetido = productoRepetido($arrayCompraItem, $datos["idcompra"]);
    if ($objCompraItemRepetido == null) {
        if ($objAbmCompraItem->alta($datos)) {
            echo json_encode(array('success' => 1));
        } else {
            echo json_encode(array('success' => 0));
        }
    } else {
        $sesion = Session::getInstance();
        $cantStockDisp = $objCompraItemRepetido->getObjProducto()->getProcantstock();
        $cantTot = $datos["cicantidad"] + $objCompraItemRepetido->getCiCantidad();
        if ($cantTot > $cantStockDisp) {
            echo json_encode(array('success' => 2));
        } else {
            $param = [
                "idcompraitem" => $objCompraItemRepetido->getIdCompraItem(),
                "idproducto" => $objCompraItemRepetido->getObjProducto()->getIdProducto(),
                "idcompra" => $objCompraItemRepetido->getObjCompra()->getIdCompra(),
                "cicantidad" => $cantTot
            ];
            $objAbmCompraItem->modificacion($param);
            echo json_encode(array('success' => 1));
        }
    }
}

/* Devuelve si el producto ya esta cargado en el carrito utilizado actualmente */
function productoRepetido($arrayCompraItem, $idCompra)
{
    $resp = null;
    if ($arrayCompraItem !== []) {
        foreach ($arrayCompraItem as $compraItem) {
            if ($compraItem->getObjCompra()->getIdCompra() == $idCompra) {
                $resp = $compraItem;
            }
        }
    }
    return $resp;
}

/* Crea una compra y compraEstado con el idusuario */
function crearCompra($idUsuario)
{
    $objCompra = new AbmCompra();
    $objCompraEstado = new AbmCompraEstado();
    $arrayObjCompraEstado = null;
    if ($objCompra->alta($idUsuario)) {
        $arrayCompra = $objCompra->buscar($idUsuario);
        $fecha = new DateTime();
        $fechaStamp = $fecha->format('Y-m-d H:i:s');
        $paramCompraEstado = [
            "idCompra" => end($arrayCompra)->getIdCompra(),
            "idCompraEstadoTipo" => 1,
            "ceFechaIni" => $fechaStamp,
            "ceFechaFin" => null
        ];
        if ($objCompraEstado->alta($paramCompraEstado)) {
            $idCompra["idCompra"] = end($arrayCompra)->getIdCompra();
            $arrayObjCompraEstado = $objCompraEstado->buscar($idCompra);
        }
    }
    return $arrayObjCompraEstado[0];
}


?>