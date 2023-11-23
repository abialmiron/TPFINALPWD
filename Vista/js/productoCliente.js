/**
 * Carga con datos de la base de datos los productos en la vista de cliente 
 *  para el producto seleccionado
 * 
 * */
function verDetalle(datos) {
  let imagenInfo, nombreInfo, descripcionInfo, precioInfo, cantidadInfo, cantidadInput, idProductoInput;
  imagenInfo = document.getElementById("fotoDetalle");
  nombreInfo = document.getElementById("nombreDetalle");
  descripcionInfo = document.getElementById("descripcionDetalle");
  precioInfo = document.getElementById("precioDetalle");
  cantidadInfo = document.getElementById("cantidadDetalle");
  cantidadInput = document.getElementById("cantidadInput");
  idProductoInput = document.getElementById("idProducto");
  imagenInfo.src = datos.querySelector('#fotoProducto').src;
  nombreInfo.innerHTML = datos.querySelector('#nombreProducto').innerHTML;
  descripcionInfo.innerHTML = datos.querySelector('#descripcionProducto').innerHTML;
  precioInfo.innerHTML = datos.querySelector('#precioProducto').innerHTML;
  cantidadInfo.innerHTML = datos.querySelector('#cantidadProducto').innerHTML;
  // cantidadInput.setAttribute("max", datos.children[0].children[1].children[3].childNodes[0].nodeValue);
  // idProductoInput.value = datos.children[0].children[1].children[4].childNodes[0].nodeValue;
}

agregarCarrito = (idProducto,idCliente, cantidad) => {
  // console.log(idProducto);
  // console.log(idCliente);
  // console.log(cantidad);
  cicantidad = document.getElementById("cantidadProducto").value
  console.log(cicantidad)
  let datos = {
    idproducto: idProducto,
    idusuario: idCliente,
    cicantidad: cantidad
  }
  $.ajax({
    type: "POST",
    url: base_url+"Vista/Accion/accionAgregarItemCarrito.php",
    data: datos,
    success: function(response){
      console.log(response)
        var jsonData = JSON.parse(response);
        if (jsonData.success == "1"){
          exitoAgregarCarrito(1);
        }
        else if (jsonData.success == "2"){
          exitoAgregarCarrito(2);
        }
        else if (jsonData.success == "0"){
          exitoAgregarCarrito(0);
        }
   }
});

function exitoAgregarCarrito($exito){
  $exito == 1 ?
    Swal.fire({
        icon: 'success',
        title: 'Producto agregado al carrito',
        showConfirmButton: false,
        timer: 1500
    })
  : $exito == 2 ?
    Swal.fire({
      icon: 'error',
      title: 'No hay suficiente stock',
      showConfirmButton: false,
      timer: 1500
    })
  :
    Swal.fire({
      icon: 'error',
      title: 'No se pudo agregar al carrito',
      showConfirmButton: false,
      timer: 1500
    })

  setTimeout(function () {
      recargarPagina();
  }, 1500);
}

  
}
