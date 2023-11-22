$(document).ready(function () {
  $('form').submit(function (e) {
      e.preventDefault();
      const forms = document.querySelectorAll('.needs-validation');
      if (forms[0].checkValidity()) {
          var password = document.getElementById("password").value;
          var passhash = hex_md5(password).toString();
          document.getElementById("contraseñaEnviada").value = passhash;
          $.ajax({
              type: "POST",
              url: base_url+'Vista/Accion/accionIniciarSesion.php',
              data: $(this).serialize(),
              success: function (response) {
                  var jsonData = JSON.parse(response);
                  if (jsonData.success == "1") {
                      registerSuccess();
                  }
                  else if (jsonData.success == "0") {
                      registerFailure();
                  } else if (jsonData.success == "-1") {
                      captchaFailure();
                  }
              }
          });
      } else {
          forms[0].classList.add('was-validated');
      }
  });
});

function registerSuccess() {
  Swal.fire({
    icon: 'success',
    title: 'Se inicio sesion correctamente!',
    showConfirmButton: false,
    timer: 1500
});
  setTimeout(function () {
      redireccionarIndex();
    }, 1500);

}


function redireccionarIndex() {
  location.href = base_url+"Vista/private/index.php";
}

function registerFailure() {
  Swal.fire({
    icon: 'success',
    title: 'La contraseña y/o el usuario no coinciden!',
    showConfirmButton: false,
    timer: 1500
    });
  setTimeout(function () {
      recargarPagina();
    }, 1500);

}
  

function recargarPagina() {
  location.reload();
}