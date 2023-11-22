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
  console.log(datos);
  // imagenInfo.src = datos.children[0].children[0].children[0].src;
  // nombreInfo.innerHTML = datos.children[0].children[1].children[0].childNodes[0].nodeValue;
  nombreInfo.innerHTML = "añlskdjafñsdlkjf"
  // descripcionInfo.innerHTML = datos.children[0].children[1].children[1].childNodes[0].nodeValue;
  // precioInfo.innerHTML = "Precio: $ " + datos.children[0].children[1].children[2].childNodes[0].nodeValue;
  // cantidadInfo.innerHTML = "Cantidad de Stock: " + datos.children[0].children[1].children[3].childNodes[0].nodeValue;
  // cantidadInput.setAttribute("max", datos.children[0].children[1].children[3].childNodes[0].nodeValue);
  // idProductoInput.value = datos.children[0].children[1].children[4].childNodes[0].nodeValue;
}