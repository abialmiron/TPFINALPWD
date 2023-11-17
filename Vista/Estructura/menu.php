<?php
if ($sesionActiva){
  $listaMenu = construirMenu($_SESSION['rol-activo']);
  
}
?>
<nav class="menu hidden navbar navbar-expand-lg bg-light shadow fixed-top">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item p-0">
          <a class="nav-link p-0 me-3 ms-3" href="<?php echo $sesionActiva? BASE_URL."Vista/private/":BASE_URL."Vista/public/"; ?>"><img style="height: 35px;" class="me-2" src="<?php echo BASE_URL."Vista/images/logotipo-menu-50.png"; ?>"/></a>
        </li>
        <!-- ITEMS DEL MENU -->
        <?php
          if ($sesionActiva){
            // ITEMS DEL MENU SEGÚN EL ROL
            foreach ($listaMenu as $itemMenu){
              if ($itemMenu->getMenuDeshabilitado() == NULL) {
            ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo BASE_URL.$itemMenu->getMenuLink(); ?>"><?php echo $itemMenu->getMenuNombre(); ?></a>
              </li>
            <?php
              }
            } 
          } else {
            // ITEMS DEL MENU PÚBLICO
          ?>
              <li class="nav-item">
                <a class="nav-link"  href="<?php echo BASE_URL ?>Vista/public/productos.php">Productos</a></li>
              </li>
              <li class="nav-item">
                <a class="nav-link"  href="<?php echo BASE_URL ?>Vista/public/contacto.php">Contacto</a></li>
              </li>
              <li class="nav-item">
                <a class="nav-link"  href="<?php echo BASE_URL ?>Vista/public/nosotros.php">Nosotros</a></li>
              </li>
          <?php
          } ?>
      </ul>
    </div>
    <!-- ITEMS DEL USUARIO -->
    <div class="d-flex align-items-center">
      <?php
      if($sesionActiva) {
      ?>
        <div class=" dropdown">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <!-- <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle"> -->
            <i class="bi bi-person-circle"></i>
            <span class="p-1"><?php echo $_SESSION['nombreUsuario']; ?> | <?php echo $_SESSION['rol-activo']->getRolDescripcion() ?></span>
          </a> 
          <ul class="dropdown-menu dropdown-menu-end text-small shadow" style="">
            <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>Vista/private/perfil.php">Perfil</a></li>
           
              <li><p class="dropdown-item link">Elegir Rol</p>
            <ul class="dropdown-menu dropdown-submenu dropdown-submenu-left">
              <?php
              foreach ($_SESSION['roles'] as $rol){
                ?>
              <li>
                <a class="dropdown-item link" onclick="cambiarRol(<?php echo $rol->getIdRol(); ?>);" ><?php echo $rol->getRolDescripcion();?></a>
              </li>
              <?php
              }
              ?>
            </ul>
            </li>
            
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item link" onclick="cerrarSesion();">Sign out</a></li>
          </ul>
        </div>
      <?php
       } else {
      ?>
        <a class="btn btn-outline-secondary me-2" href="<?php echo BASE_URL ?>Vista/public/login.php">Iniciar sesión</a>
      <?php
       };
      ?>
    </div>
  </div>
</nav>
