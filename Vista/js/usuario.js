function cambiarRol (idRol) {

    $.ajax({
      type: "POST",
      url: base_url+'Vista/Accion/accionCambiarRol.php',
      data: { idrol: idRol },

      success: function (respuesta) {
        console.log(respuesta)
          var jsonData = JSON.parse(respuesta);
          if (jsonData.success == "1") {
            Swal.fire({
              icon: 'success',
              title: 'Se cambio el rol correctamente',
              showConfirmButton: false,
              timer: 1500
            });
            setTimeout(function () {
              irHome();
            }, 1500);
          }else if (jsonData.success == "0") {
              failure()
          }
      }
    })
  };


function failure() {
  Swal.fire({
    icon: 'success',
    title: 'No se pudo cambiar el rol',
    showConfirmButton: false,
    timer: 1500
  });
  setTimeout(function () {
      recargarPagina();
  }, 1500 );
}

function recargarPagina() {
  location.reload();
}

function irHome() {
  location.href = base_url+"Vista/private/index.php";
}