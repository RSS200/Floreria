<?php
/*if (!$_SESSION['auth']){
        header('Location: ../index.php');
        die();
    }*/
include("../includes/header.php");
include("../includes/menu.php");
include("../config/Mysql.php");
include("../modelos/Categorias.php");
$base = new Mysql();
$cx = $base->connect();
$categoria = new Categorias($cx);

?>

<!--Imprimir el error o el mensaje -->
<div class="row">
    <div class="col-sm-12">
        <?php if (isset($_SESSION['Mensaje'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['Mensaje'] ?></strong>
            </div>
        <?php endif;
        unset($_SESSION['Mensaje']); ?>

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
    <h3 class="titulos">Lista de Categorias</h3>
</div>

<div>
    <a href="crear-categoria.php" class="btn btn-primary">Crear</a>
</div>

<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categoria->listar() as $categori) : ?>
                <tr>
                    <td><?= $categori->id ?></td>
                    <td><?= $categori->nombre ?></td>
                    <td>
                        <span class="badge bg-primary">
                            <?php print $categori->activo ? 'activo' : 'inactivo'; ?>
                        </span>

                    </td>
                    <td>
                        <a href="editar-categoria.php?id=<?= $categori->id ?>" class="btn btn-warning">Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include("../includes/footer.php") ?>