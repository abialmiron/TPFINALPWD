<?php
include_once("../estructura/head.php");
?>
<script src="../js/md5.js"></script>
<main class='row justify-content-center align-items-center m-auto'>
<div class="container-fluid">
    <div class="card shadow col-sm-8 col-md-6 col-lg-5 col-xl-4 mx-auto">
        <div class="card-header">
            <h3>Registrarse</h3>
        </div>
        <div class="card-body">
            <form method="post" action="" class="d-flex flex-column needs-validation" novalidate>
                <div class="mb-3">
                    <label>Nombre </label>
                    <input type="text" name="usnombre" id="usnombre" class="form-control text mt-2" required>
                    <div class="invalid-feedback">
                        Ingrese un nombre válido. 
                        -No se aceptan números.
                        -Su longitud debe ser mayor a 3.
                    </div>
                </div>
                <div class="mb-3">
                    <label>Email </label>
                    <input type="text" name="usmail" id="usmail" class="form-control text mt-2" required>
                    <div class="invalid-feedback">
                        Ingrese un email válido.
                    </div>
                </div>
                <div class="mb-3">
                    <label>Contraseña </label>
                    <input type="password" class="form-control validate" name="uspass"  id="uspass" required>
                    <div class="invalid-feedback">
                        Ingrese una contraseña.
                    </div>
                    <div class="invalid-password" style='display:none;'>
                        Las contraseñas no coinciden
                    </div>
                </div>
                <div class="mb-3">
                    <label>Repita la contraseña. </label>
                    <input type="password" id="usPassRep" class="form-control validate" required>
                    <div class="invalid-feedback">
                        Ingrese una contraseña.
                    </div>
                    <div class="invalid-password" style='display:none;'>
                        Las contraseñas no coinciden
                    </div>
                </div>
                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" name="enviar" id="enviar" value="Registrarse">
                </div>
                <p class="m-2 align-self-end"><a href="listaUsuarios.php">Volver</a></p>
            </form>
            </div> 
            
    </div>
</div>
</main>


<?php
include_once("../estructura/footer.php");
?>