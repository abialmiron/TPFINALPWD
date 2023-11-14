$(document).ready(function () {
 $('form').submit(function (e) {
        e.preventDefault();
        const forms = document.querySelectorAll('.needs-validation');
        if (forms[0].checkValidity()) {
            var password = document.getElementById("uspass").value;
            var passhash = hex_md5(password);
            console.log(passhash);
            arreglo = {
                usmail: document.getElementById("usmail").value,
                usnombre: document.getElementById("usnombre").value,
                uspass: passhash,
            }
            $.ajax({
                type: "POST",
                url: '../Accion/accionRegistro.php',
                data: arreglo,
                success: function (response) {
                    console.log(response);
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


function registerSuccess() {
    /**Swal.fire({
        icon: 'success',
        title: 'La cuenta se creo correctamente!',
        showConfirmButton: false,
        timer: 1500
    })
    setTimeout(function () {
        redireccionarIndexUser();
    }, 1500);*/
}

function redireccionarIndexUser() {
  location.href = "../public/index.php";
}

function registerFailure() {
   alert ('La cuenta no se pudo crear en la base de datos!');
        recargarPagina();
}


function recargarPagina() {
    location.reload();
}
});