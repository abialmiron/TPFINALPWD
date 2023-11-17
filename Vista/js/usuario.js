function cambiarRol (idRol) {
    $.ajax({
      type: "POST",
      url: '../Accion/accionCambiarRol.php',
      data: { idrol: idRol },

      success: function (respuesta) {
        console.log(respuesta)
          var jsonData = JSON.parse(respuesta);
          if (jsonData.success == "1") {
            alert('Se cambio el rol correctamente');
              recargarPagina();
          }
          else if (jsonData.success == "0") {
              failure()
          }
      }
    })
  };


function failure() {
  alert( 'No se pudo cambiar el rol');
}

function recargarPagina() {
  location.reload();
}

function irHome() {
  location('header("Location: ../Vista/public/index.php")');
}