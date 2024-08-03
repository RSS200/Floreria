<?php
include("../includes/header.php");
include("../includes/menu.php");
include("../config/Mysql.php");
include("../modelos/Arreglo.php");
if (!$_SESSION['auth']) {
    header('Location: ../login.php');
}
$base = new Mysql();
$cx = $base->connect();
$arreglo = new Arreglo($cx);
$id = 0;

// Procesamiento del formulario
if (isset($_POST['crearArreglo'])) {
    $nombre = $_POST["nombre"];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];

    if ($nombre == '' || empty($nombre) || $precio == '' || empty($precio) || $descripcion == '' || empty($descripcion)) {
        $error = "Todos los campos son obligatorios";
    } else {
        $idInsertado = $arreglo->crearArreglo($nombre, $precio, $descripcion);

        if ($idInsertado != false) {
            $mensaje = "Se ha insertado el registro";
            session_start();
            $_SESSION['Mensaje'] = 'Se ha creado el arreglo, puedes agregar las flores que requieres';
            header("Location: editar-arreglo.php?idArreglo={$idInsertado}" );
            exit();  
        } else {
            $error = "Existe un problema al insertar el registro";
        }
    }
}
?>
<!--Imprimir el error o el mensaje -->

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

<div class="titulos text-center container m-5">
    <h3> Paso 1 .- Crear Arreglo de flores</h3>
</div>

<div class="row">
    <div class="col-sm-6 offset-3">
        <form method="POST" action="">


            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del arreglo:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el nombre">
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="number" class="form-control" name="precio" id="precio" placeholder="Ingresa el precio de la mano de obra para el arreglo">
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Descripcion del arreglo:</label>
                <textarea class="form-control" name="descripcion" rows="5" cols="80"></textarea>
            </div>



            <br />
            <button type="submit" name="crearArreglo" class="btn btn-success float-left"><i class="bi bi-person-bounding-box"></i> Siguiente</button>

        </form>
    </div>
</div>
<?php include("../includes/footer.php") ?>