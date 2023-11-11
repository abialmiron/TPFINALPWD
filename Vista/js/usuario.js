$(document).on('change', '#cambiar_rol', function () {

  var idRolVista = $(this)[0].value;
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
  });

});

function failure() {
  Swal.fire({
      icon: 'error',
      title: 'No se pudo cambiar el rol',
      showConfirmButton: false,
      timer: 1000
  })
  setTimeout(function () {
      recargarPagina();
  }, 800);
}

function recargarPagina() {
  location.reload();
}

function irHome() {
  location('header("Location: ../Vista/public/index.php")');
}