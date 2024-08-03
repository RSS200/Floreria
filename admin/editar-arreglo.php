<?php

include("../includes/header.php");
include("../includes/menu.php");
include("../config/Mysql.php");
include("../modelos/Flores.php");
if (!$_SESSION['auth']){
    header('Location: ../login.php');
}
$base = new Mysql();
$cx = $base->connect();
$flor = new Flores($cx);
if (isset($_GET['idArreglo'])){
    $idArreglo = $_GET['idArreglo'];
} 
$flores= $flor->getFloresPorArreglo($idArreglo);
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
    <h3 class="titulos">Lista de Flores en el arreglo</h3>
</div>

<div class="container">
    <a href="agregar-flor-arreglo.php?idArreglo=<?=$idArreglo?>" class="btn btn-primary">Agregar Flor</a>
</div>

<div class="container">
<table class="table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Nombre de flor</th>
            <th>Costo por pieza</th>
            <th>Piezas</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($flores && is_array($flores)) : ?>
            <?php $contador = 1; // Inicializar el contador ?>
            <?php foreach ($flores as $flor) : ?>
                <tr>
                    <td><?= $contador ?></td>
                    <td><?= $flor->nombreflor ?></td>
                    <td><?= $flor->precioflor ?></td>
                    <td><?= $flor->piezasFlor ?></td>
                    <td><?= ($flor->piezasFlor * $flor->precioflor) ?></td>
                    <td>
                        <?php if ($_SESSION['rol_id'] == 1): ?>
                            <a href="editar-flor-arreglo.php?idflorArreglo=<?= $flor->faid ?>&idArreglo=<?=$_GET['idArreglo']?>" class="btn btn-warning">Editar</a>
                            <a href="eliminar-flor-en-arreglo.php?id=<?= $flor->faid ?>&idArreglo=<?=$_GET['idArreglo']?>" class="btn btn-danger">Eliminar</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php $contador++; // Incrementar el contador ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No se encontraron flores para este arreglo.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</div>

<?php include("../includes/footer.php") ?>