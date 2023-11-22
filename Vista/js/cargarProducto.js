$(document).ready(function () {
    $('form').submit(function (e) {
        e.preventDefault();
        formData = new FormData(this);
        const forms = document.querySelectorAll('.needs-validation');
        if (forms[0].checkValidity()) {
            
            $.ajax({
                type: "POST",
                url: '../../Accion/accionAgregarProd.php',
                data: formData,
                processData: false,
                 contentType: false,
                success: function (response) {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success == "1") {
                        registerSuccess();
                    }
                    else if (jsonData.success == "0") {
                        registerFailure();
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
        title: 'El producto se ha cargado correctamente!',
        showConfirmButton: false,
        timer: 1500
    })
    setTimeout(function () {
        recargarPagina();
    }, 1500);
}

function registerFailure() {
    Swal.fire({
        icon: 'error',
        title: 'No se ha podido cargar el producto!',
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