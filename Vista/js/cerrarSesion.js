
function cerrarSesion(){
    console.log("ok");
    $.ajax({
        type: "POST",
        url: '../Accion/cerrarSesion.php',
        success: function(response){
            var jsonData = JSON.parse(response);
            // user is logged in successfully in the back-end
            // let's redirect
            if (jsonData.success == "1"){
                sesionCerrada();
            }
            else if (jsonData.success == "0"){
                sesionNoCerrada();
            }
       }
   });
}

function sesionCerrada(){
    alert ('Se cerró la sesión');
        location.href = "../public/index.php";
}

function sesionNoCerrada(){
    alert('No se cerró la sesión');
}