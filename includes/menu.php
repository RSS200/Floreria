<?php $ruta ="http://localhost/floreria/"?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="" href="#">
    <img src="img/logo.png"alt="" style="width:50px">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?=$ruta?>">Inicio</a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Floreria
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Arreglos</a></li>
            <li><a class="dropdown-item" href="#">Flores</a></li>
            <li><a class="dropdown-item" href="<?=$ruta?>admin/listacategoria.php">Categoria</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link "  href="<?=$ruta?>admin/listausuarios.php" >Usuarios</a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
