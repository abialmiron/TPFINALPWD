$(document).ready(function() {
  // Expresiones regulares para la validación
  var usuarioRegex = /^[^\s!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]{4,}$/;
  var passwordRegex = /^(?=.*\d)(?=.*[A-Z])(?=.*[\W_])[^ ]{8,}$/;

  // Función para validar el campo de usuario
  function validarUsuario() {
    var usuario = $('#usuario').val();
    if (usuarioRegex.test(usuario)) {
      $(this).removeClass("is-invalid");
    } else {
      $(this).addClass("is-invalid");
    }
  }

  // Función para validar el campo de contraseña
  function validarPassword() {
    var password = $('#password').val();
    if (passwordRegex.test(password)) {
      $(this).removeClass("is-invalid");
    } else {
      $(this).addClass("is-invalid");
    }
  }

  // Validación en tiempo real al escribir en los campos
  $('#usuario').on('input', validarUsuario);
  $('#password').on('input', validarPassword);
});

  
$(document).ready(function() {
    $("#form").submit(function(event) {
        if (!validarActualizacion()) {
            event.preventDefault(); // Evita el envío del formulario si no pasa la validación
        }
    });
    
    function validarActualizacion() {
        var isValid = true;
        
        var usuarioValue = $("#usnombre").val().trim();
        var passValue = $("#uspass").val().trim();
        var mailValue = $("#usmail").val().trim();
        
        if (usuarioValue === "" || usuarioValue.length < 4 || !/^[a-zA-Z]+$/.test(usuarioValue)) {
            $("#usnombre").addClass("is-invalid");
            isValid = false;
        } else {
            $("#usnombre").removeClass("is-invalid");
        }
        
        if (passValue === "" || passValue === usuarioValue || passValue.length < 8 || !/^\d+$/.test(passValue)) {
            $("#uspass").addClass("is-invalid");
            isValid = false;
        } else {
            $("#uspass").removeClass("is-invalid");
        }
        
        if (mailValue === "" || !/@/.test(mailValue)) {
            $("#usmail").addClass("is-invalid");
            isValid = false;
        } else {
            $("#usmail").removeClass("is-invalid");
        }
        
        return isValid;
    }
});

