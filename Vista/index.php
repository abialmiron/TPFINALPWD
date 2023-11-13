<?php

header('Location: public/index.php');

/*
include_once("../configuracion.php");
include_once(STRUCTURE_PATH . "head.php");
 ?>

<main class="p-5 text-center bg-light">
    <h2>Lista de Usuarios:</h2>
    <?php
    $producto = new AbmProducto();
    $productos = $producto->buscar(null);
    if (count($productos) > 0) {
    ?>
        <div class="row justify-content-center p-3">
            <?php
            foreach ($productos as $producto) {
                ?>
                <div class="col-lg-6 col-sm-12 mb-4">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="card-title text-center"><?php echo $producto->getPronombre(); ?></h4>
                            <h4 class="card-title text-center"><?php echo "ID: " . $producto->getIdproducto(); ?></h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-2">
                                        <!-- Agrega contenido relacionado al producto aquí -->
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <!-- Agrega más contenido relacionado al producto aquí -->
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-primary btn-sm">Comprar</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="#"> <!-- Agrega el enlace apropiado aquí -->
                                            <button type="button" class="btn btn-danger btn-sm">Ver</button>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php
            }  //fin foreach
            ?>
        </div>
    <?php
    } else {
        echo "<br> No se encontraron registros.";
    }
    ?>
</main>

<?php include(STRUCTURE_PATH . "footer.php"); */?>
