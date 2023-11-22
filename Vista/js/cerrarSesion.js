let base_url = "http://"+location.host+location.pathname.slice(0,location.pathname.search("Vista"));
function cerrarSesion(){
    console.log("ok");
    $.ajax({
        type: "POST",
        url: base_url+"Vista/Accion/cerrarSesion.php",
        success: function(response){
            var jsonData = JSON.parse(response);
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
    Swal.fire({
        icon: 'success',
        title: 'Se cerró la sesión',
        showConfirmButton: false,
        timer: 1500
    });
    setTimeout(function () {
        location.href = base_url+"Vista/public/index.php";
    }, 1500);
}

function sesionNoCerrada(){
    Swal.fire({
        icon: 'success',
        title: 'No se cerró la sesión',
        showConfirmButton: false,
        timer: 1500
    });
    setTimeout(function () {}, 1500);
}