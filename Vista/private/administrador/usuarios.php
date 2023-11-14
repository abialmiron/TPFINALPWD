<?php
include_once("../../estructura/head.php");
$objUsuarios = new AbmUsuario();
$listaUsuario = $objUsuarios->buscar(null);
$objRol = new AbmRol();
$listaRoles = $objRol->buscar(null);
if (count($listaUsuario) > 0) {
?>
 <div class="container mt-5">
        <h2>Tabla de Usuarios</h2>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Deshabilitado</th>
                    <th scope="col">Actualizar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listaUsuario as $usuario) {
                    echo "<tr>";
                    echo "<td>".$usuario->getUsNombre()."</td>";
                    echo "<td>".$usuario->getUsMail()."</td>";
                    echo "<td>".$usuario->getUsDeshabilitado()."</td>";
                    echo "<td><a href='actualizar_usuario.php?id=".$usuario->getIdUsuario()."' class='btn btn-warning btn-sm'>Actualizar</a></td>";
                    echo "<td><a href='eliminar_usuario.php?id=".$usuario->getIdUsuario()."' class='btn btn-danger btn-sm'>Eliminar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php } else {
    ?>
        <div class="container p-2">
            <div class="alert alert-info" role="alert">
                No hay usuarios cargados!
            </div>
        </div>
<?php
    }
include_once("../estructura/footer.php");
?>