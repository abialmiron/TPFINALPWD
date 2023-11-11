$(document).ready(function () {
  $('form').submit(function (e) {
      e.preventDefault();
      const forms = document.querySelectorAll('.needs-validation');
      if (forms[0].checkValidity()) {
          var password = document.getElementById("password").value;
          console.log(password)
          var passhash = hex_md5(password).toString();
          console.log(passhash)
          document.getElementById("contraseñaEnviada").value = passhash;
          $.ajax({
              type: "POST",
              url: 'Accion/accionIniciarSesion.php',
              data: $(this).serialize(),
              success: function (response) {
                  console.log(response)
                  var jsonData = JSON.parse(response);

                  // user is logged in successfully in the back-end
                  // let's redirect
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
  alert('Se inicio sesion correctamente!');
  setTimeout(function () {
      redireccionarIndex();
  }, 1500);
}


function redireccionarIndex() {
  location.href = "../public/index.php";
}

function registerFailure() {
  Swal.fire({
      icon: 'error',
      title: 'La contraseña y/o el usuario no coinciden!',
      showConfirmButton: false,
      timer: 1500
  })
  setTimeout(function () {
      recargarPagina();
  }, 1500);
}

function recargarPagina() {
  location.reload();
}