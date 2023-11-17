
function editarMenu(idMenu){

  $.ajax({
    type: "POST",
    url: base_url+'Vista/Accion/accionEditarMenu.php',
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
}
