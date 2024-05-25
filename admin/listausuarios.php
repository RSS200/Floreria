<?php
    /*if (!$_SESSION['auth']){
        header('Location: ../index.php');
        die();
    }*/
    include("../includes/header.php"); 
    include("../includes/menu.php"); 
    include("../config/Mysql.php");
    include("../modelos/Usuario.php");
    $base = new Mysql();
    $cx = $base->connect();
    $usuarios = new Usuario($cx);
    if (isset($_GET['mensaje'])){
        $mensaje = $_GET['mensaje'];
    }
?>

 <!--Imprimir el error o el mensaje -->
 <div class="row">
    <div class="col-sm-12">
        <?php if (isset($_SESSION['Mensaje'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['Mensaje']?></strong>
            </div>
        <?php endif;   unset($_SESSION['Mensaje']); ?>
        
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?php if (isset($mensaje)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $mensaje ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="container text-center m-5">
  <h3 class="titulos">Lista de Usuarios</h3>
</div>



<div class="container">
<table class="table">
  <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>usuario</th>
        <th>Rol</th>
        <th>Fecha de Creación</th>                       
        <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($usuarios->listar() as $usuario):?>
        <tr>
            <td><?=$usuario->id?></td>
            <td><?=$usuario->nombre?></td>
            <td><?=$usuario->usuario?></td>
            <td><?=$usuario->admin?></td>
            <td><?=$usuario->fecha_creacion?></td>
            <td>
                <a href="editar-usuario.php?id=<?=$usuario->id?>" class="btn btn-warning">Editar</a>                                            
            </td>
        </tr>
    <?php endforeach;?>
  </tbody>
</table>
</div>

<?php include("../includes/footer.php") ?>

