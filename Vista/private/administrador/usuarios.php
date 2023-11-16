<?php
include_once("../../../configuracion.php");
include_once("../../Estructura/head.php");
$objUsuarios = new AbmUsuario();
$listaUsuario = $objUsuarios->buscar(null);
$objRol = new AbmRol();
$listaRoles = $objRol->buscar(null);
if (count($listaUsuario) > 0) {
?>
 <div class="container mt-5">
        <h1 style="margin-top: 5%;">Gestión de Usuarios</h1>
        <a href='' class='btn btn-success btn-sm' style="float: right;margin: 8px;"><i class='bi bi-plus-circle'></i></a></p>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Deshabilitado</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listaUsuario as $usuario) {
                    echo "<tr>";
                    echo "<td>".$usuario->getUsNombre()."</td>";
                    echo "<td>".$usuario->getUsMail()."</td>";
                    echo "<td>".$usuario->getUsDeshabilitado()."</td>";
                    echo "<td><a href='actualizar_usuario.php?id=".$usuario->getIdUsuario()."' class='btn btn-primary btn-sm'><i class='bi bi-pencil-square'></i></a></td>";
                    echo "<td><a href='eliminar_usuario.php?id=".$usuario->getIdUsuario()."' class='btn btn-danger btn-sm'><i class='bi bi-trash3'></i></a></td>";
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
include_once(ROOT_PATH."Vista/estructura/footer.php");
?>