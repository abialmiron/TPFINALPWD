<nav class="menu hidden navbar navbar-expand-lg bg-light shadow fixed-top">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item p-0">
          <a class="nav-link p-0 me-3 ms-3" aria-current="page" href="<?php echo BASE_URL; ?>"><i class="bi bi-house-door-fill fs-4 p-0" ></i></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle"   role="button" data-bs-toggle="dropdown" aria-expanded="false">
            reCaptcha
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item text-black" href="<?php echo BASE_URL ?>vista/reCaptcha">Librería reCaptcha</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?php echo BASE_URL ?>vista/demo-v2_1">reCaptcha V2</a></li>
            <li><a class="dropdown-item" href="<?php echo BASE_URL ?>vista/demo-v3">reCaptcha V3</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Fast Excel Reader
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item text-black" href="<?php echo BASE_URL ?>vista/fast-excel-reader">Librería Fast Excel Reader</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?php echo BASE_URL ?>vista/excel-sheet">Hoja con una tabla</a></li>
            <li><a class="dropdown-item" href="<?php echo BASE_URL ?>vista/excel-area">Área fija</a></li>
            <li><a class="dropdown-item" href="<?php echo BASE_URL ?>vista/excel-img">Hoja con imágenes</a></li>
            <li><a class="dropdown-item" href="<?php echo BASE_URL ?>vista/excel-area-captcha">Área con validación reCaptcha</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- Right elements -->
    <div class="d-flex align-items-center">
        <div class=" dropdown">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
            <span class="p-1">Omar | Administrador</span>
          </a> 
          <ul class="dropdown-menu dropdown-menu-end text-small shadow" style="">
            <li><a class="dropdown-item" href="#">Perfil</a></li>
            <li><a class="dropdown-item" href="#">Elegir Rol</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
          </ul>
        </div>
    </div>
  </div>
</nav>
