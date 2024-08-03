<?php

include("../includes/header.php");
include("../includes/menu.php");
include("../config/Mysql.php");
include("../modelos/Arreglo.php");
if (!$_SESSION['auth']){
    header('Location: ../login.php');
}
$base = new Mysql();
$cx = $base->connect();
$arreglos = new Arreglo($cx);
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
    <h3 class="titulos">Lista de Flores registradas</h3>
</div>

<div class="container">
    <a href="crear-arreglo.php" class="btn btn-primary">Crear</a>
</div>

<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio de Flores</th>
                <th>Precio de mano de obra</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($arreglos->listar() as $arreglo) : ?>
                <tr>
                    <td><?= $arreglo->id ?></td>
                    <td><?= $arreglo->nombre ?></td>
                    <td><?= $arreglo->descripcion ?></td>
                    <td>$ <?= $arreglos->sumaCostoFloresArreglo($arreglo->id) ?></td>
                    <td>$ <?= $arreglo->precioManoObra ?></td>
                    <td>$ <?= $arreglo->precioManoObra + $arreglo->precioFlores?></td>
                    <td>
                        <span class="badge bg-primary">
                            <?php print $arreglo->activo ? 'activo' : 'inactivo'; ?>
                        </span>

                    </td>

                
                    <td>
                    <?php if ($_SESSION['rol_id'] == 1): ?>
                        <a href="editar-arreglo.php?idArreglo=<?= $arreglo->id ?>" class="btn btn-warning">Ver</a>
                    <?php endif;?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include("../includes/footer.php") ?>