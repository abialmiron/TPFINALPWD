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
					<div class="card " onclick="verDetalle(this)">
						<div class="" data-bs-toggle="modal" href="#modalDetalle" role="button">
							<img src="<?php echo $dir.$producto->getProimagen(); ?>" class="card-img-top object-fit-cover"  height="200" id= "fotoProducto" alt="">
							<div class="card-body">
								<h5 class="card-title" id= "nombreProducto"><?php echo $producto->getPronombre(); ?></h5>
								<p class="card-text" id= "descripcionProducto"><?php echo $producto->getProdetalle(); ?></p>
								<div class="row">
									<p class="card-text col" id= "precioProducto">Precio: $<?php echo $producto->getProimporte(); ?></p>
									<p class="card-text col" id= "cantidadProducto">Stock: 1</p>
								</div>
							</div>
						</div>
								<div class="card-footer z-3">
									<div class="row align-content-end">
										<?php
											if ($sesion->getRolActivo()!== null) {
												if ($sesion->getRolActivo()->getRolDescripcion() == "Cliente") {
													?>
													<button class="btn btn-primary" id="sumarCarrito" data-id="<?php echo $producto->getIdproducto(); ?>" onclick = "agregarCarrito(<?php echo $producto->getIdproducto(); ?>, <?php echo $sesion->getIdUsuario(); ?>,<?php echo 1; ?>)"><i class="bi bi-cart-plus-fill"></i></button>
													<?php
												} 
											}else {
												?>
												<button class="btn btn-primary" id="sumarCarrito" data-id="<?php echo $producto->getIdproducto(); ?>" onclick = "alert('registrate')"><i class="bi bi-cart-plus-fill"></i></button>
												<?php
											}
										?>
								</div>
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
 ?>



<!-- MODAL DETALLE DE PRODUCTO -->

<div class="modal fade" id="modalDetalle" aria-hidden="true" aria-labelledby="detalleModalToggle" tabindex="-1">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title" id="detalleModalToggle">Detalle del Producto</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body row">
				<div class="col-md-4">
					<img id="fotoDetalle" class="img-thumbnail" src="" alt="">
				</div>
				<div class="col">
					<h3 id="nombreDetalle"></h3>
					<p id="descripcionDetalle"></p>
					<p id="cantidadDetalle"></p>
				</div>
			</div>
			<div>
				<p id="precioDetalle"></p>
			</div>
			<div class="modal-footer">
				<form method="post" action="../Accion/accionRegistrarse.php" class="needs-validation" novalidate>
					<input type="text" name="idProducto" id="idDetalle" class="d-none">
					<div>
						<input type="number" name="ciCantidad" id="cantidadInput" min="1" class="form-control" placeholder="Ingrese la cantidad que desea comprar" required>
						<div class="invalid-feedback mb-1">
							No hay stock suficiente!
						</div>
						<div class="valid-feedback">
							Correcto!
						</div>
					</div>
					<input class="btn btn-success me-2" type="submit" name="boton_enviar" id="boton_enviar" value="Agregar al Carrito">
					<!-- <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cerrar</button> -->
				</form>
			</div>
		</div>
	</div>
</div>


<!-- MODAL CARRITO -->



<?php
include_once("../estructura/footer.php");
?>
<script src="<?php echo BASE_URL ?>Vista/js/productoCliente.js"></script>