<?php 
    include("../includes/header.php");
    include("../includes/menu.php");
    include("../config/Mysql.php");
    include("../modelos/Categorias.php");
    $base = new Mysql();
    $cx = $base->connect();
    $categoria = new Categorias($cx);
    $id=0;
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $cat = $categoria->getCategoria($id);
    } 
    
   
?>
    <!--Imprimir el error o el mensaje -->

<div class="row">
    <div class="col-sm-12">
        <?php if (isset($_SESSION['Mensaje'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['Mensaje'] ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>
</div>

    <div class="titulos text-center container m-5">
       <h3>Crear Categoria</h3>
    </div>            

    <div class="row">
        <div class="col-sm-6 offset-3">
        <form method="POST" action="">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el nombre" >              
            </div>
            <div class="mb-3">
            <label for="" class="form-label">Activo:</label>
            <select class="form-select" aria-label="Default select example" name="activo">
                <option value="3">--Selecciona un rol--</option>
                <option value="1">Activo</option>  
                <option value="0">Inactivo</option>
                             
            </select>             
            </div>          
        
            <br/>
            <button type="submit" name="CrearCategoria" class="btn btn-success float-left"><i class="bi bi-person-bounding-box"></i> Editar Categoria</button>
            <a href="listacategoria.php" class="btn btn-warning">Cancelar</a>
            </form>
        </div>
    </div>
<?php include("../includes/footer.php") ?>
       