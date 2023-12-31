<?php
include_once("../../configuracion.php");

// if ($_SESSION['sesion-activa']){
//     header("location:".BASE_URL."Vista/public/index.php?error=1");
//     exit();
// }
include_once("../Estructura/head.php");
?>
<main class="row justify-content-center align-items-center m-auto p-4">
	<div >
			<div class="card shadow col-sm-8 col-md-6 col-lg-5 col-xl-4 mx-auto">
					<div class="card-header">
							<h3>Ingresar</h3>
					</div>
					<div class="card-body">
							<form class="d-flex flex-column needs-validation" novalidate method="post" action="../Accion/accionIniciarSesion.php" id="formLogin" name="formLogin">
									<div class="mb-3">
			<div class="input-group">
			<span class="input-group-text" id="basic-addon1">
					<i class="bi bi-person-fill"></i>
					</span>
					<input class="form-control validate" type="text" name="nombreUsuario" id="usuario" placeholder="Username" required>
					<div class="invalid-feedback">
							Por favor, ingrese un usuario válido.
							<br>*El usuario debe tener al menos 4 caracteres.
					</div>
			</div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="bi bi-lock-fill"></i>
                    </span>
                    <input type="password" class="form-control validate" id="password" placeholder="Password" required>
                    <input type="password" class="form-control d-none" name="password"  id="contraseñaEnviada">
                    <div class="invalid-feedback">
                        Por favor, ingrese una clave válida.
                    <br>*Debe tener al menos 8 caracteres.
                    <br> *No puede ser igual al nombre de usuario.
                    <br> *Solo numeros.
                </div>
                </div>
            </div>
            <div class="d-grid">
            <input type="submit" class="btn btn-primary" value="Ingresar">
          </div>
        </form>
    </div>
    <p class="m-2 align-self-end"><span>No tenés cuenta? </span><a  href="registro.php">Registrate</a></p>
			</div>
		</div>
	</div>
</main>
<?php include (STRUCTURE_PATH."footer.php"); ?>
<script src="<?php echo BASE_URL ?>Vista/js/md5.js"></script>
<script src="<?php echo BASE_URL ?>Vista/js/iniciarSesion.js"></script>

