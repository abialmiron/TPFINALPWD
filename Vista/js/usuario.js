$(document).ready( function () {
  $('#btnCambiarRol').click(function () {
    $.ajax({
      type: "POST",
      url: '../Accion/accionCambiarRol.php',
      data: { idRol: idRol },

      success: function (respuesta) {
          var jsonData = JSON.parse(respuesta);

          // user is logged in successfully in the back-end
          // let's redirect
          if (jsonData.success == "1") {
              recargarPagina();
          }
          else if (jsonData.success == "0") {
              failure()
          }
      }
    })
  });
});

function failure() {
  alert( 'No se pudo cambiar el rol');
}

function recargarPagina() {
  location.reload();
}

function irHome() {
  location('header("Location: ../Vista/public/index.php")');
}